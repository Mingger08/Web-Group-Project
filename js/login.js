$(function() {
    $("#bgmodalLogin").load("../html/userauthentication/login.php");
});

/*Open Login Form*/
function openLoginForm() {
    document.querySelector(".bgmodallogin").style.display = "flex";

    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    var x = window.scrollX;
    var y = window.scrollY;
    window.onscroll = function() { window.scrollTo(x, y); };
}

/*Close Login Form*/
function closeLoginForm() {
    document.querySelector(".bgmodallogin").style.display = "none";
    document.loginform.email.value = '';
    document.loginform.password.value = '';
    window.onscroll = function() {};
}

function loginformValidation() {
    /*Get Position*/
    var position = document.getElementById("position");
    var email = document.loginform.email;
    var password = document.loginform.password;

    /*Validate*/
    var upper_lower_number = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    var val_email = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    /*Email Format*/
    if (!email.value.match(val_email)) {
        alert("You have entered an invalid email address!");
        email.focus();
        return false;
    }
    /*Password Contain Only Uppercase, Lowercase,min 8 length */
    else if (!password.value.match(upper_lower_number)) {
        alert("Format password is wrong.");
        password.focus();
        return false;
    }
}