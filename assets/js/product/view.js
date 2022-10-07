$(function () {

    $('form').submit(function(e){
        e.preventDefault();
        showLoading();

        let url = base_url + 'products/Info/update/'+product_id;
        let data = new FormData(this);
        
        ajaxPost(url, data)
            .then(result => { 
                setTimeout(() => { location.reload(); }, 1000);
                showNotice(result.message, true);
            })
            .catch(error => { showNotice(error.message, false) })
    })
})

function showImage (input) {
    if (input.files && input.files[0]) {
        $('.preloader').removeClass('hide');
        var $images = $('#product-images');
        let totalImages = $images.find('img').length;
        let files = input.files;

        for(let i=0, l=files.length; i<l; i++) {
            resizeImage({
                file: files[i],
                maxSize: 500
                })
                .then(function (resizedImage) {
                    totalImages+= 1;
                    displayImage(resizedImage, $images);
                    if (totalImages === 10 || (totalImages+1) > files.length) {
                        $('.preloader').addClass('hide');
                    }
                    $('.btn-save-images').removeClass('hide');
                    if (totalImages + 1 > 10) {
                        $('input[name=file]').addClass('hide');
                        $('.add-label').addClass('hide');
                        return;
                    }
                })
                .catch(function (err) { console.error(err); });

        }
    }
}

function displayImage (resizedImage, $images) {
    var reader = new FileReader();
    reader.readAsDataURL(resizedImage); 
    reader.onloadend = function() {
        let totalImages = $images.find('img').length;
        if ((totalImages + 1) > 10) {
            $('input[name=file]').addClass('hide');
            $('.add-label').addClass('hide');
            $('.preloader').addClass('hide');
            return;
        }
        let imageName = new Date().getTime();
        $images.append(`
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 image-` + imageName + `">
                <div class="card">
                    <button onclick="removeImage('.image-` + imageName + `')"
                        type="button" 
                        class="m-t--15 m-r--15 btn btn-danger btn-circle waves-effect waves-circle waves-float pull-right"
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="" 
                        data-original-title="Remove">
                        <i class="material-icons">clear</i>
                    </button>
                    <div class="body">
                        <img class="img-responsive new thumbnail m-b-0" src="` + reader.result + `">
                    </div>
                </div>
            </div>`);
        $('input[name=file]').val('');
    }
}

function removeImage(image, image_id) {
    if (!image_id) {
        var $images = $('#product-images');
        
        $images.find(image).remove();
        let totalImages = $images.find('img').length;
        if ((totalImages - 1) < 5) {
            // hide remove button 
            $images.find('.delete-image').addClass('hide')
        }
        if ((totalImages - 1) < 10) {
            // show file input
            $('input[name=file]').removeClass('hide')
            $('.add-label').removeClass('hide');
        }
        if ($images.find('img.new').length === 0) {
            $('.btn-save-images').addClass('hide');
        }
        return;
    }
    swal({
        title: "Are you sure?",
        text: "Image will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'products/Info/delete_image/' + image_id;
        ajaxPost(url)
            .then(result => { 
                var $images = $('#product-images');
                
                $images.find(image).remove();
                let totalImages = $images.find('img.current').length;
                if ((totalImages - 1) < 5) {
                    // hide remove button 
                    $images.find('.delete-image').addClass('hide')
                }
                if ((totalImages - 1) < 10) {
                    // show file input
                    $('input[name=file]').removeClass('hide')
                    $('.add-label').removeClass('hide');
                }
                $('.add-image-div').removeClass('hide');
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

function saveImages() {
    showLoading();

    $images = $('#product-images').find('img.new');
    
    let totalImages = $images.length;
    if (totalImages === 0){
        showNotice('Please upload images of product', false)
        return;
    }
    if (totalImages > 5){
        showNotice('The maximum number of images for the product is 10', false)
        return;
    }
    
    let url = base_url + 'products/Actions/add_images/' + product_id;
    let data = new FormData();
    for(let i=0, l=totalImages; i<l; i++) {
        console.log($images[i])
        data.append('files['+i+']', $images[i].src);
    }
    
    ajaxPost(url, data)
        .then(result => { 
            $('.btn-save-images').addClass('hide');
            setTimeout(() => { location.reload(); }, 1000);
            showNotice(result.message, true);
        })
        .catch(error => { showNotice(error.message, false) })
}

