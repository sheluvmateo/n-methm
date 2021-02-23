function form() {
    var mail = document.getElementById('mail').value;
    var pass1 = document.getElementById('jelsz1').value;
    var pass2 = document.getElementById('jelsz2').value;
    var gt=("male","female","csiga");
    var gen ="";
    var radio = document.querySelectorAll("input[name='gender']");

    for( var i=0;i<radio.length;i++){
        
        var x = radio[i].checked;
        if (x){
            gen = radio[i].value;
            break;
        }
    }


    
    document.getElementById('er').innerHTML=mail+" "+pass1+" "+pass2+" "+gen;
}