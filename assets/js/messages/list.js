function sendMessage () {
    showLoading();
    let url = base_url + 'Messages/send/';
    let data = new FormData();
    data.append('message', $('textarea[name=message]').val());
    data.append('receiver', $('input[name=receiver]').val());
    ajaxPost(url, data)
        .then(result => { 
            setTimeout(() => { location.reload() }, 1000);
            showNotice(result.message, true) 
        })
        .catch(error => { showNotice(error.message, false) })
}