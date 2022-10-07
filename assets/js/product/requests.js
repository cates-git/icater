
function actionRequest(id, request_status) {
    let msg = request_status == 2
                ? 'Approve seller\'s product request and add to product list'
                : 'Disapprove seller\'s product request';
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
        let url = base_url + 'products/Actions/set_request_status/' + id + '/' +request_status;
        ajaxPost(url)
            .then(result => {
                setTimeout(() => { location.reload(); }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

