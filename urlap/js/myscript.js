function form() {
    var mail = document.getElementById('mail').value;
    var pass1 = document.getElementById('jelsz1').value;
    var pass2 = document.getElementById('jelsz2').value;
    var gen = document.getElementById('gender').value;
    document.getElementById('er').innerHTML=mail+" "+pass1+" "+pass2+" "+gen;
}