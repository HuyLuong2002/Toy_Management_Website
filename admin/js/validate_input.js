function checkSearchInput(input) {
    const regex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+/i;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if (isMatch == true || input[0] == "0") {
        return false;
    }
}

function checkAddAndEdit(input) {
    const regex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+/i;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if (isMatch == true) {
        return false;
    }
    else return true;
}

function checkAddAndEditProvider(input) {
    const regex = /[!@#$%^&*()_+\=[\]{};':"\\|,.<>/?]+/i;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if (isMatch == true) {
        return false;
    }
    else return true;
}

function checkAddAndEditPrice(input) {
    const regex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+/i;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if (isMatch == true) {
        return false;
    }
    else return true;
}

function checkAddAndEditQuantity(input) {
    const regex = /^\d+$/i;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if (isMatch == true) {
        return true;
    }
    else return false;
}

function checkName(input) {
    const regex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+/i;
    // const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(input); // true
    if (isMatch == true) {
        return false;
    }
    else return true;
}

function checkProductName(input) {
    const regex_length = /^[\p{L}\p{M}\s]{1,25}$/u;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch_length = regex_length.test(normalizedStr); // true
    return isMatch_length;
}

function checkPassword(input) {
    const regex_length = /^[A-Za-z\d!@#$%^&*()_+=[\]{}|\\;:'",.<>/?]{6,20}$/;
    const regex_upper_lower = /(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?`~])/;
    const normalizedStr_length = input.normalize("NFC"); // chuẩn hóa chuỗi
    const normalizedStr_upper_lower = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch_length = regex_length.test(normalizedStr_length); // true
    const isMatch_upper_lower = regex_upper_lower.test(normalizedStr_upper_lower); // true
    if (isMatch_length == false && isMatch_upper_lower == false) {
        return 0;
    } else if (isMatch_length == false && isMatch_upper_lower == true) {
        return 1;
    } else if (isMatch_length == true && isMatch_upper_lower == false) {
        return 2;
    }
    else return 3;
}