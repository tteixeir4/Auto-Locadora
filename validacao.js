function campoObrigatorio(campo) {
    if (campo.value.length < 1) {
        return false;
    } else {
        return true;
    }
}

function campoCPF() {
    if (event.keyCode >= 48 && event.keyCode <= 57) {
        return true;
    } else {
        event.preventDefault();
        return false;
    }
}

function aplicaEstiloValidacao(controle, adiciona) {
    if (adiciona) {
        controle.style.border = "2px solid red";
        controle.style.outline = "none";
        controle.focus();
    } else {
        controle.style.border = "2px solid #ccc";
    }
}

function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000") return false;

    for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10))) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11))) return false;
    return true;
}

window.onload = function () {
    var f = document.getElementById("formCadastro");
    var cpf = document.getElementById("cpf");
    var qtCampos = f.elements.length;

    function validaFormulario() {
        for (var i = 0; i < qtCampos; i++) {
            var controle = f.elements[i];

            aplicaEstiloValidacao(controle, false);

            if (controle.type == 'text' || controle.type == 'textarea') {
                if (!campoObrigatorio(controle)) {
                    aplicaEstiloValidacao(controle, true);
                    alert("Por favor, preencha o campo " + controle.name);
                    return false;
                }
            }

            if (controle.name == 'cpf') {
                if (!TestaCPF(cpf.value)) {
                    aplicaEstiloValidacao(controle, true);
                    alert("CPF " + cpf.value + " é inválido!");
                    return false;
                }
            }
        }
    }

    f.onsubmit = function () {
        return validaFormulario(this);
    }

    cpf.addEventListener("keypress", campoCPF, false);

}
    function confirmarLogout() {
        if (confirm("Tem certeza que deseja sair?")) {
            window.location.href = 'logout.php';
    }
}
    function validaSenha(senha) {
        const regex = /^[a-zA-Z0-9]{1,7}$/;
        return senha && regex.test(senha);
}