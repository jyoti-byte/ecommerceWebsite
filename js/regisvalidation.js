var form = document.getElementById('register-form');
const fname = document.getElementById('name');
const email = document.getElementById('email');
const mobile = document.getElementById('mobile');
const password = document.getElementById('password');
const cpassword = document.getElementById('cpassword');

	form.addEventListener('submit', (e) => {
		e.preventDefault();

		validate();
	})

	// const sendData = (fnameVal, passwordVal, sRate, count) => {
	// 	if(sRate === count){
	// 		alert("Registration successful");
	// 		location.href = "login.php";
	// 	}
	// }

	// const successMsg = (fnameVal, passwordVal) => {
	// 	let formGro = document.getElementsByClassName('form-group');
		
	// 	var count = formGro.length - 1;
	// 	for(var i =0; i < formGro.length; i++){
	// 		if(formGro[i].className === 'form-group success'){
	// 			var sRate = 0 + i;
	// 			sendData(fnameVal, passwordVal, sRate, count);
	// 		}else {
	// 			return false;
	// 		}
	// 	}
	// }
    
    var fnameBool = false;
    var emailBool = false;
    var mobileBool = false;
    var passwordBool = false;
    var cpasswordBool = false;


	//define the validate function

	const validate = () => {
		const fnameVal = fname.value.trim();
		const emailVal = email.value.trim();
        const mobileVal = mobile.value.trim();
        const passwordVal = password.value.trim();
        const cpasswordVal = cpassword.value.trim();

		if(fnameVal === ""){
			setErrorMsg(fname, '*Full name cannot be blank');
		}else if(fnameVal.length < 10){
			setErrorMsg(fname, '*Full name is too short')
		}else{
            fnameBool = true;
			setSuccessMsg(fname);
		}
        
        if(emailVal === ""){
			setErrorMsg(email, '*Email cannot be blank');
		}else if(emailVal.length < 10){
			setErrorMsg(email, '*Email is too short')
		}else{
            emailBool = true;
			setSuccessMsg(email);
		}

        if(mobileVal === ""){
			setErrorMsg(mobile, '*Mobile number cannot be blank');
		}else if(mobileVal.length < 10){
			setErrorMsg(mobile, '*Mobile number is invalid')
		}else{
            mobileBool = true;
			setSuccessMsg(mobile);
		}

		if(passwordVal === ""){
			setErrorMsg(password, '*Password cannot be blank');
		}else if(passwordVal.length < 6){
			setErrorMsg(password, '*Password must be longer than 6 characters');
		}
		else if(passwordVal.length >= 20){
			setErrorMsg(password, '*Password must be less than 20 characters');
		}else{
            passwordBool = true;
			setSuccessMsg(password);
		}

        if(cpasswordVal === ""){
			setErrorMsg(cpassword, '*Confirm Password cannot be blank');
		}else if(cpasswordVal !== passwordVal){
			setErrorMsg(cpassword, '*Passwords do not match');
		}else{
            cpasswordBool = true;
			setSuccessMsg(cpassword);
		}

		// successMsg(fnameVal,emailVal, mobileVal, passwordVal, cpasswordVal);

	}

	function setErrorMsg(input, errormsgs){
		const formGroup = input.parentElement;
		const small = formGroup.querySelector('small');
		formGroup.className = "form-group error";
		small.innerText = errormsgs;
	}

	function setSuccessMsg(input){
		const formGroup = input.parentElement;
		formGroup.className = "form-group success";

        if(fnameBool === true && emailBool === true && mobileBool === true && passwordBool === true && cpasswordBool === true){
            alert("Data saved.");
            // location.href = "login.php";
            form.submit();
        }
	}