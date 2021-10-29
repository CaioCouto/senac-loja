function setVisualValidityClass(field, isValid) {
    const label = document.querySelector(`.main__form-${field}--valid`)
    const invalidClass = `main__form-${field}--invalid`
    isValid ? label.classList.remove(invalidClass) : label.classList.add(invalidClass)
}

function validateProductName(name) {
    /*
    * Valida a informação inserida em como nome do produto.
    * Para ser válida, a informação deve conter ao menos 4 caracteres.
    */
    const isValid = name.length >= 4
    console.log(name)
    setVisualValidityClass('nome', isValid)
    return isValid
}

function validateForm(data) {
    return validateProductName(data['nome-input'])
}

document.querySelector('.main__form').addEventListener('submit', (e) => {
    e.preventDefault()

    const valorInput = document.querySelector('#valor-input')
    const data = {}
    const fields = [
        'nome-input',
        'categoria-input'
    ]
    
    fields.forEach(field => data[field] = e.target[field].value)
    valorInput.value = valorInput.value.replace('R$ ', '').replace(',', '.')
    
    if (validateForm(data)) {
        e.target.submit()   
    }
    else {
        alert('Oops. Parece que há informações inválidas!')
    }
})