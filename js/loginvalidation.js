const form = document.getElementById('login-form');
const username = document.getElementById('username');
const password = document.getElementById('password');

	form.addEventListener('submit', (e) => {
		e.preventDefault();

		validate();
	})

	const sendData = (usernameVal, passwordVal, sRate, count) => {
		if(sRate === count){
			alert("login successful");
			location.href = "checkout.php";
		}
	}

	const successMsg = (usernameVal, passwordVal) => {
		let formGro = document.getElementsByClassName('form-group');
		
		var count = formGro.length - 1;
		for(var i =0; i < formGro.length; i++){
			if(formGro[i].className === 'form-group success'){
				var sRate = 0 + i;
				sendData(usernameVal, passwordVal, sRate, count);
			}else {
				return false;
			}
		}
	}	

	//define the validate function

	const validate = () => {
		const usernameVal = username.value.trim();
		const passwordVal = password.value.trim();

		if(usernameVal === ""){
			setErrorMsg(username, '*Username cannot be blank');
		}else if(usernameVal.length < 5){
			setErrorMsg(username, '*Username is too short')
		}else{
			setSuccessMsg(username);
		}

		if(passwordVal === ""){
			setErrorMsg(password, '*Password cannot be blank');
		}else if(passwordVal.length < 6){
			setErrorMsg(password, '*Password must be longer than 6 characters');
		}
		else if(passwordVal.length >=20){
			setErrorMsg(password, '*Password must be less than 20 characters');
		}else{
			setSuccessMsg(password);
		}

		successMsg(usernameVal,passwordVal);

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
	}