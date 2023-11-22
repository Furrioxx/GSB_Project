
//nav bar clickable 
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

//radio input transport changement des champs à remplir
const train = document.getElementById('train')
const radios = document.querySelectorAll('.form-check-input')
const transportDiv = document.querySelector('.transportDiv')

for(let i = 0; i<radios.length; i++){
    radios[i].addEventListener('click', ()=>{
        if(train.checked){
            transportDiv.innerHTML = '<input type="number" class="form-control" id="transportMontant" placeholder="Entrez le montant du transport" name="transportMontant"><Label>Justificatifs : </Label><input class="form-control" type="file" id="transportFile" name="transportFile">'
        }
        else{
            transportDiv.innerHTML = '<input type="number" placeholder="Entrez le nombre de kilomètre parcouru" step="0.1" name="kmTransport" class="form-control">'
        }
    })
}


//vérification des champs du formulaire ajout de fiche frais

function formValidation(){
    const err_message = document.querySelector('.err-message')

    const transportMontant = document.getElementById('transportMontant')
    const transportFile = document.getElementById('transportFile')

    const TimeLogement =document.getElementById('TimeLogement')
    const priceLogement =document.getElementById('priceLogement')

    const restaurantTime =document.getElementById('restaurantTime')
    const restaurantPrice =document.getElementById('restaurantPrice')

    const libellOther = document.getElementById('libellOther')
    const montantOther = document.getElementById('montantOther')
    const fileOther = document.getElementById('fileOther')

    let isgood = true

    console.log(transportMontant)
    if(transportMontant != null){
        console.log(transportFile.files.length + " " + transportMontant.value)
        if(transportMontant.value != '' &&  transportFile.files.length == 0){
            console.log('test1')
            isgood = false
        }
        else if(transportFile.files.length != 0 && transportMontant.value == ''){
            isgood = false
            console.log('test2')
        }
        else if(TimeLogement.value != '' && priceLogement.value == ''){
            isgood = false
        }
        else if(TimeLogement.value == '' && priceLogement.value != ''){
            isgood = false
        }
        else if(restaurantTime.value != '' && restaurantPrice.value == ''){
            isgood = false
        }
        else if(restaurantTime.value == '' && restaurantPrice.value != ''){
            isgood = false
        }
        else if(libellOther.value != '' && montantOther.value == '' && fileOther.files.length == 0){
            isgood = false
        }
        else if(libellOther.value == '' && montantOther.value == '' && fileOther.files.length != 0){
            isgood = false
        }
        else if(libellOther.value == '' && montantOther.value != '' && fileOther.files.length == 0){
            isgood = false
        }
        else if(libellOther.value != '' && montantOther.value != '' && fileOther.files.length == 0){
            isgood = false
        }
        else if(libellOther.value != '' && montantOther.value == '' && fileOther.files.length != 0){
            isgood = false
        }
        else if(libellOther.value == '' && montantOther.value != '' && fileOther.files.length != 0){
            isgood = false
        }
        else{
            isgood = true
        }
    }
    else{
        if(TimeLogement.value != '' && priceLogement.value == ''){
            isgood = false
        }
        else if(TimeLogement.value == '' && priceLogement.value != ''){
            isgood = false
        }
        else if(restaurantTime.value != '' && restaurantPrice.value == ''){
            isgood = false
        }
        else if(restaurantTime.value == '' && restaurantPrice.value != ''){
            isgood = false
        }
        else if(libellOther.value != '' && montantOther.value == '' && fileOther.files.length == 0){
            isgood = false
        }
        else if(libellOther.value == '' && montantOther.value == '' && fileOther.files.length != 0){
            isgood = false
        }
        else if(libellOther.value == '' && montantOther.value != '' && fileOther.files.length == 0){
            isgood = false
        }
        else if(libellOther.value != '' && montantOther.value != '' && fileOther.files.length == 0){
            isgood = false
        }
        else if(libellOther.value != '' && montantOther.value == '' && fileOther.files.length != 0){
            isgood = false
        }
        else if(libellOther.value == '' && montantOther.value != '' && fileOther.files.length != 0){
            isgood = false
        }
        else{
            isgood = true
        }
    }
    
        
        
    if(isgood){
        return true
    }else{
        err_message.innerHTML = "Les champs n'ont pas été correctement remplies"
        return false
    }
}

const hoverPP = document.querySelector('.hoverPP')
const formModifyPP = document.querySelector('.formModifyPP')
let g = 0
hoverPP.onclick = function(){
    if(g==0){
        formModifyPP.style.display = "block"
        g = 1
    }
    else{
        formModifyPP.style.display = "none";
        g = 0
    }
}