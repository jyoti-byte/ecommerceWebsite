function clearErrors(){

    var errors = document.getElementsByClassName('fieldError');
    for(let item of errors)
    {
        item.innerHTML = "";
    }


}
function seterror(id, error){
    //sets error inside tag of id 
    var element = document.getElementById(id);
    element.getElementsByClassName('fieldError')[0].innerHTML = error;

}

function validateForm(){
    var returnval = true;
    clearErrors();

    //perform validation and if validation fails, set the value of returnval to false
    var name = document.forms['myForm']["name"].value;
    console.log(name);
    if (name.length<5){
        seterror("name", "*Length of name is too short");
        returnval = false;
    }

    if (name.length == 0){
        seterror("name", "*Length of name cannot be zero!");
        returnval = false;
    }

    var email = document.forms['myForm']["email"].value;
    if (email.length>15){
        seterror("email", "*Email length is too long");
        returnval = false;
    }

    var mobile = document.forms['myForm']["mobile"].value;
    if (mobile.length != 10){
        seterror("mobile", "*Phone number should be of 10 digits!");
        returnval = false;
    }

    var password = document.forms['myForm']["password"].value;
    if (password.length < 6){
        seterror("password", "*Password should be atleast 6 characters long!");
        returnval = false;
    }

    var cpassword = document.forms['myForm']["cpassword"].value;
    if (cpassword.length === ""){
        seterror("password", "*Password cannot be blank!");
        returnval = false;
    }else{
        
    }

    return returnval;
}
