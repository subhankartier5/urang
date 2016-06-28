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

// ajax functions get customername
function getcustomername(str)
{
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("customernames").innerHTML=xmlhttp.responseText;
		}
	}
  
	xmlhttp.open("GET","getcustomername.php?q="+str,true);
	xmlhttp.send();
}

// pickup.php validation on form
function pickup_valid()
{
	var pickupdate = document.getElementById("pickupdate");
	var todate = document.getElementById("todate");
	var address = document.getElementById("txtAddress");
	var customername = document.getElementById("customername");
	
	var currentTime = new Date()
	var month = currentTime.getMonth() + 1
	var day = currentTime.getDate()
	var year = currentTime.getFullYear()
	var currentdate = month + "/" + day + "/" + year;
	
	if(customername.value=="")
	{
		alert("Please select customer name");
		customername.focus();
		return false;		
	}
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

// change password
function chkpwd()
{
	var newpwd = document.getElementById("newpwd");
	var confirmpwd = document.getElementById("confirmpwd");
	if(newpwd.value=="")
	{
		alert("Please enter new password");
		newpwd.focus();
		return false;
	}
	if(newpwd.value!="")
	{
		if(newpwd.value.length < 8)
		{
			alert("Password should be of at least 8 characters");
			newpwd.focus();
			return false;
		}
	}
	if(newpwd.value!="")
	{
		if(confirmpwd.value != newpwd.value)
		{
			alert("Confirm passoword must be equal to new password");
			confirmpwd.focus();
			return false;
		}
	}
	else{
		return true;
	}
}

function isNumeric(strString) //  check for valid numeric strings	
{
	if(!/\D/.test(strString)) return true;//IF NUMBER
	else if(/^\d+\d+$/.test(strString)) return true;//IF A DECIMAL NUMBER HAVING AN INTEGER ON EITHER SIDE OF THE DOT(.)
	else return false;
}

// customer registration validation on form
function registration_valid()
{
	var username = document.getElementById("username");
	var pass = document.getElementById("pass");
	var confirmpass = document.getElementById("confirmpass");
	var name = document.getElementById("customername");
	var email = document.getElementById("email");
	var address = document.getElementById("address");
	var phone = document.getElementById("phone");
	var cell = document.getElementById("cellphone");
	var officephone = document.getElementById("officephone");
	var cardholdername = document.getElementById("cardholdername");
	var cardtype = document.getElementById("cardtype");
	var creditcard = document.getElementById("cardnumber");
	var exmonth = document.getElementById("month");
	var cvv = document.getElementById("cvv2");
	var exyear = document.getElementById("year");
	var email_filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var phone_filter = /^\d{3}\d{3}\d{4}$/;
	//var phone_filter = /^\d{3}-\d{3}-\d{4}$/;
	
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
	if(name.value=="")
	{
		alert("Please enter customer name");
		name.focus();
		return false;
	}
	if(email.value=="")
	{
		alert("Please enter customer email");
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
	if(phone.value=="Format: 5555555555")
	{
		alert("Please enter customer phone number");
		phone.focus();
		return false;
	}
	if(!phone_filter.test(phone.value)){
			alert("Phone is in invalid format! (Correct Format: XXXXXXXXXX)");
			phone.focus();
			return false;
	}
	if(cell.value != "Format: 5555555555" && cell.value != "")
	{
		if(!phone_filter.test(cell.value)){
				alert("Cell phone is in invalid format! (Correct Format: XXXXXXXXXX)");
				cell.focus();
				return false;
		}
	}
	if(officephone.value != "Format: 5555555555" && officephone.value != "")
	{
		if(!phone_filter.test(officephone.value)){
				alert("Office phone is in invalid format! (Correct Format: XXXXXXXXXX)");
				officephone.focus();
				return false;
		}
	}
	if(address.value=="")
	{
		alert("Please enter customer address");
		address.focus();
		return false;
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

// update customers validation on form
function upd_customer_valid()
{
	var name = document.getElementById("customername");
	var email = document.getElementById("email");
	var address = document.getElementById("address");
	var phone = document.getElementById("phone");
	var cell = document.getElementById("cellphone");
	var officephone = document.getElementById("officephone");
	var email_filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var phone_filter = /^\d{3}\d{3}\d{4}$/;
	var cardholdername = document.getElementById("cardholdername");
	var cardtype = document.getElementById("cardtype");
	var creditcard = document.getElementById("cardnumber");
	var exmonth = document.getElementById("month");
	var cvv = document.getElementById("cvv2");
	var exyear = document.getElementById("year");	

	if(name.value=="")
	{
		alert("Please enter customer name");
		name.focus();
		return false;
	}
	if(email.value=="")
	{
		alert("Please enter customer email");
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
	if(phone.value=="Format: 5555555555")
	{
		alert("Please enter customer phone number");
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
	if(address.value=="")
	{
		alert("Please enter customer address");
		address.focus();
		return false;
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