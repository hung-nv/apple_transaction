import {confirmBeforeDelete, getParameterByName, doException} from '../utilities/common/helpers';

declare var $;
declare var swal;
declare var require;

// Load the full build.
var _ = require('lodash');

// Declare variable.
let selectedIdPurchases = [];

/**
 * List Elements of view.
 * @type any
 */
const ui = {
    'urlDeleteSelectedIdPurchases': '/api/id-purchase/delete-all',
    'formPurchases': '#frmSearchIdPurchases',
    'chkIdPurchases': '.checkboxIdPurchase'
};

export default class IdPurchases {
    public setUp() {
        this.validateSearch();
    }

    public validateSearch() {
        $(ui.formPurchases).validate({
            rules: {
                'fail': {
                    number: true
                }
            },
            errorPlacement: (error, element) => {
                $('.text-error').append(error);
            }
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
     * Select id purchase.
     * @param event
     */
    public selectIdPurchase(event) {
        let element = $(event.target);
        if (element.is(':checked')) {
            // add id purchase to collection.
            selectedIdPurchases.push(element.data('id'));
            element.parents('tr').addClass("active");
        } else {
            // remove id purchase from collection.
            selectedIdPurchases.splice($.inArray(element.data('id'), selectedIdPurchases), 1);
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
     * Select all id purchases. in current page.
     */
    public selectAll(event) {
        let element = $(event.target);

        // set empty selected id purchases..
        selectedIdPurchases = [];

        // checked all id purchases..
        if (element.is(':checked')) {
            _.forEach($(ui.chkIdPurchases), element => {
                // push all id apple
                selectedIdPurchases.push($(element).data('id'));

                // checked id apple
                $(element).prop('checked', true);

                // active row has selected
                if (!$(element).parents('tr').hasClass('active')) {
                    $(element).parents('tr').addClass("active");
                }
            });
        } else {
            // uncheck all id purchases..
            _.forEach($(ui.chkIdPurchases), element => {
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
     * Delete selected id purchases.
     * @returns {any}
     */
    public deleteSelectedIdPurchases() {
        // if dont' have any selected id apple.
        if (!selectedIdPurchases.length) {
            return swal({
                type: 'error',
                title: 'Fail...',
                text: "You don't select any id purchase to delete!"
            });
        }

        // send ajax to delete
        $.ajax({
            url: ui.urlDeleteSelectedIdPurchases,
            method: 'post',
            data: {idPurchases: selectedIdPurchases}
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