import {doException} from '../utilities/common/helpers';

declare var $;
declare var swal;
declare var require;


export default class CreateIdApple {
    public setUp() {
        this.createIdApple();
    }

    /**
     * Check exist iphone information before create id apples.
     */
    public createIdApple() {
        $.ajax({
            method: 'get',
            url: '/api/checkIphoneInformation'
        }).done(respon => {
            if (respon.message === 'ok') {
            } else {
                swal({
                    type: 'error',
                    title: 'Fail...',
                    html: 'You must <a href="' + respon.url + '">create iPhone Information</a> first.'
                });
            }

        }).fail(xhr => {
            doException(xhr);
        });
    }
}