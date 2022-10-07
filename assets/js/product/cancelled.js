
function setStatus(id, status) {
    let msg = 'Order will be cancelled';
    if (status == 1) { // approve
        msg = 'Approve customer\'s order';
    } else if (status == 2) {
        msg = 'Disapprove customer\'s order';
    } else if (status == 0) {
        msg = 'Re order service';
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

function deleteOrder(id) {
    swal({
        title: "Are you sure?",
        text: "Order will be deleted",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'Booking/delete_order/' + id;
        ajaxPost(url)
            .then(result => {
                setTimeout(() => { location.reload(); }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}
