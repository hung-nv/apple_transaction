declare var $;
declare var moment;
declare var _;

export default function () {
    /**
     * Check special character.
     */
    $.validator.addMethod('special_character', (value) => {
        return !/\%|\_|\\|\//.test( value );
    });
    

    /**
     *  Validate require number int [0, data-max]
     */
    $.validator.addMethod('unique_in', (value, element, params) => {
        let valid = true;

        let $element = $(element);

        $(params).each(function () {
            if (! $element.is($(this)) && this.value === value && valid) {
                valid = false;
            }
        });

        return valid;
    });

    /**
     * Validate input result numeric in range lower and upper
     */
    $.validator.addMethod('range_result', (value, element, params) => {
        let valid = true;
        let attribute = $(element).data('attribute').split('.');
        let rowFind = _.find(params.data, {'id': Number(attribute[1])});
        if(value!= '' && rowFind.lower != '' && rowFind.upper != '') {
            let lower = Number(rowFind.lower.replace(/,/g, ''));
            let upper = Number(rowFind.upper.replace(/,/g, ''));
            if(Number(value) < lower || Number(value) > upper) {
                valid = false;
            }
        }

        return valid;
    });

    /**
     * Validate input must smaller than other input.
     */
    $.validator.addMethod('smaller_than', (value, element, params) => {
        let paramValue = $(`[name=${params}]`).val();
        if (paramValue !== '') {
            let maxValue = parseFloat(paramValue.replace(/,/g, ''));
            let thisValue = parseFloat(value.replace(/,/g, ''));

            return (value === '' || thisValue < maxValue);
        } else {
            return true;
        }
    });

    /**
     * Validate input must between.
     */
    $.validator.addMethod('between', (value, element, params) => {
        let start = parseFloat($('.m-between-parent-start').val().replace(/,/g , ''));
        let end = parseFloat($('.m-between-parent-end').val().replace(/,/g , ''));

        let thisValue = parseFloat(value.replace(/,/g , ''));

        return (value === '' || (thisValue >= start && thisValue <= end));
    });

    /**
     * Validate range of weekly.
     */
    $.validator.addMethod('range_of_weekly', (value, element, params) => {
        let weekly_start = moment(value);
        let weekly_end = moment($(`[name=${params[1]}]`).val());

        if (Math.abs(weekly_end.diff(weekly_start, 'days')) < params[0]) {
            return false;
        } else {
            return true;
        }
    });

    /**
     * Validate range of monthly.
     */
    $.validator.addMethod('range_of_monthly', (value, element, params) => {
        let weekly_start = moment(value);
        let weekly_end = moment($(`[name=${params[1]}]`).val());

        if (Math.abs(weekly_end.diff(weekly_start, 'days')) < params[0]) {
            return false;
        } else {
            return true;
        }
    });
}
