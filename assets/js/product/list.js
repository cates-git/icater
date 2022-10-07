
let $editModal = $('#editModal');
$(function () {

    $('form').submit(function(e){
        e.preventDefault();
        showLoading();

        let url = base_url + 'products/Actions/set_status/';
        let data = new FormData(this);
        
        ajaxPost(url, data)
            .then(result => { 
                let status = $editModal.find('[name=status]').find(':selected').val();
                let product_id = $editModal.find('#product_id').val();
                $('.status-'+product_id).html(status == 1 ? 'Available' : 'Unavailable')
                $editModal.modal('hide');
                showNotice(result.message, true);
            })
            .catch(error => { showNotice(error.message, false) })
    })
})

function setStatus(product_id, status) {
    $editModal.modal('show');
    $editModal.find('#product_id').val(product_id);
    // $editModal.find('[name=status]').val(status);

}

function deleteProduct (product_id) {
    swal({
        title: "Delete product?",
        text: "The product might have booked by a customer",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
    }, function () {
        showLoading();
        let url = base_url + 'products/Actions/delete/' + product_id;
        ajaxPost(url)
            .then(result => { 
                setTimeout(() => { 
                    location.reload() 
                }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}