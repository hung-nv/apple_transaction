import {confirmBeforeDelete} from '../utilities/common/helpers';

declare var $;
declare var _;
declare var swal;

// Declare variable.
let selectedIdApple = [];

/**
 * List Elements of view.
 * @type any
 */
const ui = {};

export default class idApple {
    public setUp() {

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

    public confirmDelete(event) {
        confirmBeforeDelete(event.target, 'Do you want to delete this?');
    }

    public selectIdApple(event) {
        let element = $(event.target);
        if(element.is(':checked')) {
            selectedIdApple.push(element.data('id'));
            element.parents('tr').addClass("active");
        } else {
            selectedIdApple.splice($.inArray(element.data('id'), selectedIdApple),1);
            element.parents('tr').removeClass("active");
        }
    }

    public selectAll() {
        let table = '';
        // table.find('.group-checkable').change(function () {
        //     var set = jQuery(this).attr("data-set");
        //     var checked = jQuery(this).is(":checked");
        //     jQuery(set).each(function () {
        //         if (checked) {
        //             $(this).prop("checked", true);
        //             $(this).parents('tr').addClass("active");
        //         } else {
        //             $(this).prop("checked", false);
        //             $(this).parents('tr').removeClass("active");
        //         }
        //     });
        // });
    }
}