const plus = document.getElementById('plus');
const conteudo = document.querySelector('.conteudo');
const corpo = document.querySelector('body');
const marcador = document.querySelector('.marcador-nota');
const fechar = document.querySelector('.close-marcador');
const nomeM = document.getElementById('nomeMarcador');
const addM = document.getElementById('addMarcador');
const example = document.querySelectorAll('.adicionar_nota i');
const janelaAddNota = document.querySelector('.janelaAddNota');
const fecharJanelaAddNota = document.querySelector('.janelaAddNotaFalse');
const hidden = document.getElementById('idMarc');
const nota = document.querySelectorAll('.nota');
const notaExpandir = document.querySelector('.janelaNotaExpandir');
const fecharNotaExpandir = document.querySelector('.notaExpandirFalse');
plus.addEventListener('click', function(event){
    event.preventDefault();
    corpo.style.backgroundColor = 'black';
    conteudo.style.pointerEvents = 'none';
    conteudo.style.opacity = '0.6';
    marcador.style.display = 'block';
})
function close(){
    addM.addEventListener('submit', function(event){
        conteudo.style.opacity = '1';
        conteudo.style.pointerEvents = 'all';
        marcador.style.display = 'none';
        nomeM.value = "";
    })
}
fechar.addEventListener('click', function(event){
    corpo.style.overflow = 'scroll';
    conteudo.style.opacity = '1';
    conteudo.style.pointerEvents = 'all';
    marcador.style.display = 'none';
})
addM.addEventListener('click', function(event){
    const i = document.createElement('i');
    if(nomeM.value === ''){
        event.preventDefault();
        i.classList.add('erro');
        i.innerHTML = "nome não pode ficar em branco";
        marcador.appendChild(i);
        setTimeout(function(){
            i.parentNode.removeChild(i);
        },800);
        nomeM.focus();
        return false;
    }else{
        close();
    }
})
for(i = 0; i<example.length; i++){
    example[i].addEventListener('click', function(event){
        event.preventDefault();
        corpo.style.backgroundColor = 'black';
        conteudo.style.pointerEvents = 'none';
        conteudo.style.opacity = '0.6';
        janelaAddNota.style.display = 'block';
        hidden.value = this.id;
        console.log(hidden);
    })
}
fecharJanelaAddNota.addEventListener('click', function(event){
    corpo.style.backgroundColor = 'white';
    conteudo.style.pointerEvents = 'all';
    conteudo.style.opacity = '1';
    janelaAddNota.style.opacity = '1';
    janelaAddNota.style.display = 'none';
})
console.log(nota);
for(i = 0; i<nota.length; i++){
    nota[i].addEventListener('click', function(event){
        event.preventDefault();
        corpo.style.backgroundColor = 'black';
        conteudo.style.pointerEvents = 'none';
        conteudo.style.opacity = '0.6';
        notaExpandir.style.display = 'block';
    })
}
fecharNotaExpandir.addEventListener('click', function(event){
    corpo.style.backgroundColor = 'white';
    conteudo.style.pointerEvents = 'all';
    conteudo.style.opacity = '1';
    notaExpandir.style.opacity = '1';
    notaExpandir.style.display = 'none';
})