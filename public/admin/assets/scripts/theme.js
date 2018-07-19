"use strict";

$(function () {
    var postUpdateForm, pageUpdateForm, domain, port;
    port = '';
    if (window.location.port) {
        port = ':' + window.location.port
    }
    domain = window.location.protocol + '//' + window.location.hostname + port;

    postUpdateForm = $('#post-upate-form');
    pageUpdateForm = $('#page-update-form');

    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')}
    });

    setTimeout(function () {
        $(".alert-info").hide();
    }, 3000);

    if ($('#add-size').length) {
        $('#ajax-size').on('click', function () {
            $.ajax({
                url: '/administrator/attributeValue',
                type: 'post',
                dataType: 'json',
                data: {attr_value: $('#attr-size').val(), attribute_id: '2'},
                success: function (data) {
                    var msg = data.message;
                    var alert = $('#add-size').find('.alert');
                    if (alert) {
                        alert.removeClass('hidden');
                        alert.addClass('alert-info');
                        alert.html(msg);
                    }
                }, error: function (data) {
                    var errors = data.responseJSON.message.attr_value[0];
                    var alert = $('#add-size').find('.alert');
                    if (alert) {
                        alert.removeClass('hidden');
                        alert.addClass('alert-danger');
                        alert.html(errors);
                    }
                }, complete: function () {
                    $('#multi-append-size').load(domain + '/api/get_size/2');
                }
            });
        });
    }

    if ($('#add-color').length) {
        $('#ajax-color').on('click', function () {
            $.ajax({
                url: '/administrator/attributeValue',
                type: 'post',
                dataType: 'json',
                data: {attr_value: $('#attr-color').val(), attribute_id: '1'},
                success: function (data) {
                    var msg = data.message;
                    var alert = $('#add-color').find('.alert');
                    if (alert) {
                        alert.removeClass('hidden');
                        alert.addClass('alert-info');
                        alert.html(msg);
                    }
                }, error: function (data) {
                    var errors = data.responseJSON.message.attr_value[0];
                    var alert = $('#add-color').find('.alert');
                    if (alert) {
                        alert.removeClass('hidden');
                        alert.addClass('alert-danger');
                        alert.html(errors);
                    }
                }, complete: function () {
                    $('#multi-append-color').load(domain + '/api/get_size/1');
                }
            });
        });
    }

    if (postUpdateForm.length) {
        postUpdateForm.on('fileclear', function (event) {
            $(".kv-file-remove").trigger("click");
        });
    }

    if (pageUpdateForm.length) {
        pageUpdateForm.on('fileclear', function (event) {
            $(".kv-file-remove").trigger("click");
        });
    }
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

function errorProcess(xhr) {
    var message;
    if(xhr.status === 500) {
        message = xhr.responseJSON.message;
    } else {
        message = xhr.statusText;
    }
    toastr.error(message);
}

var setImagePreview = {
    init: function (idFile, urlDelete, extractName) {
        var url, pathname, imgUrl, oldImage, oldImageValue, port, id;
        port = '';
        url = window.location;
        if (url.port) {
            port = ':' + url.port
        }
        oldImage = $('#old_' + idFile);
        oldImageValue = oldImage.val();
        if (oldImageValue !== undefined && oldImageValue !== '') {
            imgUrl = url.protocol + '//' + url.hostname + port + oldImageValue;
            pathname = oldImageValue.replace(/^.*[\\\/]/, '');
            id = oldImage.data('id');
        }

        if (extractName === undefined || extractName === '') {
            extractName = null;
        }

        $("#" + idFile).fileinput({
            allowedFileExtensions: ["jpg", "png"],
            browseLabel: "Select Image",
            showCaption: false,
            autoReplace: true,
            maxFileCount: 1,
            maxFileSize: 2048,
            uploadAsync: false,
            initialPreview: [
                imgUrl
            ],
            showClose: false,
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: pathname, width: "120px", downloadUrl: false, key: id, extra: {name: extractName}}
            ],
            deleteUrl: urlDelete,
            purifyHtml: true
        });
    },
    update: function (idFile, urlDelete) {
        var pathname, image, oldImage, oldImageValue, imgPreview, imgPreviewConfig;
        imgPreview = [];
        imgPreviewConfig = [];
        oldImage = $('#old_' + idFile);
        oldImageValue = oldImage.val();
        if (oldImageValue !== undefined && oldImageValue !== '') {
            // set array imgPreview and array previewConfig
            $.each(oldImageValue.split('|'),function(index,img){
                image = img.split(':');
                if(image.length) {
                    imgPreview.push(image[0]);
                    pathname = image[0].replace(/^.*[\\\/]/, '');
                    imgPreviewConfig.push({caption: pathname, width: "120px", downloadUrl: false, key: image[1]});
                }
            });
        }

        $("#" + idFile).fileinput({
            uploadUrl: '/file-upload',
            allowedFileExtensions: ["jpg", "png"],
            browseLabel: "Select Image",
            showCaption: false,
            overwriteInitial: false,
            maxFileCount: 6,
            maxFileSize: 2048,
            initialPreview: imgPreview,
            showClose: false,
            initialPreviewAsData: true,
            showUpload: false,
            initialPreviewFileType: 'image',
            initialPreviewConfig: imgPreviewConfig,
            deleteUrl: urlDelete,
            fileActionSettings: {
                "showUpload": false,
            },
            purifyHtml: true
        });
    }
};