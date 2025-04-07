var mainimg=document.querySelector('.slider img')
var imagess=['images/kitap1.jpeg','images/kitapimg3.webp','images/kitapimgsf.jpeg'];
var num=0;
const auto=true
const IntervalTime=5000;
let slideInterval


function next() {
    num++
    if(num>=imagess.length){
        num=0;
        mainimg.src=imagess[num]
    }else{
        mainimg.src=imagess[num]
    }
}

function back(){
    num--
    if(num<0){
        num=imagess.length-1
        mainimg.src=imagess[num]
    }else{
        mainimg.src=imagess[num]
    }
}
