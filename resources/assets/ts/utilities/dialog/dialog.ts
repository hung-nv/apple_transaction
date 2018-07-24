import DialogOptionInterface from './DialogOptionInterface'

declare var _;

declare var $;

// Template of dialog.
let template = `
    <div class="m-dialog-modal m-js-dialog <%- className %>">
        <div class="modal-dialog m-dialogSmall">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-dialogMessage"><%= message %></div>
                </div>
                <div class="modal-footer">
                    <% _.forEach(buttons, function(button) { %>
                        <button type="button" class="m-buttonPrimary <%- button.className %>"><%- button.label %></button>
                    <% }); %>
                </div>
            </div>
        </div>
    </div>`;

// Dialog object.
let dialog:any = Object;

// Container of element dialog in jquery.
let el:any;

// Get cofig button OK.
let getButtonOk = function (option) {
    return {
        className: 'm-dialogButtonOk',
        label: _.get(option, 'buttonOk.label', 'OK'),
        event: _.get(option, 'buttonOk.event')
    }
};

// Get config button cancel.
let getButtonCancel = function (option) {
    return {
        className: 'm-buttonCancel',
        label: _.get(option, 'buttonCancel.label', 'キャンセル'),
        event: _.get(option, 'buttonCancel.event')
    }
};

// Get config of list button mode custom.
let getButtons = function (option) {
    let buttons = [];

    for (let index in option.buttons) {
        let buttonOption = option.buttons[index];
        let button = {
            className: typeof buttonOption.className !== 'undefined' ?  buttonOption.className : ('m-dialogButton' + (index + 1)),
            label: buttonOption.label,
            event: buttonOption.event,
        };
        buttons.push(button);
    }

    return buttons;
};

// Difine method dialog open.
dialog.open = function (option: DialogOptionInterface) {
    // Set default mode.
    if (typeof option.className === 'undefined') {
        option.className = 'mainJsDialog';
    }

    // Set default mode.
    if (typeof option.mode === 'undefined') {
        option.mode = 'dialog';
    }

    let buttons: Array<Object> = [];

    // Check mode of dialog.
    switch (option.mode) {
        case 'dialog':
            buttons = [getButtonOk(option)];
            break;

        case 'confirm':
            if (_.get(option, 'buttonCancel.order', 1) > _.get(option, 'buttonOk.order', 1)) {
                buttons = [getButtonOk(option), getButtonCancel(option)];
            } else {
                buttons = [getButtonCancel(option), getButtonOk(option)];
            }
            break;

        case 'custom':
            buttons = getButtons(option);
            break;
    }

    // Compile template to html
    let compiled = _.template(template);

    let html = compiled({'className': option.className, 'message': option.message, 'buttons': buttons });

    // Add dialog to html document,
    let modal = $(html).appendTo('body');

    modal.modal('show');

    // Extra new method close.
    modal.close = () => {modal.modal('hide')};

    // Register buttons events.
    for (let index in buttons) {
        let button:any = buttons[index];

        if(!button.event) button.event = modal.close;

        modal.find('.' + button.className).click(button.event);
    }

    modal.on("hidden.bs.modal", () => { modal.remove() });

    el = modal;

    return modal;
};

dialog.close = () => {el.modal('hide')};

export default dialog;
