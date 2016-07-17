  /* Autorization User
  /	use Ajax - check user data
  */
  function sendLogin(event)
  {
	event.preventDefault();
  	var login = document.forms['login'].l_login;
  	var password = document.forms['login'].l_password;
  	var error = document.getElementById("l_err");
  		error.classList.remove("error");
  		error.innerHTML = "";
  		var log = testLogin(login.value);
  		var pass = testPassword(password.value);
		if (log === false || pass === false)
		{
			error.classList.add('error');
			error.innerHTML = err[lang]['error'][3];
		}
		else
		{
			var req = getXmlHttp();
			req.onreadystatechange = function()
			{
	        	if (req.readyState == 4)
	        	{
					if(req.status == 200)
					{
						var msg = JSON.parse(req.responseText);
						if(Object.keys(msg).indexOf('sucess') !== -1)
						{
							error.classList.add('success');
							error.innerHTML = err[lang]['sucess'][msg['sucess']];
							setTimeout(function(){ window.location.href = "/";}, 1000);
						}
						else
						{
							error.classList.add('error');
							error.innerHTML = err[lang]['error'][msg['error']];
						}
					}
					else
					{
						error.classList.add('error');
						error.innerHTML = err[lang]['error'][12];
					}
				}
			}
			var formData = new FormData(document.forms['login']);
			formData.append("action", "auth");
			req.open('POST', '/');
			req.send(formData);
		}
  }

  /* Registration new User
  /	use Ajax - send user data
  */
  function regUser(event)
   {
   	event.preventDefault();
  	var login = document.forms['register'].r_login;
  	var name = document.forms['register'].r_name;
  	var password = document.forms['register'].r_password;
  	var email = document.forms['register'].r_email;
  	var rpassword = document.forms['register'].re_password;
  	var file = document.forms['register'].r_file;
  	var error = document.getElementById("r_err");
  	var gender = '';
  	error.classList.remove("error");
	error.innerHTML = "";
	if(document.getElementsByName('r_gender')[0].checked)
	{
		gender = document.getElementById("men");
	}
	else
	{
		gender = document.getElementById("women");
	}
	if (testLogin(login.value) === false)
	{
		error.innerHTML += err[lang]['error'][10] + "<br />";
	}
	if (testLogin(name.value) === false)
	{
		error.innerHTML += err[lang]['error'][13] + "<br />";
	}
	if (testPassword(password.value) === false)
	{
		error.innerHTML += err[lang]['error'][11] + "<br />";
	}
	if (password.value !== rpassword.value)
	{
		error.innerHTML += err[lang]['error'][6] + "<br />";
	}
	if (testEmail(email.value) === false)
	{
		error.innerHTML += err[lang]['error'][4] + "<br />";
	}
	if(error.innerHTML === "")
	{
		var req = getXmlHttp();
		req.onreadystatechange = function()
		{
        	if (req.readyState == 4)
        	 {
				if(req.status == 200)
				{
					var msg = JSON.parse(req.responseText);
					
					if(Object.keys(msg).indexOf('sucess') !== -1)
					{
						error.classList.add('success');
						error.innerHTML = err[lang]['sucess'][msg['sucess']];
						setTimeout(function(){ window.location.href = "/";}, 2000);
					}
					else
					{
						error.classList.add('error');
						for(var i=0; i <= msg.length-1; i++)
						{
							error.innerHTML += err[lang]['error'][msg[i]] + "<br />";
						}
					}
				}
				else
				{
					error.classList.add('error');
					error.innerHTML = err[lang]['error'][12];
				}
			}
		}
	var formData = new FormData(document.forms['register']);
	formData.append("action", "register");
	req.open('POST', '/');
	req.send(formData);
	}
	else
	{
		error.classList.add('error');
	}
   }

  /* Update User Profile
  /	use Ajax - send user data
  */
  function updateProfile(event)
   {
   	event.preventDefault();
  	var name = document.forms['register'].u_name;
  	var email = document.forms['register'].u_email;
  	var file = document.forms['register'].u_file;
  	var error = document.getElementById("r_err");
  	var gender = '';
  	error.classList.remove("error");
  	error.innerHTML = "";
	if(document.getElementsByName('u_gender')[0].checked)
		{
			gender = document.getElementById("men");
		}
	else
		{
			gender = document.getElementById("women");
		}

	if (testLogin(name.value) === false)
		{
			error.innerHTML += err[lang]['error'][13] + "<br />";
		}
	if (testEmail(email.value) === false)
		{
			error.innerHTML += err[lang]['error'][4] + "<br />";
		}
	if(error.innerHTML === "")
	{
		var req = getXmlHttp();
		req.onreadystatechange = function()
		{
        	if (req.readyState == 4)
        	 {
				if(req.status == 200)
				{
					var msg = JSON.parse(req.responseText);

					if(Object.keys(msg).indexOf('sucess') !== -1)
					{
						error.classList.add('success');
						error.innerHTML = err[lang]['sucess'][msg['sucess']];
						setTimeout(function(){ window.location.href = "/";}, 1000);
					}
					else
					{
						error.classList.add('error');
						 for(var i=0; i <= msg.length-1; i++)
						{
							error.innerHTML += err[lang]['error'][msg[i]] + "<br />";
						}
					}
				}
				else
				{
					error.classList.add('error');
					error.innerHTML = err[lang]['error'][12];
				}
			}
		}
	var formData = new FormData(document.forms['register']);
	formData.append("action", "update");
	req.open('POST', '/');
	req.send(formData);
	}
	else
	{
		error.classList.add('error');
	}
   }


  /* Exit User
  /	use Ajax - send user data
  */
  function exitUser(event)
   {
   	event.preventDefault();
	var req = getXmlHttp();
	req.onreadystatechange = function()
		{
        	if (req.readyState == 4)
        	 {
				if(req.status == 200)
				{
					setTimeout(function(){ window.location.href = "/";}, 0);
				}
				else
				{
					error.classList.add('error');
					error.innerHTML = err[lang]['error'][12];
				}
			}
		}
	var formData = new FormData();
	formData.append("action", "exit");
	req.open('POST', '/');
	req.send(formData);
   }

   // toggle langauge site Ru || En
   function updateLangauge(event)
   {
	  document.cookie = "lang=" + (event.target.checked ? "Ru" : "En")+";expires=15/01/2030 00:00:00";
	  document.location.reload();
   }
   // Validate upload file: only  .jpeg || .jpg || .gif && Max-size: 100kb
   function validateFile(event)
   {
   	  var error = document.getElementById("r_err");
	  var file = document.getElementById("uploadInput");
	  error.classList.remove('error');
	  error.innerHTML = "";
	  if(file.files[0]){
		  var type = file.files[0].name.split('.')[1];
		  if(['jpg','jpeg','png','gif'].indexOf(type) === -1 || file.files[0].size > 100000)
		  {
		  	error.classList.add('error');
		  	error.innerHTML = err[lang]['error'][5] + "<br />";
		  	error.innerHTML += err[lang]['error'][8];
		  	file.value = "";
		  }
		}
	}
  	// Validate email./^(([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9\-]+)\.[a-zA-Z0-9.]+$)
  function testEmail(email)
  {
	if(/^(([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9\-]+)\.[a-zA-Z0-9.]+$)/.test(email) === false)
	    {
	    	return false;
	    }
	 return true;
  }


	// Validate login./^[a-zA-Z]{3,20}$/
  function testLogin(login)
  {
	if(/^[a-zA-Z]{3,20}$/.test(login) === false)
	    {
	    	return false;
	    }
	 return true;
  }
  // Validate pass./^[\w\s]{6,25}$/
  function testPassword(pass)
  {
	if(/^[\w\s]{6,25}$/.test(pass) === false)
	    {
	    	return false;
	    }
	 return true;
  }
// Return new XMLHttpRequest object
function getXmlHttp()
{
  var xmlhttp;
  try
  {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e)
  {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E)
    {
      xmlhttp = false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined')
  {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}
function getCookie(name)
{
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

document.addEventListener("DOMContentLoaded", ready);
function ready()
  {
  	document.getElementById("send_login") ?
    document.getElementById("send_login").addEventListener("click", sendLogin) : null;
    document.getElementById("reg_user") ?
    document.getElementById("reg_user").addEventListener("click", regUser) : null;
    document.getElementById("uploadInput") ?
	document.getElementById('uploadInput').addEventListener('change', validateFile) : null;
	document.getElementById("on-off") ?
	document.getElementById('on-off').addEventListener('change', updateLangauge) : null;
	document.getElementById("upd_user") ?
    document.getElementById("upd_user").addEventListener("click", updateProfile) : null;
    document.getElementById("exit_user") ?
    document.getElementById("exit_user").addEventListener("click", exitUser) : null;
  }


