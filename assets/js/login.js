var homeURL = "http://search.me/";
var loginURL = "http://search.me/login";
var registerURL = "http://search.me/login/register";
var logoutURL = "http://search.me/login/logout";
function showLogin(){
    $('#loginModal').modal('show');
}
function login(){
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    $.post(loginURL, {
        "username" : username.value,
        "password" : password.value
    }).done(function(data) {
        data = JSON.parse(data);
        if (data["status"]){
            alert("Login success!");
            window.location = homeURL;
        } else {
            alert( "Login failed!" );
            password.value = "";
        }
    });
}

function register(){
    var rUsername = document.getElementById("rUsername").value;
    var rPassword = document.getElementById("rPassword").value;
    var rrPassword = document.getElementById("rrPassword").value;
    if (rPassword !== rrPassword){
        alert("Passwords does not match!");
        return ;
    }
    $.post(registerURL, {
        "username" : rUsername,
        "password" : rPassword
    }).done(function(data) {
        data = JSON.parse(data);
        if (data["status"]){
            alert("Register success!");
            window.location = homeURL;
        } else {
            document.getElementById("rPassword").value = "";
            document.getElementById("rrPassword").value = "";
            alert("Register failed!");
        }
    });
}

function logout(){
    $.post(logoutURL, ).done(function() {
        alert("Logout success!");
        window.location = homeURL;
    });
}