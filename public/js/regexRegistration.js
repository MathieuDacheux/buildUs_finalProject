/*************************** **************************/
/************* Regex mail, name, surname **************/
/*************************** **************************/

// Variables REGEX
const regexMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
const regexName = /^(?=.{1,50}$)[a-zA-Z]+(?:['_.\s][a-z]+)*$/;
const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/;

// Variables Input from DOM
const inputMail = document.querySelector('[name=mail]');
const inputFirstName = document.querySelector('[name=firstname]');
const inputLastName = document.querySelector('[name=lastname]');
const inputPassword = document.querySelector('[name=password]');
const inputConfirmPassword = document.querySelector('[name=passwordConfirm]');
const passwordIndication = document.querySelector('.passwordIndication');
const formCheckbox = document.querySelector('.formCheckboxContainer');

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

inputPassword.addEventListener('focus', () => {
    passwordIndication.style.display = 'block';
    formCheckbox.style.display = 'none';
})

inputPassword.addEventListener('blur', () => {
    passwordIndication.style.display = 'none';
    formCheckbox.style.display = 'block';
    verifyPassword();
})

inputConfirmPassword.addEventListener('blur', () => {
    verifyConfirmPassword();
})

