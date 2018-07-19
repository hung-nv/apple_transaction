"use strict";
$(function () {
    var wrapCategory, wrapCustom, wrapPages, url, domain, menuGroup;
    url = window.location;
    wrapCategory = $('.wrap-menu-category');
    wrapPages = $('.wrap-menu-pages');
    wrapCustom = $('.wrap-menu-custom');
    menuGroup = $('#list-menu-item').val();

    if(url.port) {
        domain = url.protocol + '//' + url.hostname + ':' + url.port
    } else {
        domain = url.protocol + '//' + url.hostname;
    }

    $('#theme-select-menu').on('click', function () {
        menuGroup = $('#list-menu-item').val();
        if(menuGroup !== null && menuGroup !== '') {
            location.href = domain + '/administrator/menu?menu_group=' + menuGroup;
        }
    });

    if($('#add-menu').length) {
        var urlPost, message;
        urlPost = '/api/add-menu';

        $('#ajax-add-menu').on('click', function () {
            $.ajax({
                url: urlPost,
                type: 'post',
                dataType: 'json',
                data: {name: $('#menu-name').val()},
                success: function (data) {
                    toastr.info(data.message);
                }, error: function (xhr) {
                    if(xhr.status === 402) {
                        message = xhr.responseJSON.message;
                    } else {
                        message = xhr.statusText;
                    }
                    toastr.warning(message);
                }, complete: function () {
                    $('#selected-menu').load(domain + '/api/get_list_menu');
                    $('#add-menu').modal('toggle');
                }
            });
        })
    }

    if(wrapCategory.length) {
        wrapCategory.on('click', '#add-category', function () {
            var idsCategory;
            if(menuGroup === null || menuGroup === '') {
                callBeforeAddMenu();
                return false;
            }
            idsCategory = $('input[name="parent[]"]:checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if(idsCategory.length) {
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: domain + '/api/add-category',
                    data: {ids: idsCategory, menu_group: menuGroup},
                    success: function(result) {
                        $("#nestable_list_2").load(domain + "/api/get-menu?menu_group=" + menuGroup);
                    },
                    error: function() {

                    }
                });
            }
        });
    }

    if(wrapPages.length) {
        wrapPages.on('click', '#add-page', function () {
            var idsPages;
            if(menuGroup === null || menuGroup === '') {
                callBeforeAddMenu();
                return false;
            }
            idsPages = $('input[name="page[]"]:checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if(idsPages.length) {
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: domain + '/api/add-page',
                    data: {ids: idsPages, menu_group: menuGroup},
                    success: function(result) {
                        $("#nestable_list_2").load(domain + "/api/get-menu?menu_group=" + menuGroup);
                    },
                    error: function() {

                    }
                });
            }
        });
    }

    if(wrapCustom.length) {
        wrapCustom.on('click', '#add-custom', function () {
            var label, direct, formCustom;
            if(menuGroup === null || menuGroup === '') {
                callBeforeAddMenu();
                return false;
            }
            label = wrapCustom.find('.custom-label');
            direct = wrapCustom.find('.custom-url');
            formCustom = $('#frm-custom-menu');

            formCustom.validate();

            if(formCustom.valid()) {
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: domain + '/api/add-custom',
                    data: {label: label.val(), url: direct.val(), menu_group: menuGroup},
                    success: function(result) {
                        $("#nestable_list_2").load(domain + "/api/get-menu?menu_group=" + menuGroup);
                    },
                    error: function() {

                    }
                });
            }
        });
    }

    $('#nestable_list_2').on('click', '.delete-item', function () {
        var id;
        id = $(this).data('id');
        swal({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            customClass: 'nvh-dialog',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                type: "post",
                dataType: 'json',
                url: domain + '/api/delete-menu',
                data: {id: id, menu_group: menuGroup},
                success: function(result) {
                    toastr.info(result.message);
                    $("#nestable_list_2").load(domain + "/api/get-menu?menu_group=" + menuGroup);
                },
                error: function() {
                }
            });
        });
    });
    
    function callBeforeAddMenu() {
        swal(
            'Invalid',
            'Please create menu before to do this action!',
            'error'
        );
    }
});