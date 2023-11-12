
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
            transportDiv.innerHTML = '<input type="number" class="form-control" id="transportMontant" placeholder="Entrez le montant du transport" name="transportMontant"><Label>Justificatifs : </Label><input class="form-control" type="file" name="transportFile">'
        }
        else{
            transportDiv.innerHTML = '<input type="number" placeholder="Entrez le nombre de kilomètre parcouru" step="0.1" name="kmTransport" class="form-control">'
        }
    })
}
console.log(train.checked)