import dialog from './dialog';

// Open dialog message with only OK button.
dialog.open({message: 'message content'});

// Open dialog message with only OK button. Custom event when click OK.
dialog.open({
    message: 'message content',
    className: 'm-myPageDialog',
    buttonOk: {
        event: () => {
            console.log('You have clicked OK button!');

            // Close dialog.
            dialog.close();
        }
    }
});

// Open confirm dialog. Custorm buttol label.
dialog.open({
    mode: 'confirm',
    message: 'message content',
    buttonCancel: {
        label: 'No',
        event: () => {
            console.log('You have clicked Cancel button!');

            // Close dialog.
            dialog.close();
        }
    },
    buttonOk: {
        label: 'Yes',
        event: () => {
            console.log('You have clicked OK button!');

            // Close dialog.
            dialog.close();
        }
    }
});

// Open custom dialog with your button list.
dialog.open({
    mode: 'custom',
    message: 'message content',
    buttons: [
        {
            label: 'Button 01',
            event: () => {
                console.log('You have clicked Button 01!');

                dialog.close()
            },
        },
        {
            label: 'Button 02',
            event: () => {
                console.log('You have clicked Button 02!');

                dialog.close()
            },
        },
        {
            label: 'Button 03',
            event: () => {
                console.log('You have clicked Button 03!');

                dialog.close()
            },
        }
    ]
});
