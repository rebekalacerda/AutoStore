const chatButton = document.getElementById("chatButton");
const chatJanela = document.getElementById("chatJanela");
const fecharChat = document.getElementById("fecharChat");

function abrirChat() {

    chatJanela.style.display = "flex";

}

chatButton.onclick = abrirChat;

fecharChat.onclick = () => {

    chatJanela.style.display = "none";

}

const enviar = document.getElementById("enviarPergunta");

enviar.onclick = enviarMensagem;

document
.getElementById("pergunta")
.addEventListener("keypress",function(e){

    if(e.key==="Enter"){

        enviarMensagem();

    }

});

function enviarMensagem(){

    let pergunta = document.getElementById("pergunta").value;

    if(pergunta=="") return;

    adicionarMensagem(pergunta,"usuario");

    document.getElementById("pergunta").value="";

    adicionarMensagem("Pensando...","ia","digitando");

    fetch("chatbot.php",{

        method:"POST",

        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },

        body:"pergunta="+encodeURIComponent(pergunta)

    })

    .then(r=>r.json())

    .then(res=>{

        document.querySelector(".digitando").remove();

        adicionarMensagem(res.resposta,"ia");

    });

}

function adicionarMensagem(texto,tipo,classe=""){

    const chat = document.getElementById("chatMensagens");

    chat.innerHTML +=
    `<div class="mensagem ${tipo} ${classe}">
        ${texto}
    </div>`;

    chat.scrollTop = chat.scrollHeight;

}

function abrirFormulario(){

    document.getElementById("modalLead").style.display = "flex";

}

function fecharFormulario(){

    document.getElementById("modalLead").style.display = "none";

}

const formLead = document.getElementById("formLead");

window.addEventListener("DOMContentLoaded", () => {

    const formLead = document.getElementById("formLead");

    if(formLead){

        formLead.addEventListener("submit", function(e){

            e.preventDefault();

            const dados = new FormData(this);

            fetch("salvar_lead.php",{
                method:"POST",
                body:dados
            })
            .then(res => res.json())
            .then(res => {

                alert(res.mensagem);

                if(res.sucesso){

                    this.reset();

                    fecharFormulario();

                }

            });

        });

    }

});