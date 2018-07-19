"use strict";

$(function () {
    $('#add-channel').on('submit', function (e) {
        var channel_url = $('#channel_url').val();
        var pattern = new RegExp('((http|https):\/\/|)(www\.|)youtube\.com\/(channel\/|user\/)[a-zA-Z0-9\-]{1,}');

        if (pattern.test(channel_url)) {
            var channelId = channel_url.split('/').pop();
            $.ajax({
                url: "https://www.googleapis.com/youtube/v3/channels",
                type: "get",
                async: false,
                data: {
                    part: 'snippet,contentDetails,statistics',
                    id: channelId,
                    key: 'AIzaSyD7SZNCb6bGSFqb2teULEFt5thV4B22Upg'
                },
                success: function (result) {
                    $.each(result.items, function (i, item) {
                        var channel_logo = item.snippet.thumbnails.default.url;
                        $('#channel_logo').val(channel_logo);
                        $('#channel_id').val(channelId);
                    });
                },
                error: function () {
                }
            });
        }
    });

    if ($('.page-analytics').length) {
        var channelId = $('#channel_id').val();

        $.ajax({
            url: "https://www.googleapis.com/youtube/v3/channels",
            type: "get",
            async: false,
            data: {part: 'contentDetails,statistics', id: channelId, key: 'AIzaSyD7SZNCb6bGSFqb2teULEFt5thV4B22Upg'},
            success: function (result) {
                $.each(result.items, function (i, item) {
                    var total_sub = item.statistics.subscriberCount;
                    var total_view = item.statistics.viewCount;
                    var total_video = item.statistics.videoCount;
                    $('.total_subscriber').html(numberWithCommas(total_sub));
                    $('.total_views').html(numberWithCommas(total_view));
                    $('.total_video').html(total_video);
                    var pid = item.contentDetails.relatedPlaylists.uploads;
                    getVids(pid)
                });
            }
        });
    }

    function getVids(pid) {
        var nextPageToken = '';
        var output = '';
        while (nextPageToken != null) {
            $.ajax({
                url: "https://www.googleapis.com/youtube/v3/playlistItems",
                type: "get",
                async: false,
                data: {
                    part: 'contentDetails',
                    playlistId: pid,
                    maxResults: 10,
                    key: 'AIzaSyD7SZNCb6bGSFqb2teULEFt5thV4B22Upg',
                    pageToken: nextPageToken
                },
                success: function (result) {
                    $.each(result.items, function (i, item) {
                        var videoId = item.contentDetails.videoId;
                        output += getViewById(videoId);
                    });
                    nextPageToken = result.nextPageToken;
                }
            });
        }

        $('.data-list-video').html(output);
    }

    function getViewById(videoId) {
        var title = '', view = 0, output = '';
        $.ajax({
            url: "https://www.googleapis.com/youtube/v3/videos",
            type: "get",
            async: false,
            data: {part: 'snippet,statistics', id: videoId, key: 'AIzaSyD7SZNCb6bGSFqb2teULEFt5thV4B22Upg'},
            success: function (result) {
                title = result.items[0].snippet.title;
                view = numberWithCommas(result.items[0].statistics.viewCount);
            }, complete: function () {
                output = '<tr class="odd gradeX"><td>' + title + '</td><td>' + view + '</td></tr>';
            }
        });
        return output;
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
});