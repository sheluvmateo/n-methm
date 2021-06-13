var rer=0;
var ver=0;
gomb.disabled=false;
function jatek(){
    tomb=["ko","papir","ollo"];
    szam=Math.floor(Math.random()*10)%3;
    document.getElementById('egyben').src="pic/"+tomb[szam]+".png";
    var vendeg="";
    var robot="";
    if(document.getElementById('ko').checked){
        vendeg=document.getElementById('ko').value;
    }
    if(document.getElementById('papir').checked){
        vendeg=document.getElementById('papir').value;
    }
    if(document.getElementById('ollo').checked){
        vendeg=document.getElementById('ollo').value;
    }

    robot=tomb[szam];
    if( vendeg == robot){
        alert("Döntetlen, tessék újra dobni!")
    }else{
        switch (vendeg) {
            case "ko":
                if(robot=="papir"){
                    document.getElementById('er').innerHTML="Robot nyert!";
                    rer++
                }else{
                    document.getElementById('er').innerHTML="Vendég nyert!";
                    ver++ 
                }
            break;
            case "papir":
                if(robot=="ollo"){
                    document.getElementById('er').innerHTML="Robot nyert!";
                    rer++
                }else{
                    document.getElementById('er').innerHTML="Vendég nyert!";
                    ver++  
                }
            break;
            case "ollo":
                if(robot=="ko"){
                    document.getElementById('er').innerHTML="Robot nyert!";
                    rer++
                }else{
                    document.getElementById('er').innerHTML="Vendég nyert!";
                    ver++  
                }
            break
            default:
        }
    }
    document.getElementById('rer').innerHTML=rer;
    document.getElementById('ver').innerHTML=ver;
    var nyertes=""
    if(ver>rer) {
        nyertes="Vendég"
    }else{
        nyertes="Robot";
    }
    if(ver+rer<3){
        gomb.disabled=false;
    }else{
        gomb.disabled=true;
        gomb.style.backgroundColor="grey";
        alert("A "+nyertes+" nyert! :)");
    }
    document.getElementById('teszt').innerHTML=vendeg+"+"+robot;
}