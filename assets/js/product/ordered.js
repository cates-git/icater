
function setStatus(id, status) {
    let msg = 'Order will be cancelled';
    if (status == 1) { // approve
        msg = 'Approve customer\'s order';
    } else if (status == 2) {
        msg = 'Disapprove customer\'s order';
    } else if (status == 4) {
        msg = 'Mark customer\'s order as done';
    }
    swal({
        title: "Are you sure?",
        text: msg,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Confirm",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'Booking/set_status/' + id + '/' + status;
        ajaxPost(url)
            .then(result => {
                setTimeout(() => { location.reload(); }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}


var $images = $('#picture');
var $inputFile = $('#input-file-upload').find('input[name=file]');
var $inputFileLoader = $('#input-file-upload').find('.preloader');

$receiptModal = $('#receiptModal');
$reviewModal = $('#reviewModal');

function uploadReceipt (id) {
    $('#order_id').val(id);
    $('#uploadModal').find('input[type=file]').val('');
    $('#uploadModal').modal('show');
    $('.picture-preview').addClass('hide');
}

function review (id) {
    $reviewModal.find('input[name=order_id]').val(id);
    $reviewModal.find('[name=comment]').val('');
    $reviewModal.modal('show');
}

function showReceipt (src) {
    $receiptModal.modal('show');
    $receiptModal.find('img').attr('src', src);
}

function showImage (input) {
    if (input.files && input.files[0]) {
        $inputFileLoader.removeClass('hide');

        let file = input.files[0];

        var reader = new FileReader();
        reader.onload = function (readerEvent) {
            $inputFileLoader.addClass('hide');
            $('.picture-preview').removeClass('hide');
            $images.html(`<img 
                        class="thumbnail w-100 m-b-0"
                        src="` + readerEvent.target.result + `">`);
        };
        reader.readAsDataURL(file);

    } else {
        $images.find('img').remove();
        $('.picture-preview').addClass('hide');
    }
}


$(function () {
    $('#uploadModal form').submit(function (e) {
        e.preventDefault();
        showLoading();
        $image = $images.find('img');
        
        let url = base_url + 'Booking/upload_receipt';
        let data = new FormData(this);
        if ($image.length > 0) {
            data.append('file', $image[0].src);
        }
        
        ajaxPost(url, data)
            .then(result => { 
                showNotice(result.message, true) 
                $('#uploadModal').modal('hide');
                setTimeout(() => { location.reload(); }, 1000);
            })
            .catch(error => { showNotice(error.message, false) })
    });

    $('#reviewModal form').submit(function (e) {
        e.preventDefault();
        showLoading();

        let url = base_url + 'Booking/review';
        let data = new FormData(this);
        
        ajaxPost(url, data)
            .then(result => { 
                showNotice(result.message, true) 
                $('#reviewModal').modal('hide');
                setTimeout(() => { location.reload(); }, 1000);
            })
            .catch(error => { showNotice(error.message, false) })
    });
})

function viewComment(comment) {
    swal({
        title: '',
        text: comment,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: "Close",
    })
}

function viewAccount() {
    swal({
        title: '',
        title: $('#bank_account_details').html(),
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: "Close",
        html: true                
    });
}