import {confirmBeforeDelete} from '../utilities/common/helpers';

declare var $;

export default class Users {
    public setUp() {

    }

    public confirmDelete(event) {
        confirmBeforeDelete(event.target, 'Do you want to delete this?');
    }
}