function form() {
    var mail = document.getElementById('mail').value;
    var pass1 = document.getElementById('jelsz1').value;
    var pass2 = document.getElementById('jelsz2').value;
    var gen ="";
    var radio = document.querySelectorAll("input[name='gender']");

    if(pass1 !== pass2){
        alert("Nem egyeznek a jelszavak!");    
    }else{





    for( var i=0;i<radio.length;i++){
        
        var x = radio[i].checked;
        if (x){
            gen = radio[i].value;
            break;
        }
    }
    if(gen == ""){
        alert("Kötelező a NEM választása!")
    }else{
        var hobby= "";
        if(document.getElementById('ch1').checked){
        hobby+=document.getElementById('ch1').value+", ";
    }
        if(document.getElementById('ch2').checked){
        hobby+=document.getElementById('ch2').value+", ";
    }
        if(document.getElementById('ch3').checked){
        hobby+=document.getElementById('ch3').value+", ";
    }
        if(document.getElementById('ch4').checked){
        hobby+=document.getElementById('ch4').value+", ";
    }
        if(document.getElementById('ch5').checked){
        hobby+=document.getElementById('ch5').value+", ";
    }
        if(document.getElementById('ch6').checked){
        hobby+=document.getElementById('ch6').value+", ";
    }

    if(hobby == ""){
        hobby = "Nincs"
    }
    document.getElementById('er').innerHTML=mail+" "+pass1+" "+pass2+" "+gen +" hobby: "+hobby;
    }

    
}
}

function gdprell(){
    var chg = document.getElementById("gdpr");
    if (chg.checked ==true){
        sbtn.disabled = false;
    }else{
        sbtn.disabled = true;
    }
}
function torles(){
    document.getElementById("f1").reset();
}