import {confirmBeforeDelete} from '../utilities/common/helpers';

declare var $;

export default class IphoneInformation {
    public setUp() {

    }

    public confirmDelete(event) {
        confirmBeforeDelete(event.target, 'Do you want to delete this?');
    }
}