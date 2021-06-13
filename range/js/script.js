function r1(){
    var w = document.getElementById('w').value;
    document.getElementById('er').innerHTML=w;
    document.getElementById('kep').width=w;
}
function szin(x){
    document.body.style.background= x;
    if (x == 'black'){
        document.body.style.color = "white";
        document.body.style.fontSize = "200%";
        document.body.style.fontFamily = "Arial, Helvetica, sans-serif"
    }else{
        document.body.style.color = "black";
        document.body.style.fontSize = "100%";
        document.body.style.fontFamily = "Arial, Helvetica, sans-serif"
    }
}