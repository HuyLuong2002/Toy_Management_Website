function checkSearchInput(input)
{
    const regex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?0]+/;
    const normalizedStr = input.normalize("NFC"); // chuẩn hóa chuỗi
    const isMatch = regex.test(normalizedStr); // true
    if(isMatch == true)
    {
        return false;
    }
}