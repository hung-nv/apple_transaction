$(function () {
    var pageIdApple = $('#idApple');
    if(pageIdApple.length) {
        pageIdApple.on('click', '#create-id-apple', function () {
            $.ajax({
                method: 'get',
                url: '/api/checkIphoneInformation'
            }).done(respon => {
                if(respon.message === 'ok') {
                    window.location.href = respon.url;
                } else {
                    swal({
                        type: 'error',
                        title: 'Fail...',
                        html: 'You must <a href="' + respon.url + '">create iPhone Information</a> first.'
                    })
                }

            }).fail(xhr => {
                if (xhr.status === 402) {
                    // Auth error.
                    window.location.href = xhr.responseJSON;
                } else if (xhr.responseJSON) {
                    // console.log(xhr)
                } else {
                    swal({
                        type: 'error',
                        title: 'Something went wrong...',
                        text: xhr.statusText,
                    });
                }
            });
        });
    }
});
