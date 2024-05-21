'use strict';

async function listarPaisesenSelect(){
    const url = 'https://ip-geo-location.p.rapidapi.com/ip/check?format=json';
    const options = {
        method: 'GET',
        headers: {
            'X-RapidAPI-Key': 'c74850e498mshdf4b2a947653b6cp1238bcjsneed77af427bf',
            'X-RapidAPI-Host': 'ip-geo-location.p.rapidapi.com'
        }
    };

    try {
        const response = await fetch(url, options);
        const data = await response.json();
        let paises = data.country;
        console.log(paises);
        if (data.country) {
            let countryName = data.country.name;
            let option = document.createElement("option");
            option.text = countryName;
            option.value = countryName;
            let select = document.getElementById("paisPerrera");
            select.appendChild(option);
        }
    } catch (error) {
        console.error(error);
    }
}

document.addEventListener('DOMContentLoaded', listarPaisesenSelect);