'use strict';

let userForm = document.getElementById("userForm");
    userForm.addEventListener("submit",(e)=>{
        e.preventDefault();
        let valido = validarFormulario();
        if(valido){
            Swal.fire({
                icon: 'success',
                title: 'Todos los campos estan correctos',
                showConfirmButton: false,
                timer: 1500
              });
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Por favor, completa todos los campos.',
                timer: 1500
              });
        }
    });

function validarFormulario() {
    // Obtener los valores de los campos del formulario
    var nombre = document.getElementById("nombre").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    if (nombre === "" || email === "" || password === "") {
      // Mostrar alerta SweetAlert2
      return false; // Detener el envío del formulario
    }
    var emailRegExp = /\S+@\S+\.\S+/;
    if (!emailRegExp.test(email)) {
      return false;
    }
    return true;
  }