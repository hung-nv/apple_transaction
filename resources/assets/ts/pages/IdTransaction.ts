import {getParameterByName} from '../utilities/common/helpers';

declare var $;

export default class IdTransaction {
    public setUp() {
    }

    /**
     * Change page_size in url
     * @param event
     */
    public updatePageSize(event) {
        // get params
        let pageSize = $(event.target).val();
        let email = getParameterByName('email');

        // set default fail
        if (email === null) {
            email = '-1';
        }

        window.location.href = window.location.pathname + '?page_size=' + pageSize + '&email=' + email;
    }
}