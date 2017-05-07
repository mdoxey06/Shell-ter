
window.onsubmit=validateForm;

function validateForm() {
    var password = document.getElementById("password").value;
    var email= document.getElementById("email").value;
    var reEmail= /(\w)+@(\w)+/;
    var rePassword= /[0-9]/;
    errorMessage = "";

    //Password validation portion
    if (password.length < 8) {
        errorMessage += "Password must contain at least 8 characters.<br>";
    }
    
    if (!password.match(rePassword)) {
        errorMessage += "Password must contain at least 1 number.<br>";
    }
    
    rePassword = /[a-z]/;
     if(!password.match(rePassword)) {
        errorMessage += "Password must contain at least one lowercase letter.<br>";
    }
     
    rePassword = /[A-Z]/;
    if(!password.match(rePassword)) {
        errorMessage += "Password must contain at least one uppercase letter.<br>";
    }

    //Email validation portion
    if (!email.match(reEmail)) {
        errorMessage += "Improper email formatting.";
    }

    //Checking to see if there are any errors with the message
    if (errorMessage !== "") {
        document.getElementById("modalText").innerHTML= errorMessage;
        $('#myModal').modal('show');
        return false;
    }
    else {
        return true;
    }
}
