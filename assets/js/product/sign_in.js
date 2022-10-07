
$(function () {
    if (create) {
        $('#user-signin').addClass('hide');
        $('#user-register').removeClass('hide');
    }
    
    $('#user-register input[name=type]').change(function (e) {
        let type = parseInt(this.value)
        if (type === 1) {
            $('.type-seller').removeClass('hide');
            $('.type-customer').addClass('hide');
        } else if (type === 2) {
            $('.type-seller').addClass('hide');
            $('.type-customer').removeClass('hide');
        }
    });

    $('form').submit(function (e) {
        e.preventDefault();
        showLoading();
        
        let url = $(this).attr('action');
        let data = new FormData(this);
        
        ajaxPost(url, data)
            .then(result => {
                // showNotice(result.message, true);
                window.location = base_url + 'account';
            })
            .catch(error => { showNotice(error.message, false) })
    });
})