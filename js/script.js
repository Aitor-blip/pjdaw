'use strict';
//Favoritos add
let nFavoritos = 0;
let btnFavoritos = document.getElementById("btnFavorito");
function metodos(){
    recibirDato();
}

function recibirDato() {
    /* fetch('../secciones/perro_data.php')
    .then(response => response.text())
    .then(data => {
        var datos = data;
        console.log(datos);
    }); */
    

}

function addNFavorito(){
    btnFavoritos.addEventListener("click",(e)=>{
        e.preventDefault();
        let name = e.target.getAttribute("name");
        if(name == "favoritos"){
           
        }
    });
}

function updateFavoritos(nFavoritos){
    
}

window.onload = metodos;