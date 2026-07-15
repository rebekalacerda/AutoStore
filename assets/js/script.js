function trocarImagem(img) {

    document.getElementById("imagemPrincipal").src = img.src;

    document.querySelectorAll(".thumb").forEach(function (item) {
        item.classList.remove("ativa");
    });

    img.classList.add("ativa");
}

function abrirFormulario() {
    document.getElementById("modalLead").style.display = "flex";
}

function fecharFormulario() {
    document.getElementById("modalLead").style.display = "none";
}