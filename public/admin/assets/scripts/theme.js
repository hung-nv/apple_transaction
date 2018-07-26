"use strict";

$(function () {
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')}
    });

    setTimeout(function () {
        $(".alert-info").hide();
    }, 3000);
});