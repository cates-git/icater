
function notifySeller(id) {
    let msg = 'Notify the seller that his/her product was booked';
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
        let url = base_url + 'Booking/notify_seller/' + id;
        ajaxPost(url)
            .then(result => {
                setTimeout(() => { location.reload(); }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

