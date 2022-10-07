
var $images = $('#profile-picture');
var $inputFile = $('#input-file-upload').find('input[name=file]');
var $inputFileLoader = $('#input-file-upload').find('.preloader');

$(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        showLoading();
        $image = $images.find('img');
        
        let url = base_url + 'Categories/add';
        let data = new FormData(this);
        if ($image.length > 0) {
            data.append('file', $image[0].src);
        }
        
        ajaxPost(url, data)
            .then(result => { 
                setTimeout(() => { location.href = base_url + 'categories/alist' }, 1000);
                showNotice(result.message, true) 
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
                                class="thumbnail img-profile" style="max-width: 100%"
                                src="` + readerEvent.target.result + `">`);
        };
        reader.readAsDataURL(file);

    } else {
        $images.find('.img-profile').remove();
        $('.picture-preview').addClass('hide');
    }
}