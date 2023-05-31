const forms = document.querySelector(".forms"),
      pwShowHide = document.querySelectorAll(".eye-icon"),
      links = document.querySelectorAll(".link");

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
        
        pwFields.forEach(password => {
            if(password.type === "password"){
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        })
        
    })
})      

links.forEach(link => {
    link.addEventListener("click", e => {
       e.preventDefault(); 
       forms.classList.toggle("show-signup");
    })
})

function checkPassword(){
    let password = document.getElementById("password").value;
    let cnfrmPassword = document.getElementById("confirm").value;
    console.log(" Password:", password,'\n',"Confirm Password:",cnfrmPassword);
    let message = document.getElementById("message");
    let messages = document.getElementById("messages");
    if(password.length != 0){
        if(password == cnfrmPassword){
        }
        else{
            alert("Password must be match");
            exit;
        }
    }
}

let parameters = {
    count : false,
    letters : false,
    numbers : false,
    special : false
}
let strengthBar = document.getElementById("strength-bar");
let strengBar = document.getElementById("streng-bar");
let msg = document.getElementById("message");
let ms = document.getElementById("messages");

function strengthChecker(){
    let password = document.getElementById("password").value;

    parameters.letters = (/[A-Za-z]+/.test(password))?true:false;
    parameters.numbers = (/[0-9]+/.test(password))?true:false;
    parameters.special = (/[!\"$%&/()=?@~`\\.\';:+=^*_-]+/.test(password))?true:false;
    parameters.count = (password.length > 7)?true:false;

    let barLength = Object.values(parameters).filter(value=>value);

    console.log(Object.values(parameters), barLength);

    strengthBar.innerHTML = "";
    for( let i in barLength){
        let span = document.createElement("span");
        span.classList.add("strength");
        strengthBar.appendChild(span);
    }

    let spanRef = document.getElementsByClassName("strength");
    for( let i = 0; i < spanRef.length; i++){
        switch(spanRef.length - 1){
            case 0 :
                spanRef[i].style.background = "red";
                msg.textContent = "Your password is very weak";
                msg.style.color = "#7d2ae8";
                break;
            case 1:
                spanRef[i].style.background = "#ff691f";
                msg.textContent = "Your password is weak";
                msg.style.color = "#7d2ae8";
                break;
            case 2:
                spanRef[i].style.background = "#ffda36";
                msg.textContent = "Your password is good";
                msg.style.color = "#7d2ae8";
                break;
            case 3:
                spanRef[i].style.background = "#0be881";
                msg.textContent = "Your password is strong";
                msg.style.color = "#7d2ae8";
                break;
        }
    }
}

function strengthChecke(){
    let password = document.getElementById("confirm").value;

    parameters.letters = (/[A-Za-z]+/.test(password))?true:false;
    parameters.numbers = (/[0-9]+/.test(password))?true:false;
    parameters.special = (/[!\"$%&/()=?@~`\\.\';:+=^*_-]+/.test(password))?true:false;
    parameters.count = (password.length > 7)?true:false;

    let barLength = Object.values(parameters).filter(value=>value);

    console.log(Object.values(parameters), barLength);

    strengBar.innerHTML = "";
    for( let i in barLength){
        let span = document.createElement("span");
        span.classList.add("streng");
        strengBar.appendChild(span);
    }

    let spanRef = document.getElementsByClassName("streng");
    for( let i = 0; i < spanRef.length; i++){
        switch(spanRef.length - 1){
            case 0 :
                spanRef[i].style.background = "red";
                ms.textContent = "Your password is very weak";
                ms.style.color = "#7d2ae8";
                break;
            case 1:
                spanRef[i].style.background = "#ff691f";
                ms.textContent = "Your password is weak";
                ms.style.color = "#7d2ae8";
                break;
            case 2:
                spanRef[i].style.background = "#ffda36";
                ms.textContent = "Your password is good";
                ms.style.color = "#7d2ae8";
                break;
            case 3:
                spanRef[i].style.background = "#0be881";
                ms.textContent = "Your password is strong";
                ms.style.color = "#7d2ae8";
                break;
        }
    }
}