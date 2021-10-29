function onlyNumbers(str) {
    return str.replace(/\D/g,"")
}

function CEPMask() {
    document.querySelector('#cep-input').addEventListener('input', (e) => {
        const cep = e.target.value
        
        e.target.value = onlyNumbers(cep)
            .replace(/(\d{5})(\d)/, "$1-$2")
            .replace(/(-\d{3})\d+?/, "$1")
    })
}

function CPFMask() {   
    document.querySelector('#cpf-input').addEventListener('input', (e) => {
        const cpf = e.target.value
        
        e.target.value = onlyNumbers(cpf)
            .replace(/(\d{3})(\d)/, "$1.$2")
            .replace(/(\d{3})(\d)/, "$1.$2")
            .replace(/(\d{3})(\d)/, "$1-$2")
            .replace(/(-\d{2})\d+?/, "$1")
    })
}

CEPMask()
CPFMask()