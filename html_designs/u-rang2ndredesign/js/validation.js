// pickup.php validation on form
function pickup_valid()
{
	var pickupdate = document.getElementById("pickupdate");
	var todate = document.getElementById("todate");
	var address = document.getElementById("txtAddress");
	
	var currentTime = new Date()
	var month = currentTime.getMonth() + 1
	var day = currentTime.getDate()
	var year = currentTime.getFullYear()
	var currentdate = month + "/" + day + "/" + year;
	
	if(address.value=="")
	{
		alert("Please enter pickup address");
		address.focus();
		return false;
	}
	if(pickupdate.value=="")
	{
		alert("Please select pickup date");
		pickupdate.focus();
		return false;
	}
	//if(pickupdate.value < todate.value)
	if(Date.parse(currentdate)>Date.parse(pickupdate.value))
	{
		alert("Pickup date should be greater than todate!");
		pickupdate.focus();
		return false;
	}
	return true;
}

function isNumeric(strString) //  check for valid numeric strings	
{
	if(!/\D/.test(strString)) return true;//IF NUMBER
	else if(/^\d+\d+$/.test(strString)) return true;//IF A DECIMAL NUMBER HAVING AN INTEGER ON EITHER SIDE OF THE DOT(.)
	else return false;
}

function emptyformat(s)
{
	if(s.value=="Format: 5555555555")
	{
		s.value="";
	}
}
function resetformat(s)
{
	if(s.value=="")
	{
		s.value="Format: 5555555555";
	}
}

// Regiser.php validation on form
function registration_valid(chk)
{
	if(chk==1) {
		var username = document.getElementById("txtUsername");
		var pass = document.getElementById("txtPassword");
		var confirmpass = document.getElementById("txtConfirm");
	}
	var name = document.getElementById("txtName");
	var email = document.getElementById("txtEmail");
	var address = document.getElementById("txtAddress");
	var phone = document.getElementById("txtPhone");
	var cell = document.getElementById("txtCell");
	var officephone = document.getElementById("txtOfficephone");
	var cardholdername = document.getElementById("txtCardHolderName");
	var cardtype = document.getElementById("ddlCardType");
	var creditcard = document.getElementById("txtCreditCard");
	var cvv = document.getElementById("txtCVV2");
	var exmonth = document.getElementById("month");
	var exyear = document.getElementById("year");
	var email_filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var phone_filter = /^\d{3}\d{3}\d{4}$/;
	//var phone_filter = /^\d{3}-\d{3}-\d{4}$/;

	if(chk==1) {
		if(username.value=="")
		{
			alert("Please enter username");
			username.focus();
			return false;
		}
		if(username.value!="")
		{
			if(username.value.length < 3)
			{
				alert("Username should be of at least 3 characters");
				username.focus();
				return false;
			}
		}
		if(pass.value=="")
		{
			alert("Please enter password");
			pass.focus();
			return false;
		}
		if(pass.value!="")
		{
			if(pass.value.length < 8)
			{
				alert("Password should be of at least 8 characters");
				pass.focus();
				return false;
			}
		}
		if(pass.value != "")
		{
			if(pass.value != confirmpass.value)
			{
				alert("Password and confirm password doesn't match");
				confirmpass.focus();
				return false;
			}
		}
	}
	if(name.value=="")
	{
		alert("Please enter your name");
		name.focus();
		return false;
	}
	if(email.value=="")
	{
		alert("Please enter your email");
		email.focus();
		return false;
	}
	if(email.value !="")
	{
		if (!email_filter.test(email.value))
		{
			alert("Please enter valid email");
			email.focus();
			return false;
		}
	}
	if(address.value=="")
	{
		alert("Please enter your address");
		address.focus();
		return false;
	}
	if(phone.value=="Format: 5555555555")
	{
		alert("Please enter your phone number");
		phone.focus();
		return false;
	}
	if(!phone_filter.test(phone.value)){
			alert("Phone is in invalid format! (Correct Format: XXXXXXXXXX)");
			phone.focus();
			return false;
	}
	if(cell.value != "Format: 5555555555")
	{
		if(!phone_filter.test(cell.value)){
				alert("Cell phone is in invalid format! (Correct Format: XXXXXXXXXX)");
				cell.focus();
				return false;
		}
	}
	if(officephone.value != "Format: 5555555555")
	{
		if(!phone_filter.test(officephone.value)){
				alert("Office phone is in invalid format! (Correct Format: XXXXXXXXXX)");
				officephone.focus();
				return false;
		}
	}
	if(cardholdername.value=="")
	{
		alert("Please enter card holder name");
		cardholdername.focus();
		return false;
	}
	if(cardtype.value=="")
	{
		alert("Please select card type");
		cardtype.focus();
		return false;
	}
	if(creditcard.value=="")
	{
		alert("Please enter credit card number");
		creditcard.focus();
		return false;
	}
	if(isNumeric(cvv.value)==false)
	{
		alert("Please enter only numbers for cvv2");
		cvv.focus();
		return false;
	}
	if(exmonth.value=="")
	{
		alert("Please select month for expiration date");
		exmonth.focus();
		return false;
	}
	if(exyear.value=="")
	{
		alert("Please select year for expiration date");
		exyear.focus();
		return false;
	}
	else
	{
		if(cell.value == "Format: 5555555555")
		{ cell.value=""; }
		if(officephone.value == "Format: 5555555555")
		{ officephone.value=""; }
		
		return true;
	}
}