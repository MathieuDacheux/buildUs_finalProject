/*************************** **************************/
/************* Regex mail, name, surname **************/
/*************************** **************************/

// Variables REGEX
const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/;

// Variables Input from DOM
const inputPassword = document.querySelector('[name=password]');
const inputConfirmPassword = document.querySelector('[name=passwordConfirm]');
const passwordIndication = document.querySelector('.passwordIndication');
const buttonSubmit = document.querySelector('.registerButton');

// Function verify form

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

inputPassword.addEventListener('focus', () => {
    passwordIndication.style.display = 'block';
    buttonSubmit.classList.add('hidden');
})

inputPassword.addEventListener('blur', () => {
    passwordIndication.style.display = 'none';
    buttonSubmit.classList.remove('hidden');
    verifyPassword();
})

inputConfirmPassword.addEventListener('blur', () => {
    verifyConfirmPassword();
})

