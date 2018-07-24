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