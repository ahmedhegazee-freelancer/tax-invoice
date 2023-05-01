export const validateArabicLetters = (text) =>
    /^[\u0621-\u064A\u0660-\u0669 ]+$/.test(text);
export const validateEnglishLetters = (text) => /^[a-zA-Z0-9]+$/.test(text);
