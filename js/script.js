window.onload = fetchDogImages();
    async function fetchDogImages() {
        const apiURL = "https://api.thedogapi.com/v1/images/search?limit=5&&order=ASC";
        try {
          const response = await fetch(apiURL);
          
          // Verifica si la respuesta es correcta
          if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
          }
          
          const data = await response.json();
          
          const divAnimales = document.getElementById("animales__animal");


            // Procesa y muestra los datos
            data.forEach(dog => {
                let img = document.createElement("img");
                img.src = dog.url;
                img.width = 300;
                img.height=350;
                img.classList.add("animal__img");
                console.log(img);
                divAnimales.appendChild(img);
 

                
            
            
            
            });

          
        
        } catch (error) {
          console.error('Error fetching dog images:', error);
        }
      }