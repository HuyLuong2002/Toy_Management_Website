function checkSearchInput(input)
{
    const regex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+/i;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if(isMatch == true || input[0] == "0")
    {
        return false;
    }
<<<<<<< HEAD
    else return true;
=======
>>>>>>> ea71b94c2658f322884491d99a9f14de1f10cbb0
}

function checkAddAndEdit(input)
{
    const regex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+/i;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if(isMatch == true)
    {
        return false;
    }
    else return true;
}

function checkAddAndEditProvider(input)
{
    const regex = /[!@#$%^&*()_+\=[\]{};':"\\|,.<>/?]+/i;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if(isMatch == true)
    {
        return false;
    }
    else return true;
}

function checkAddAndEditPrice(input)
{
    const regex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+/i;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if(isMatch == true)
    {
        return false;
    }
    else return true;
}

function checkAddAndEditQuantity(input)
{
    const regex = /^\d+$/i;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if(isMatch == true)
    {
        return true;
    }
    else return false;
}