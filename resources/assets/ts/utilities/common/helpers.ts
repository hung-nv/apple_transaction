declare var swal;

/**
 * Alert before delete
 * @param message
 */
export function confirmBeforeDelete(message) {
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
        $(this).parent().submit();
    });
}