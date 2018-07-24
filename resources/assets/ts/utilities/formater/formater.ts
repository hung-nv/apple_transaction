/**
 * Number Format x,xxx,xxx
 */
export function number_format(number, digit, dec_point = ',') {
    digit = typeof digit === 'undefined' ? 0 : digit;

    if(typeof number === "undefined" || number === '') {
        return '';
    }

    number = number.toString().replace(/,/g, '');

    if(! is_number_format(number)) {
        return '';
    }

    let numFloat = parseFloat(number),
        numInt = parseInt(number);

    if(digit == 0 && Math.abs(numFloat) - Math.abs(numInt) >= 0.5) {
        number = numFloat > 0 ? (numFloat + 1).toString() : (numFloat - 1).toString();
    }

    let numStringArray = number.split('.');
    let numAfter = parseFloat(typeof numStringArray[1] !== "undefined" ? '0.' + numStringArray[1] : '0').toFixed(digit);

    let _val_arr = digit > 0 ?
        parseFloat(number).toFixed(digit).split('.') : parseInt(number).toString().split('.'),
        result = '',
        _before = _val_arr[0],
        _negative = _before[0] === '-' ? '-' : '',
        _count = _before.length,
        new_number = '',
        first = true,
        i = _negative === '-' ? 1 : 0;

    for (i; i < _count; i++) {
        if(_before[i] === '0' && first) {
            continue;
        }
        new_number += _before[i];
        first = false;
    }

    _count = new_number.length;
    i = _count - 1;
    let k = 1;

    for (i; i >= 0; i--) {
        result = new_number[i] + result;
        if(k % 3 == 0 && k != _count) {
            result = dec_point + result;
        }
        k++;
    }

    let _after = (numAfter.toString()).substring(1);
    result = result == '' ? '0' : result;

    let returnNumber = result + _after;
    returnNumber = returnNumber !== '0' ? _negative + returnNumber : returnNumber;

    return returnNumber;
}

/**
 * Check is Number
 */
export function is_number_format(string) {
    let first = string.substring(0, 1);

    string = first == '-' ? string.substring(1) : string;

    let pattern = /^\d{1,3}((,){1}(\d){3})*(.?\d)*$/;

    return pattern.test(string);
}
