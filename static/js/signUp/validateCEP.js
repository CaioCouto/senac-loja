function addCEPInvalidClass() {
    document.querySelector('.main__form-cep--valid').classList.add('main__form-cep--invalid')
}

function removeCEPInvalidClass() {
    document.querySelector('.main__form-cep--valid').classList.remove('main__form-cep--invalid')
}

async function getCEP(cep) {
    /**
     * Esta função realiza uma requisição GET na API NewsAPI
     * trazendo diversas notícias, por vezes, filtrando
     * por categoria.
     */
    let endereco = {
        localidade:'',
        bairro:'',
        logradouro:'',
    }

    await $.get(`https://viacep.com.br/ws/${cep}/json/`)
        .done(response => {
            if (!response.erro) {
                for (const k in endereco) {
                    endereco[k] = response[k]
                }
                removeCEPInvalidClass()
            }
            else {
                addCEPInvalidClass()
            }
        })
        .fail((status, error) => {
            console.log(status)
            console.log(error)
            endereco = ''
        })

    return endereco
}

function fillAddress({localidade, bairro, logradouro}) {
    document.querySelector('#cidade-input').value = localidade
    document.querySelector('#bairro-input').value = bairro
    document.querySelector('#endereco-input').value = logradouro
}

document.querySelector('#cep-input').addEventListener('blur', async (e) => {
    const cep = e.target.value.replace('-', '')
    if (cep.length === 8) {
        const endereco = await getCEP(cep)
        fillAddress(endereco)
    }
    else {
        addCEPInvalidClass()
    }
})