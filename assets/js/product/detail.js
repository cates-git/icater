$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('[name=event_date]').attr('min', maxDate);
});

function viewImage (src) {
    $('#image-preview').attr('src', src);
}

function orderService () {
    
    // check if logged in and user type is customer
    let url = base_url + 'Booking/customer_signed_in';
    showLoading();
    
    ajaxPost(url)
        .then(result => {
            $('#customer-book').modal();
            // bookService()
        })
        .catch(error => { 
            // show sign in or register
            // closeLoading()
            $('#customer-register').modal();
        })
        .finally(() => closeLoading())
}

function bookService () {
    let event_date = $('[name=event_date]').val();
    let event_address = $('[name=event_address]').val();
    let event_time = $('[name=event_time]').val();
    swal({
        title: "REQUEST SERVICE",
        text: `Please confirm if you want to continue ordering the service<br>
        <b>Event date: </b>` + event_date +`<br>
        <b>Event time: </b>` + event_time +`<br>
        <b>Event address: </b>` + event_address,
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Confirm",
        closeOnConfirm: false,
        html: true   
    }, function () {
        $('#customer-book').modal('hide');
        showLoading();
        let url = base_url + 'Booking/order_service/' + product_id;
        let data = new FormData();
        data.append('event_date', event_date);
        data.append('event_time', event_time);
        data.append('event_address', event_address);
        ajaxPost(url, data)
            .then(result => { 
                setTimeout(() => { 
                    location.href = base_url + 'product/ordered/'; 
                }, 1000);
                showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
}

$(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        showLoading();
        
        let url = $(this).attr('action');
        let data = new FormData(this);
        
        ajaxPost(url, data)
            .then(result => { 
                // bookService();
                closeLoading();
                $('#customer-book').modal();
                $('#customer-register').modal('hide');
                $('#customer-signin').modal('hide');
                // showNotice(result.message, true) 
            })
            .catch(error => { showNotice(error.message, false) })
    });
})