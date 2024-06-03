document.addEventListener("DOMContentLoaded",(e)=>{
    document.getElementById('registroForm').addEventListener('submit', function(event) {
        event.preventDefault();
        let email = document.getElementById('email').value;
        let dni = document.getElementById("dni").value;
        //let nombre = document.getElementById("nombre").value;
        let password = document.getElementById("password").value;
        let valid = true;

        let dniValidado = validarDNI(dni);
        if(dniValidado){
            valid = true;
        }else{
            valid = false;
        }


        
        if(email!=""){
            valid = true;
        }else{
            valid = false;
        }

        let passwordValidada = validarPassword(password);
        if(passwordValidada){
            valid = true;
        }else{
            valid = false;
        }

    
        if (valid) {
            Swal.fire({
                icon: 'success',
                title: 'Formulario enviado correctamente.',
                showConfirmButton: false,
                timer: 1500
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error en el formulario',
                text: 'Por favor, completa todos los campos obligatorios.',
            });
        }
    
        console.log(valid);
  
    
    if (valid) {
        // Enviar datos a PHP usando fetch
        fetch('../admin/secciones/registro_usuario.php', {
        })
        .then(response => response.json())
        .then(data => {
            
            console.log(data);
        })
        .catch(error => console.error('Error:', error));
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error en el formulario',
            text: 'Por favor, completa todos los campos obligatorios.',
        });
    }
});
});

function validarDNI(dni) {
    const regex = /^[0-9]{8}[A-Za-z]$/;
    return regex.test(dni);
}

function validarEmail(email) {
    // Expresión regular para validar el email
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(email);
}

function validarPassword(password) {
    // Expresión regular para validar la contraseña
    // Mínimo 8 caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial
    const regex =/^.{5,}$/;
    return regex.test(password);
}



