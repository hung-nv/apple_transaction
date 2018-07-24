"use strict";

$(function () {
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')}
    });

    setTimeout(function () {
        $(".alert-info").hide();
    }, 3000);
});

function pageDatatable(idSelected) {
    $(idSelected).dataTable({
        ordering: false,
        order: [[0, 'desc']],
        bLengthChange: true,
        bFilter: true
    });
}

function confirmBeforeDelete(idWrapSelected, message) {
    if(message === undefined || message === null) {
        message = '';
    }
    $(idWrapSelected).on('click', '.btn-delete', function () {
        var self = $(this);
        swal({
            title: 'Are you sure?',
            text: message,
            type: 'warning',
            showCancelButton: true,
            customClass: 'nvh-dialog',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            self.parent().submit();
        });
    });
}