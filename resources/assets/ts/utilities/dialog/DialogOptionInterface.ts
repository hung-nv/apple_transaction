
export default interface DialogOptionInterface {
    /**
     * Mode of dialog
     *  type dialog: only Ok buttom.
     *  type comfirm: have Cancel & Ok buttom.
     *  type custom: custom define your buttons.
     *  default id dialog.
     */
    mode?: string;

    /**
     * Class name of dialog.
     */
    className?: string;

    /**
     * Message of dialog.
     */
    message: string;

    /**
     * Use with mode is custom.
     * Order of button in array is showing order.
     */
    buttons?: [
        {
            label: string;
            event: Function;
        }
    ];

    // Customize button Ok.
    buttonOk?: {
        label?: string;
        order?: Number;
        event?: Function;
    };

    // Custom button cancel.
    buttonCancel?: {
        label?: string;
        order?: Number;
        event?: Function;
    };
}
