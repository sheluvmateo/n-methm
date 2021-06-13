var i = 0;
var e = 0;
var u = 0;

function kepn(){
    var kep = document.getElementById('pic');
    var kepe = document.getElementById('pice');
    var kepu = document.getElementById('picu');
    if(i<1){
        i=4;
    }
    if(i>4){
        i=1;
    }
    kep.src="pic/img_"+i+".jpg";

    e=i-1;
    u=i+1;

    if(e<1){
        e=4;
    }
    if(u<1){
        u=4;
    }
    if(e>4){
        e=1;
    }
    if(u>4){
        u=1;
    }

    kepe.src="pic/img_"+e+".jpg";
    kepu.src="pic/img_"+u+".jpg";
    
}
function bal(){
    i--;

    kepn();
}
function jobb(){
    i++;

    kepn();
}