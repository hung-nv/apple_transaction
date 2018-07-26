declare var swal;

/**
 * Alert before delete
 * @param el
 * @param message
 */
export function confirmBeforeDelete(el, message) {
    if (message === undefined || message === null) {
        message = '';
    }
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
        $(el).parent().submit();
    });
}

/**
 * Get param in url
 * @param name
 * @returns {string} | null
 */
export function getParameterByName(name) {
    let match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

/**
 * Work with ajax error.
 * @param xhr
 */
export function doException(xhr) {
    if (xhr.status === 402) {
        // Auth error.
        window.location.href = xhr.responseJSON;
    } else if (xhr.responseJSON) {
        // console.log(xhr)
    } else {
        swal({
            type: 'error',
            title: 'Something went wrong...',
            text: xhr.statusText,
        });
    }
}