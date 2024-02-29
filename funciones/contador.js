let minutos=1;
let segundos=0;
cargarSegundo();
cargarMinutos();


function cargarSegundo(){
let txtsegundos;

if(segundos<0){
    segundos=59;
}

if(segundos<10){
    txtsegundos= `0${segundos}`;
}else{
    txtsegundos=segundos;
}
document.getElementById('segundos').innerHTML=txtsegundos;
segundos--;

cargarMinutos(segundos);
}

function cargarMinutos(segundos)
{
 let txtMinutos;

 if(segundos==-1&&minutos!==0){
    setTimeout(()=>{
        minutos--;
    },500)
 }else if(segundos==0&&minutos==0){
    
    location.href="cerrar_sesion.php";
    
    
 }
//mostrar minutos
if(minutos<10){
    txtMinutos=`0${minutos}`;
}
document.getElementById('minutos').innerHTML=txtMinutos;

}




setInterval(cargarSegundo,1000);
