function checkSearchInput(input)
{
    const regex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+/i;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if(isMatch == true || input[0] == "0")
    {
        return false;
    }
}