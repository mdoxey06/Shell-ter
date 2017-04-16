/* for the sign up carousel i assume we'll have an event when
 * we go to the next question...if it's an arrow, we can just
   link that event to that question's validation function */

function validatePassword() {
    var password = document.getElementById("password").value;
    errorMessage = "";
    
    if (password.length < 8) {
        errorMessage += "Password must contain at least 8 characters\n";
    }
    
    verifyPassword = document.getElementById("verifyPassword").value;
    if (password !== verifyPassword) {
        errorMessage += "Passwords must match\n";
    }
    
    var re = /[0-9]/;
    if (!password.match(re)) {
        errorMessage += "Password must contain at least 1 number\n";
    }
    
    re = /[a-z]/;
     if(!password.match(re)) {
        errorMessage += "Password must contain at least one lowercase letter\n";
    }
     
    re = /[A-Z]/;
    if(!password.match(re)) {
        errorMessage += "Password must contain at least one uppercase letter\n";
    }
     
    if (errorMessage !== "") {
        alert(errorMessage);
        // For right now we'll use JS' alert, but we can change it to JQuery Dialog or something more
        // customizable at a later time
        return false;
    }
    else return true;
}

function validatePhoneNumber() {
    var phoneNumber = document.getElementById("phoneNumber");
    var numRE1 = /[0-9]{10}/;
    var numRE2 = /[0-9]{3}-[0-9]{3}-[0-9]{4}/;
    
    if (phoneNumber.match(numRE1) || phoneNumber.match(numRE2)) {
        return true;
    }
    else {
        alert("Please enter a valid phone number (###-###-####)");
        return false;
    }
}







