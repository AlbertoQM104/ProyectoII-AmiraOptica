function mostrarPantallaCarrito1(){
     document.getElementById('carritoDiv1').style.display = '';
    document.getElementById('carritoDiv2').style.display = 'none';    
    document.getElementById('carritoDiv3').style.display = 'none';
    
    document.getElementById('btnOpcion1').style.color = "#606060";    
    document.getElementById('btnOpcion1').style.borderBottomColor = "#606060";  
    document.getElementById('btnOpcion2').style.color = "#C7C7C7";    
    document.getElementById('btnOpcion2').style.borderBottomColor = "#C7C7C7";    
    document.getElementById('btnOpcion3').style.color = "#C7C7C7";  
    document.getElementById('btnOpcion3').style.borderBottomColor = "#C7C7C7";  
}

function mostrarPantallaCarrito2(){
    document.getElementById('carritoDiv1').style.display = 'none';
    document.getElementById('carritoDiv2').style.display = '';    
    document.getElementById('carritoDiv3').style.display = 'none';    

    document.getElementById('btnOpcion1').style.color = "#C7C7C7";    
    document.getElementById('btnOpcion1').style.borderBottomColor = "#C7C7C7";  
    document.getElementById('btnOpcion2').style.color = "#606060";    
    document.getElementById('btnOpcion2').style.borderBottomColor = "#606060";    
    document.getElementById('btnOpcion3').style.color = "#C7C7C7";  
    document.getElementById('btnOpcion3').style.borderBottomColor = "#C7C7C7";  
}

function mostrarPantallaCarrito3(){
    document.getElementById('carritoDiv1').style.display = 'none';
    document.getElementById('carritoDiv2').style.display = 'none';    
    document.getElementById('carritoDiv3').style.display = '';  
    
    document.getElementById('btnOpcion1').style.color = "#C7C7C7";    
    document.getElementById('btnOpcion1').style.borderBottomColor = "#C7C7C7";  
    document.getElementById('btnOpcion2').style.color = "#C7C7C7";    
    document.getElementById('btnOpcion2').style.borderBottomColor = "#C7C7C7";    
    document.getElementById('btnOpcion3').style.color = "#606060";  
    document.getElementById('btnOpcion3').style.borderBottomColor = "#606060";   
}

/* Al elegir por delivery */
function tipoDeli(){
    
    let deliv = document.getElementById('tipoRecojo2');  

    
    document.getElementById('cuandoDelivery').style.display = '';

    //Borrar primero
    document.getElementById('costoDelDelivery1').innerHTML= '';
    document.getElementById('costoDelDelivery2').innerHTML= '';
    document.getElementById('costoDelDelivery3').innerHTML= '';

    //Agregar precio del delivery
    var texto1 = document.createTextNode("20.00");
    var texto2 = document.createTextNode("20.00");
    var texto3 = document.createTextNode("20.00");

    document.getElementById('costoDelDelivery1').appendChild(texto1);
    document.getElementById('costoDelDelivery2').appendChild(texto2);
    document.getElementById('costoDelDelivery3').appendChild(texto3);
    
}

/* Al elegir por tipo recojo */
function tipoRecojo(){
    let fisico = document.getElementById('tipoRecojo');
    document.getElementById('cuandoDelivery').style.display = 'none';

    /* Eliminar campos al elegir por recojo */
    document.getElementById('firstName').value = '';
    document.getElementById('secondName').value = '';
    document.getElementById('firstDirection').value = '';
    document.getElementById('secondDirection').value = '';
    document.getElementById('provinc').value = '';
    document.getElementById('depart').value = '';
    document.getElementById('distrit').value = '';
    document.getElementById('celul').value = '';

    //Agregar precio del delivery
    /* var texto1 = document.createTextNode("0.00");
    var texto2 = document.createTextNode("0.00");
    var texto3 = document.createTextNode("0.00"); */

    document.getElementById('costoDelDelivery1').innerHTML= '0.00';
    document.getElementById('costoDelDelivery2').innerHTML= '0.00';
    document.getElementById('costoDelDelivery3').innerHTML= '0.00';
}