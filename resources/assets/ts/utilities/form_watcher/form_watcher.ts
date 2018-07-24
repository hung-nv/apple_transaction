export {
    watchForm
}

declare var $, _;

// Store all origin values.
let old = [];

/**
 * Watch change of form.
 * @param className
 * @param color
 */
function watchForm (className, color) {
    $(() => {
        let $form = $(className);

        $form.find('input, select, textarea').each(function (index) {
            let $this = $(this);

            old[index] = {
                value: $this.val(),
                css: $this.css('background'),
            };

            $this.on('change',  _.debounce(() => {
                if ($this.val() == old[index]['value']) {
                    $this.css('background', old[index]['css']);
                } else {
                    $this.css('background', color);
                }
            }, 300));
        });
    });
}


