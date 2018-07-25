import {confirmBeforeDelete} from '../utilities/common/helpers';

declare var $;
const ui = {};

export default class CreditCard {
    public setUp() {

    }

    public confirmDelete(event) {
        confirmBeforeDelete(event.target, 'Do you want to delete this?');
    }
}