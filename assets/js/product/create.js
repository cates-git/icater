var resizeImage = function (settings) {
    var file = settings.file;
    var maxSize = settings.maxSize;
    var reader = new FileReader();
    var image = new Image();
    var canvas = document.createElement('canvas');
    var dataURItoBlob = function (dataURI) {
        var bytes = dataURI.split(',')[0].indexOf('base64') >= 0 ?
            atob(dataURI.split(',')[1]) :
            unescape(dataURI.split(',')[1]);
        var mime = dataURI.split(',')[0].split(':')[1].split(';')[0];
        var max = bytes.length;
        var ia = new Uint8Array(max);
        for (var i = 0; i < max; i++)
            ia[i] = bytes.charCodeAt(i);
        return new Blob([ia], { type: mime });
    };
    var resize = function () {
        var width = image.width;
        var height = image.height;
        if (width > height) {
            if (width > maxSize) {
                height *= maxSize / width;
                width = maxSize;
            }
        } else {
            if (height > maxSize) {
                width *= maxSize / height;
                height = maxSize;
            }
        }
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(image, 0, 0, width, height);
        var dataUrl = canvas.toDataURL('image/jpeg');
        return dataURItoBlob(dataUrl);
    };
    return new Promise(function (ok, no) {
        if (!file.type.match(/image.*/)) {
            no(new Error("Not an image"));
            return;
        }
        reader.onload = function (readerEvent) {
            image.onload = function () { return ok(resize()); };
            image.src = readerEvent.target.result;
        };
        reader.readAsDataURL(file);
    });
};

$(function () {

    $('form').submit(function(e){
        e.preventDefault();
        showLoading();

        $images = $('#product-images').find('img');
        
        let totalImages = $images.length;
        if (totalImages === 0){
            showNotice('Please upload images of product', false)
            return;
        }
        if (totalImages > 10){
            showNotice('You can only upload a maximum of 10 images', false)
            return;
        }
        if (totalImages < 5){
            showNotice('Please upload a minimum of 5 images', false)
            return;
        }
        
        let url = base_url + 'products/Create/process';
        let data = new FormData(this);
        for(let i=0, l=totalImages; i<l; i++) {
            data.append('files['+i+']', $images[i].src);
        }
        
        ajaxPost(url, data)
            .then(result => {
                setTimeout(() => { 
                    location.href = base_url + 'products/Info/index/' + result.data; 
                }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    })
})

function showImage (input) {
    if (input.files && input.files[0]) {
        $('.preloader').removeClass('hide');
        var $images = $('#product-images');
        let totalImages = $images.find('img').length;
        console.log(totalImages);

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
                        <img class="img-responsive thumbnail m-b-0" src="` + reader.result + `">
                    </div>
                </div>
            </div>`);
        $('input[name=file]').val('');
    }
}

function removeImage(image) {
    var $images = $('#product-images');
    let totalImages = $images.find('img').length;
    if ((totalImages - 1) < 10) {
        // show file input
        $('input[name=file]').removeClass('hide')
    }

    // remove image
    $images.find(image).remove();
}

