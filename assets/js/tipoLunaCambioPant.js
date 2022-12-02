function showDiv1(){
    document.getElementById('tipoLunaDiv1').style.display = '';
    document.getElementById('tipoLunaDiv2').style.display = 'none';    
}

function showDiv2(){
    document.getElementById('tipoLunaDiv1').style.display = 'none';
    document.getElementById('tipoLunaDiv2').style.display = '';  
}

function unselect(){
    
    var radio1 = document.getElementById('deseRadio');
    var radio2 = document.getElementById('deseRadio2');
    var radio3 = document.getElementById('deseRadio3');
    radio1.checked = false;
    radio2.checked = false;
    radio3.checked = false;
  }