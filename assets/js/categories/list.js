
function deleteCategory(id) {
    swal({
        title: "Are you sure?",
        text: "Category will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'Categories/delete/' + id;
        ajaxPost(url)
            .then(result => { 
                setTimeout(() => { location.reload() }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

function editCategory (id, name) {
    $('#category_id').val(id);
    $('#category_name').val(name);
    $('#editModal').find('input[type=file]').val('');
    $('#editModal').modal('show');
    $('.picture-preview').addClass('hide');
}

var $images = $('#picture');
var $inputFile = $('#input-file-upload').find('input[name=file]');
var $inputFileLoader = $('#input-file-upload').find('.preloader');

$(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        showLoading();
        $image = $images.find('img');
        
        let url = base_url + 'Categories/update';
        let data = new FormData(this);
        if ($image.length > 0) {
            data.append('file', $image[0].src);
        }
        
        ajaxPost(url, data)
            .then(result => { 
                showNotice(result.message, true) 
                $('#editModal').modal('hide');
                setTimeout(() => { location.reload() }, 1000);
            })
            .catch(error => { showNotice(error.message, false) })
    });
})

function showImage (input) {
    if (input.files && input.files[0]) {
        $inputFileLoader.removeClass('hide');

        let file = input.files[0];

        var reader = new FileReader();
        reader.onload = function (readerEvent) {
            $inputFileLoader.addClass('hide');
            $('.picture-preview').removeClass('hide');
            $images.html(`<img 
                                class="thumbnail m-b-0" style="max-width: 100%"
                                src="` + readerEvent.target.result + `">`);
        };
        reader.readAsDataURL(file);

    } else {
        $images.find('.img-profile').remove();
        $('.picture-preview').addClass('hide');
    }
}