const inputField = document.querySelector("#category-input");
const lengthCounter = document.querySelector("#input-length-counter");

if (lengthCounter && inputField) { 
    lengthCounter.textContent = 20 - parseInt(inputField.value.length);
    
    inputField.addEventListener("input", function(e) {

        if (e.currentTarget.value.length > 20) {
            e.currentTarget.value = e.currentTarget.value.substring(0, 20);
        }
        lengthCounter.textContent = 20 - parseInt(e.currentTarget.value.length);
    });

}

const dltError = document.querySelector(".dlt-error");

if (dltError) {
        
    setTimeout(function() {
        dltError.parentElement.removeChild(dltError);
    }, 4000);
}

// function validateForm1() {
//     const inputField = document.querySelector("#category-input");
//     const input = inputField.value;
//     const alerts = document.querySelectorAll(".alert");
//     let error = false;

//     if(alerts) {
//         for (let i = 0; i < alerts.length; i++) {
//             alerts[i].parentElement.removeChild(alerts[i]);
//         }
//     }

//     if (input.trim().length === 0 || input.trim().length > 20) {
//         // const alert = document.createElement("span");
//         // alert.classList.add("update-error");
//         // alert.textContent = "upp till 50 tecken";
//         // inputField.after(alert);
//         error = true;
//     }

//     if (error) return false
// }

function validateForm1(){

	const category = document.getElementById('category-input');
	const popMessage = document.getElementById('popMessage');

	if(category.value.trim() == null || category.value.trim() == ''){

		popMessage.innerText = 'Ange en title till kategorin.'
		setTimeout(function(){
			popMessage.innerText = ''
		}, 3000);
		return false;
    }
    
	if(category.value.match(/\d+/g)){
		
		popMessage.innerText = 'Title på kategorin får inte innehålla siffror.'
		setTimeout(function(){
			popMessage.innerText = ''
		}, 3000);
		return false;
    }
    
	if(category.value.length < 2){
		
		popMessage.innerText = 'Title på kategorin måste innehålla minst vara 2 tecken.'
		setTimeout(function(){
			popMessage.innerText = ''
		}, 3000);
		return false;
    }
    
	if(category.value.length > 20){
		
		popMessage.innerText = 'Title får vara max 20 tecken.'
		setTimeout(function(){
			popMessage.innerText = ''
		}, 3000);
		return false;
    }
    
	return true;
}

function validateForm(){

	const category = document.getElementById('category');
	const popMessage = document.getElementById('popMessage');

	if(category.value.trim() == null || category.value.trim() == ''){

		popMessage.innerText = 'Ange en title till kategorin.'
		setTimeout(function(){
			popMessage.innerText = ''
		}, 3000);
		return false;
  }
  
	if(category.value.match(/\d+/g)){
		
		popMessage.innerText = 'Title på kategorin får inte innehålla siffror.'
		setTimeout(function(){
			popMessage.innerText = ''
		}, 3000);
		return false;
  }
  
	if(category.value.length < 2){
		
		popMessage.innerText = 'Title på kategorin måste innehålla minst vara 2 tecken.'
		setTimeout(function(){
			popMessage.innerText = ''
		}, 3000);
		return false;
  }
  
	if(category.value.length > 20){
		
		popMessage.innerText = 'Title får vara max 20 tecken.'
		setTimeout(function(){
			popMessage.innerText = ''
		}, 3000);
		return false;
  }
  
  return true;
  
}