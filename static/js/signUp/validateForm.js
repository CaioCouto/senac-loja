function setVisualValidityClass(field, isValid) {
    /*
    * Adiciona ou remove o modificador "invalid"
    * aos elementos que contém caracteres inválidos. 
    */
    const label = document.querySelector(`.main__form-${field}--valid`);
    const invalidClass = `main__form-${field}--invalid`;
    isValid ? label.classList.remove(invalidClass) : label.classList.add(invalidClass);
}

function validateFullName(fullName) {
    /*
    * Valida a informação inserida em nome-input e sobrenome-input.
    * Para ser válida, a informação deve contar apenas letras
    * e conter, ao menos 02 caracteres.
    */
    const numberSpecialRE = /(\W|\s{2,}|\d|[_])/g;
    const [ nameIsValid, surnameIsValid ] = fullName.map(n => n.search(numberSpecialRE) === -1 && n.length >= 3);
    setVisualValidityClass('nome', nameIsValid);
    setVisualValidityClass('sobrenome', surnameIsValid);
    return nameIsValid && surnameIsValid;
}

function validateCPF(cpf) {
    /*
    * Valida a informação inserida em cpf-input.
    * Para ser válida, a informação deve conter 
    * exatos 14 caracteres, contanto os números
    * e a máscara.
    */
    const cpfIsValid = cpf.length == 14;
    setVisualValidityClass('cpf', cpfIsValid);
    return cpfIsValid;
}

function validateEmail(email) {
    /*
    * Valida a informação inserida em email-input.
    * Para ser válida, a informação deve acabar com
    * ".com" ou ".com.br" e conter o caractere "@".
    */
    const isValid = (email.endsWith('.com') || email.endsWith('.com.br')) && email.search('@') !== -1;
    setVisualValidityClass('email', isValid);
    return isValid;
}

function validateForm(data) {
    return (
        validateCPF(data['cpf-input']) && 
        validateEmail(data['email-input']) &&
        validateFullName([
            data['nome-input'], 
            data['sobrenome-input']
        ])
    );
}

document.querySelector('.main__form').addEventListener('submit', (e) => {
    e.preventDefault();

    const data = {};
    const fields = [
        'nome-input',
        'sobrenome-input', 
        'cpf-input',
        'email-input',
        'senha-input',
    ];
    fields.forEach(field => data[field] = e.target[field].value);
    
    if (validateForm(data)) {
        e.target.submit();
    } else {
        alert('Oops. Parece que há informações inválidas!');
    }
});