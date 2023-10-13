const menuBtn = document.getElementById('menuBtn')
const navUser = document.querySelector('.navUser')

let isShow = 0

menuBtn.onclick = function(){
    console.log('test')
    if(isShow == 0){
        isShow = 1
        navUser.style.display = "flex"
    }
    else{
        navUser.style.display = "none"
        isShow = 0
    }
}