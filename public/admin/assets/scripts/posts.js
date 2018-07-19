"use strict";

$(function () {
    var wrapPosts, url, domain;

    wrapPosts = $('#data-posts');
    url = window.location;

    if(url.port) {
        domain = url.protocol + '//' + url.hostname + ':' + url.port
    } else {
        domain = url.protocol + '//' + url.hostname;
    }

    if(wrapPosts.length) {
        wrapPosts.on('click', '.set-groups', function () {
            var groupId, groupName, postId, message, self;
            self = $(this);
            groupId = $(this).data('group-id');
            groupName = $(this).data('group-name');
            postId = $(this).data('post');

            if(groupId === undefined || groupName === undefined || postId === undefined) {
                return;
            }

            $.ajax({
                type: "post",
                dataType: 'json',
                async: false,
                url: domain + '/api/set-post-group',
                data: {post_id: postId, group_id: groupId, group_label: groupName},
                success: function(result) {
                    toastr.info(result.message);
                },
                error: function (xhr) {
                    if(xhr.status === 500) {
                        message = xhr.responseJSON.message;
                    } else {
                        message = xhr.statusText;
                    }
                    toastr.error(message);
                },
                complete: function () {
                    createContainerChecked(self);
                }
            });
        });

        wrapPosts.on('click', '.remove-group', function () {
            var groupId, groupName, postId, message, self;
            self = $(this);
            groupId = $(this).data('group-id');
            groupName = $(this).data('group-name');
            postId = $(this).data('post');

            if(groupId === undefined || groupName === undefined || postId === undefined) {
                return;
            }

            $.ajax({
                type: "post",
                dataType: 'json',
                async: false,
                url: domain + '/api/remove-post-group',
                data: {post_id: postId, group_id: groupId, group_label: groupName},
                success: function(result) {
                    toastr.warning(result.message);
                },
                error: function (xhr) {
                    if(xhr.status === 500) {
                        message = xhr.responseJSON.message;
                    } else {
                        message = xhr.statusText;
                    }
                    toastr.error(message);
                },
                complete: function () {
                    createContainerSet(self);
                }
            });
        });
    }
    
    function createContainerChecked(container) {
        var iconCheck, buttonCheck, buttonRemove, iconRemove, wrapContainer;

        iconCheck = $('<i>').addClass('fa fa-check');
        buttonCheck = $('<a>').addClass('btn btn-xs blue check-group');
        buttonRemove = $('<a>').addClass('btn btn-xs red remove-group')
            .attr('data-group-id', container.data('group-id'))
            .attr('data-group-name', container.data('group-name'))
            .attr('data-post', container.data('post'));
        iconRemove = $('<i>').addClass('fa fa-times');
        buttonCheck.append(iconCheck).append(' ' + container.data('group-name'));
        buttonRemove.append(iconRemove);

        wrapContainer = container.parent();
        wrapContainer.html('');
        wrapContainer.append(buttonCheck)
            .append(buttonRemove);
    }
    
    function createContainerSet(container) {
        var wrapContainer, buttonSetGroup;

        wrapContainer = container.parent();

        buttonSetGroup = $('<button>').addClass('btn btn-xs grey-cascade set-groups')
            .attr('data-group-id', container.data('group-id'))
            .attr('data-group-name', container.data('group-name'))
            .attr('data-post', container.data('post'))
            .text('Set to "' + container.data('group-name') + '"');
        wrapContainer.html('');
        wrapContainer.append(buttonSetGroup)
    }
});