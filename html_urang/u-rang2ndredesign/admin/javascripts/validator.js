function loginCheck(){
	var Error="";
	if (document.form1.login_name.value==""){
		Error+="Please Enter Login Name\n";
	}
	if (document.form1.password.value==""){
		Error+="Please Enter Password\n";
	}	
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}
}

function getPassword(){
	var Error="";
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	if (document.form1.login_name.value==""){
		Error+="Please Enter Login Name\n";
	}
	if (document.form1.email.value==""){
		Error+="Please Enter Email Address\n";
	}	
	else if (!filter.test(document.form1.email.value)){
		Error+="Invalid Email Address\n";
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}	
	
}

function siteConfig(){
	var Error="";	
	var email_filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	var url_filter=/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	if (document.form1.site_title.value==""){
		Error+="Please Enter Site Title\n";
	}
	if (document.form1.site_url.value==""){
		Error+="Please Enter Site URL\n";
	}
	//else if (!url_filter.test(document.form1.site_url.value)){
		//Error+="Invalid Site URL\n";
	//}
	if (document.form1.site_email.value==""){
		Error+="Please Enter Site Email Address\n";
	}	
	else if (!email_filter.test(document.form1.site_email.value)){
		Error+="Invalid Site Email Address\n";
	}
	if (document.form1.meta_keywords.value==""){
		Error+="Please Enter Meta Keywords\n";
	}
	if (document.form1.meta_description.value==""){
		Error+="Please Enter Meta Description\n";
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}	
}

function changeLoginEmail(){
	var Error="";		
	var email_filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	
	if (document.form1.login_name.value==""){
		Error+="Please Enter Login Name\n";
	}
	if (document.form1.email.value==""){
		Error+="Please Enter Email Address\n";
	}	
	else if (!email_filter.test(document.form1.email.value)){
		Error+="Invalid Email Address\n";
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}		
}

function changePassword(){
	var Error="";
	
	if (document.form2.old_password.value==""){
		Error+="Please Enter Old Password\n";
	}
	if (document.form2.password1.value==""){
		Error+="Please Enter New Password\n";
	}	
	else if (document.form2.password1.value.length<8){
		Error+="Password must be at least 8 characters long\n";
	}	
	else if (document.form2.password1.value!=document.form2.password2.value){
		Error+="Passwords don't match\n";
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}		
}

function Page(){
	var Error="";
	if (document.form1.description.value==""){
		Error+="Please Enter Page Description\n";
	}
	if (document.form1.name.value==""){
		Error+="Please Enter Page Name\n";
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}
}

function Article(){
	var Error="";

	if (document.form1.name.value==""){
		Error+="Please Enter Article Name\n";
	}
	if (document.form1.time.value==""){
		Error+="Please Select Time\n";
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}
}

function Event(){
	var Error="";
	var url_filter=/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	if (document.form1.event_name.value==""){
		Error+="Please Enter Event Name\n";
	}
	if (tinyMCE.activeEditor.getContent()==""){
		Error+="Please Enter Event Description\n";
	}
	if (!url_filter.test(document.form1.url.value)){
		Error+="Invalid URL\n";
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}
}

function Testimonial(){
	var Error="";
	if (document.form1.testimonial_name.value==""){
		Error+="Please Enter Testimonial Name\n";
	}
	if (document.form1.image.value==""){
		Error+="Please Select Testimonial Image\n";
	}
	if (tinyMCE.activeEditor.getContent()==""){
		Error+="Please Enter Testimonial Text\n";
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}
}

function FAQ(){
	var Error="";
	if (document.form1.question.value==""){
		Error+="Please Enter Question\n";
	}
	if (tinyMCE.activeEditor.getContent()==""){
		Error+="Please Enter Answer\n";
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}
}

function Menu(){
	var Error="";
	var url_filter=/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	if (document.form1.menu_name.value==""){
		Error+="Please Enter Menu Link Name\n";
	}
	if (document.form1.other_url.value!="http://"){
		if (!url_filter.test(document.form1.other_url.value)){
			Error+="Invalid URL\n";
		}
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}
}

function Header(){
	var Error="";
	var url_filter=/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	if (document.form1.menu_name.value==""){
		Error+="Please Enter Header Link Name\n";
	}
	if (document.form1.other_url.value!="http://"){
		if (!url_filter.test(document.form1.other_url.value)){
			Error+="Invalid URL\n";
		}
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}
}

function Footer(){
	var Error="";
	var url_filter=/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	if (document.form1.menu_name.value==""){
		Error+="Please Enter Footer Link Name\n";
	}
	if (document.form1.other_url.value!="http://"){
		if (!url_filter.test(document.form1.other_url.value)){
			Error+="Invalid URL\n";
		}
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}
}

function Images(){
	var Error="";
	if (document.form1.image_name.value==""){
		Error+="Please Enter Image Name\n";
	}
	if (document.getElementById("image").value==""){
		Error+="Please Select Image\n";
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}
}

function Document(){
	var Error="";
	if (document.form1.document_name.value==""){
		Error+="Please Enter Document Name\n";
	}
	if (document.getElementById("doc").value==""){
		Error+="Please Select Document\n";
	}
	if (Error!=""){
		alert("Errors:\n\n"+Error);
		return false;
	}
}

function showHide (id){	
	if(document.getElementById(id).style.display == 'none'){
		document.getElementById(id).style.display = '';
	}
	else{
		document.getElementById(id).style.display = 'none';
	}
}

function viewImage(url){
	if (url!="")
		window.open('image.php?id='+url);
	else
		alert("Select an Image.");
}
function Banner()
{
	var Error="";
if(document.form1.link.value==""){
	Error = "\n Please enter link "; 
	}
if(document.form1.banner.value == ""){
	Error+="\n Please select Banner Image"; 
	}	
else if(document.form1.banner.value != ""){
		f1 = document.form1.banner.value;
			temp_string1 = f1.indexOf(".jpg");
			temp_string1b = f1.indexOf(".JPG");
			temp_string2 = f1.indexOf(".gif");
			temp_string2b = f1.indexOf(".GIF");
			temp_string3 = f1.indexOf(".png");
			temp_string3b = f1.indexOf(".PNG");
			temp_string3c = f1.indexOf(".pjpeg");
			temp_string4 = f1.indexOf(".x-tiff");
			temp_string5 = f1.indexOf(".x-windows-bmp");
			
			
				
	
		if (temp_string1 == -1 && temp_string1b == -1 && temp_string2 == -1 && temp_string2b == -1 && temp_string3 == -1 && temp_string3b == -1  && temp_string3c== -1 && temp_string4== -1 && temp_string5== -1)
		{
			Error += "\nYou can only upload PNG ,JPG or GIF format files. Please select valid file format ";		
		}
}
		if (Error!=""){
		alert(Error);
		return false;
	}
}