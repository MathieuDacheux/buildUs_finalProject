/*************************** **************************/
/************* Regex mail, name, surname **************/
/*************************** **************************/

// Variables REGEX
const regexMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
const regexName = /^(?=.{1,50}$)[a-zA-Z]+(?:['_.\s][a-z]+)*$/;
const regexPassword = /^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{8,})/;
const regexUppercase = /^[A-Z]+/g;
const regexNumber = /^\d/g;
const regexSpecialCharacter = /^[\!\@\#\$\%\^\&\*\)\(\+\=\.\<\>\{\}\[\]\:\;\'\"\|\~\`\_\-]/g;
const regexCounter = /[a-zA-Z]{8,}/g;

// Variables Input from DOM
const inputMail = document.querySelector('[name=mail]');
const inputFirstName = document.querySelector('[name=firstname]');
const inputLastName = document.querySelector('[name=lastname]');
const inputPassword = document.querySelector('[name=password]');
const inputConfirmPassword = document.querySelector('[name=passwordConfirm]');
const passwordIndication = document.querySelector('.passwordIndication');
const listUpperCase = document.querySelector('.passwordIndication li:nth-child(1)');
const listNumber = document.querySelector('.passwordIndication li:nth-child(2)');
const listSpecialCharacter = document.querySelector('.passwordIndication li:nth-child(3)');
const listLenght = document.querySelector('.passwordIndication li:nth-child(4)');

// Function verify form 
const verifyMail = () => {
    if (regexMail.test(inputMail.value)) {
        inputMail.style.borderColor = '#75DB79';
        return true;
    } else {
        inputMail.style.borderColor = '#E87D7D';
        return false;
    }
}

const verifyLastName = () => {
    if (regexName.test(inputLastName.value)) {
        inputLastName.style.borderColor = '#75DB79';
        return true;
    } else {
        inputLastName.style.borderColor = '#E87D7D';
        return false;
    }
}

const verifyFirstName = () => {
    if (regexName.test(inputFirstName.value)) {
        inputFirstName.style.borderColor = '#75DB79';
        return true;
    } else {
        inputFirstName.style.borderColor = '#E87D7D';
        return false;
    }
}

const verifyPassword = () => {
    if (regexPassword.test(inputPassword.value)) {
        inputPassword.style.borderColor = '#75DB79';
        return true;
    } else {
        inputPassword.style.borderColor = '#E87D7D';
        return false;
    }
}

const verifyConfirmPassword = () => {
    if (regexPassword.test(inputPassword.value) && inputPassword.value == inputConfirmPassword.value) {
        inputConfirmPassword.style.borderColor = '#75DB79';
        inputPassword.style.borderColor = '#75DB79';
        return true;
    } else {
        inputPassword.style.borderColor = '#E87D7D';
        inputConfirmPassword.style.borderColor = '#E87D7D';
        return false;
    }
}

const verifyEachSpecifity = () => {
    if (regexUppercase.test(inputPassword.value)) {
        listUpperCase.style.color = '#75DB79';
    } else {
        listUpperCase.style.color = '#E87D7D';
    }
}

/*************************** **************************/
/************************  Work ***********************/
/*************************** **************************/

inputMail.addEventListener('blur', () => {
    verifyMail();
})

inputLastName.addEventListener('blur', () => {
    verifyLastName();
})

inputFirstName.addEventListener('blur', () => {
    verifyFirstName();
})

inputPassword.addEventListener('blur', () => {
    verifyPassword();
})

inputConfirmPassword.addEventListener('blur', () => {
    verifyConfirmPassword();
})

