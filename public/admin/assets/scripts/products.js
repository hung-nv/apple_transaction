"use strict";

$(function () {
    var wrapProducts, url, domain;
    wrapProducts = $('#data-products');
    url = window.location;

    if(url.port) {
        domain = url.protocol + '//' + url.hostname + ':' + url.port
    } else {
        domain = url.protocol + '//' + url.hostname;
    }

    if(wrapProducts.length) {
        // open popup for add product to event
        wrapProducts.on('click', '#open-popup-event', function () {
            var productId, modalEvent;

            modalEvent = $('#add-event');
            productId = $(this).data('id');

            $('#id_product_event').val(productId);
            modalEvent.modal('show');
        });

        // add product to event
        $('#add-event').on('click', '#add-to-event', function () {
            var productId, eventId;
            productId = $('#id_product_event').val();
            eventId = $('#id_event').val();
            if(productId === undefined || eventId === undefined) {
                return;
            }

            $.ajax({
                type: "post",
                dataType: "json",
                url: domain + '/api/add-product-event',
                data: {product_id: productId, event_id: eventId},
                success: function (result) {
                    toastr.info(result.message);
                },
                error: function (xhr) {
                    errorProcess(xhr);
                },
                complete: function () {
                    $('#add-event').modal('hide');
                }
            })
        });

        // show list product images
        wrapProducts.on('click', '.change-cover', function () {
            var wrapImages;
            wrapImages = $(this).parents('.td-product-img').find('.product-image-thumb');
            if(wrapImages.is(":visible")) {
                wrapImages.hide();
            } else {
                wrapImages.show();
            }
        });

        // change product image cover
        wrapProducts.on('click', '.img-thumb', function () {
            var coverImg, srcImg, message, self, productId, currentImg, wrapImages;
            self = $(this);
            coverImg = self.data('img');
            productId = self.data('id');
            srcImg = self.children().attr('src');
            if(coverImg === undefined || srcImg === undefined) {
                return;
            }

            $.ajax({
                type: "post",
                dataType: 'json',
                async: false,
                url: domain + '/api/set-cover-product',
                data: {image: coverImg, product_id: productId},
                success: function(result) {
                    toastr.info(result.message);
                },
                error: function (xhr) {
                    errorProcess(xhr);
                },
                complete: function () {
                    currentImg = self.parents('.td-product-img').find('.backend-img').children();
                    wrapImages = self.parents('.td-product-img').find('.product-image-thumb');
                    wrapImages.hide();
                    currentImg.attr('src', srcImg);
                }
            });
        });
    }
});