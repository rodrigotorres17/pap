/*====================================================
    MAPA INTERATIVO
    Escola Básica e Secundária de Canelas
====================================================*/

document.addEventListener("DOMContentLoaded", () => {

    /* ===========================
       Todos os hotspots
    ============================ */

    const hotspots = document.querySelectorAll(".hotspot");

    hotspots.forEach(hotspot => {

        hotspot.addEventListener("mouseenter", () => {

            hotspot.style.zIndex = "999";

            hotspot.style.transform = "scale(1.25)";

        });

        hotspot.addEventListener("mouseleave", () => {

            hotspot.style.transform = "scale(1)";

        });

    });

    /* ===========================
       Clique com efeito
    ============================ */

    hotspots.forEach(botao => {

        botao.addEventListener("click", function(){

            botao.classList.add("clicked");

            setTimeout(()=>{

                botao.classList.remove("clicked");

            },300);

        });

    });

});


/*====================================
      Função abrir página
=====================================*/

function abrirPagina(url){

    window.location.href=url;

}


/*====================================
      Tooltip
=====================================*/

const botoes=document.querySelectorAll(".hotspot");

botoes.forEach(btn=>{

    btn.addEventListener("mousemove",(e)=>{

        const tooltip=btn.querySelector(".tooltip");

        if(!tooltip) return;

        tooltip.style.left=e.offsetX+"px";

    });

});


/*====================================
      Pequena animação inicial
=====================================*/

window.onload=function(){

    const pontos=document.querySelectorAll(".hotspot");

    let atraso=0;

    pontos.forEach(p=>{

        p.style.opacity="0";

        p.style.transform="scale(.5)";

        setTimeout(()=>{

            p.style.transition=".4s";

            p.style.opacity="1";

            p.style.transform="scale(1)";

        },atraso);

        atraso+=120;

    });

}


/*====================================
        Efeito Ripple
=====================================*/

document.querySelectorAll(".hotspot").forEach(botao=>{

botao.addEventListener("click",function(e){

const ripple=document.createElement("span");

ripple.className="ripple";

this.appendChild(ripple);

const x=e.offsetX;

const y=e.offsetY;

ripple.style.left=x+"px";

ripple.style.top=y+"px";

setTimeout(()=>{

ripple.remove();

},600);

});

});


/*====================================
    Destaque do edifício selecionado
=====================================*/

let ativo=null;

document.querySelectorAll(".hotspot").forEach(botao=>{

botao.addEventListener("click",()=>{

if(ativo){

ativo.classList.remove("ativo");

}

botao.classList.add("ativo");

ativo=botao;

});

});


/*====================================
      Zoom opcional do mapa
=====================================*/

const mapa=document.querySelector(".map");

if(mapa){

let escala=1;

mapa.addEventListener("wheel",(e)=>{

e.preventDefault();

if(e.deltaY<0){

escala+=0.08;

}else{

escala-=0.08;

}

if(escala<1) escala=1;

if(escala>2) escala=2;

mapa.style.transform="scale("+escala+")";

});

}


/*====================================
      Atalhos teclado
=====================================*/

document.addEventListener("keydown",(e)=>{

switch(e.key){

case "1":

abrirPagina("biblioteca.php");

break;

case "2":

abrirPagina("cantina.php");

break;

case "3":

abrirPagina("pavilhao.php");

break;

case "4":

abrirPagina("blocos/blocoA.php");

break;

case "5":

abrirPagina("blocos/blocoB.php");

break;

case "6":

abrirPagina("blocos/blocoF.php");

break;

case "7":

abrirPagina("blocos/blocoG.php");

break;

}

});


/*====================================
        Mensagem inicial
=====================================*/

console.log("Mapa Interativo carregado com sucesso.");

console.log("Projeto PAP - Rodrigo Torres");

console.log("Escola Básica e Secundária de Canelas");