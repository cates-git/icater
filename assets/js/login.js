
$(function () {
    $('#sign_in').submit(function(e) {
        e.preventDefault();

        showLoading();
            
        let url = base_url + 'Login/sign_in';
        let data = $(this).serialize();
        ajaxPost(url, data)
            .then(result => { window.location = base_url + 'account'; })
            .catch(error => { showNotice(error.message, false) })
    });
})