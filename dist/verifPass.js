//function verif password
const verifPass = document.querySelector('.verifPass')
const password = document.getElementById('password')

password.addEventListener('input', ()=>{
    verifPass.style.display = "block";
    
    //check taille mdp
    if(password.value.length >= 8){
        document.querySelector('.minChars').style.color = 'green'
    }
    else{
        document.querySelector('.minChars').style.color = 'red'
    }
    //check si présence majuscules et minuscule 
    if(password.value.match(/[a-z]/) && password.value.match(/[A-Z]/)){
        document.querySelector('.majAndMin').style.color = 'green'
    }
    else{
        document.querySelector('.majAndMin').style.color = 'red'
    }
    //check si il y a des nombre
    if(password.value.match(/\d/)){
        document.querySelector('.min1Number').style.color = 'green'
    }
    else{
        document.querySelector('.min1Number').style.color = 'red'
    }
    // Check for special characters
    if (password.value.match(/[^a-zA-Z\d]/)){
        document.querySelector('.minSpecialChars').style.color = 'green'
    }
    else{
        document.querySelector('.minSpecialChars').style.color = 'red'
    }
})

function verifPassOnSubmit(){
    const sendErr = document.getElementById('sendErr')
    if(password.value.length >= 8 && (password.value.match(/[a-z]/) && password.value.match(/[A-Z]/)) && password.value.match(/\d/) && password.value.match(/[^a-zA-Z\d]/)){
        return true;
    }
    else{
        sendErr.innerHTML = "Veuillez entrer un mot de passe valide"
        return false;
    } 
}