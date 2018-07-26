import {confirmBeforeDelete, getParameterByName, doException} from '../utilities/common/helpers';

declare var $;
declare var swal;
declare var require;

// Load the full build.
var _ = require('lodash');

// Declare variable.
let selectedIdApple = [];

/**
 * List Elements of view.
 * @type any
 */
const ui = {
    'urlDeleteSelectedIdApples': '/api/apple/delete-all'
};

export default class idApple {
    public setUp() {

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
                window.location.href = respon.url;
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

    /**
     * Confirm before delete.
     * @param event
     */
    public confirmDelete(event) {
        confirmBeforeDelete(event.target, 'Do you want to delete this?');
    }

    /**
     * Select id apple.
     * @param event
     */
    public selectIdApple(event) {
        let element = $(event.target);
        if (element.is(':checked')) {
            selectedIdApple.push(element.data('id'));
            element.parents('tr').addClass("active");
        } else {
            selectedIdApple.splice($.inArray(element.data('id'), selectedIdApple), 1);
            element.parents('tr').removeClass("active");
        }
    }

    /**
     * Change page_size in url
     * @param event
     */
    public updatePageSize(event) {
        // get params
        let pageSize = $(event.target).val();
        let fail = getParameterByName('fail');

        // set default fail
        if (fail === null) {
            fail = '-1';
        }

        window.location.href = window.location.pathname + '?page_size=' + pageSize + '&fail=' + fail;
    }

    /**
     * Select all id apples in current page.
     */
    public selectAll(event) {
        let element = $(event.target);

        // set empty selected id apples.
        selectedIdApple = [];

        // checked all id apples.
        if (element.is(':checked')) {
            _.forEach($('.checkboxIdApple'), element => {
                // push all id apple
                selectedIdApple.push($(element).data('id'));

                // checked id apple
                $(element).prop('checked', true);

                // active row has selected
                if (!$(element).parents('tr').hasClass('active')) {
                    $(element).parents('tr').addClass("active");
                }
            });
        } else {
            // uncheck all id apples.
            _.forEach($('.checkboxIdApple'), element => {
                // uncheck id apple.
                $(element).prop('checked', false);

                // active row has selected
                if ($(element).parents('tr').hasClass('active')) {
                    $(element).parents('tr').removeClass("active");
                }
            });
        }
    }

    /**
     * Delete selected id apple.
     * @returns {any}
     */
    public deleteSelectedIdApples() {
        // if dont' have any selected id apple.
        if (!selectedIdApple.length) {
            return swal({
                type: 'error',
                title: 'Fail...',
                text: "You don't select any id apple to delete!"
            });
        }

        // send ajax to delete
        $.ajax({
            url: ui.urlDeleteSelectedIdApples,
            method: 'post',
            data: {idApples: selectedIdApple}
        }).done(respon => {
            swal(
                'Successful!',
                respon.message,
                'success'
            ).then(function () {
                window.location.href = respon.url;
            });
        }).fail((xhr) => {
            doException(xhr);
        });
    }
}