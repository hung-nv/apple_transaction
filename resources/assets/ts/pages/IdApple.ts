import {confirmBeforeDelete} from '../utilities/common/helpers';

declare var $;
declare var _;
declare var viewData;
declare var swal;

// Declare variable.
let planData = [];

/**
 * List Elements of view.
 * @type any
 */
const ui = {
    'inputCalender': '.m-inputCalenderIndex',
};

export default class idApple {
    public setUp() {
        confirmBeforeDelete('Do you want to delete this?');
    }

    public createIdApple() {
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
    }
}