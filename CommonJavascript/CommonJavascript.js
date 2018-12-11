function testOnlyLetters(input) {
    var string = input.value;
    
    const permittedChars = "aáäàâbcçdeéëèêfghiíïìîjklmnoóöòôpqrstuúüùûvwxyzAÁÄÀÂBCÇDEÉËÈÊFGHIJKLMNOÓÖÒÔPQRSTUÚÜÙÛVWXYZ-_'\\";

    if(!permittedChars.includes(string[string.length - 1])) {
        string = string.substring(0, string.length - 1);
    }
    
    input.value = string;
}