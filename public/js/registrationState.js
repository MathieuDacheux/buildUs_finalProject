/***************************** ****************************/
/************* Show succes or error container *************/
/***************************** ****************************/

const containerContent = document.querySelector('.containerSubject');
const uriEmployee = '/dashboard/employes';
const uriClient = '/dashboard/clients';
const uriTodo = '/dashboard/rappels';

const showResultUri = (URI) => {
    if (document.querySelector('.showResult')) {
        const showResult = document.querySelector('.showResult');
        const resultFormText = document.querySelector('.resultFormText');
        if (showResult.classList.contains('visible')) {
            containerContent.style.opacity = '0.5';
            setTimeout(() => {
                showResult.classList.remove('visible');
                showResult.classList.add('hidden');
                containerContent.style.opacity = '1';
            }, 2000);
            if (resultFormText.textContent == 'Le données ont bien été ajoutées' || 
            resultFormText.textContent == 'Tâche éffacée' || 
            resultFormText.textContent == 'Tâche terminée') {
                setTimeout(() => {
                    window.location.href = URI;
                }, 2000);
            };
        };
    };
}

const showResult = () => {
    // If the uri equal /patients
    if (window.location.pathname === '/dashboard/employes') {
        showResultUri(uriEmployee);
    } else if (window.location.pathname === '/dashboard/clients') {
        showResultUri(uriClient);
    } else {
        showResultUri(uriTodo);
    }
};

/***************************** *****************************/
/**************************  Work **************************/
/***************************** *****************************/

window.addEventListener('submit', showResult());