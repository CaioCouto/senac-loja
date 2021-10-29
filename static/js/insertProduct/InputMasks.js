function onlyNumbers(str) {
    return str.replace(/\D/g,"")
}

function valueMask() {   
    document.querySelector('#valor-input').addEventListener('input', (e) => {
        let value = onlyNumbers(e.target.value);
        value = value ? parseInt(value) : 0
        e.target.value = 'R$ ' + (value/100).toFixed(2)
        e.target.value = e.target.value.replace('.', ',')
    })
}

valueMask()