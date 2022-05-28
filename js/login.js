const form = document.querySelector('#loginForm form'),
continueBtn = form.querySelector(".btn"),
errorText = document.querySelector(".errorMessage");



//prevent form from submitting
form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.onclick = () => {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'helpers/login-ajax.php', true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data=="success"){
                    location.href = "../index.php";
                }
                else{
                  
                    console.log(data);
                    errorText.innerHTML = data;
                    errorText.style.display = "block";
                    
                }
              
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);

 
}