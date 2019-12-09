
function reg_visible() {
 var reg = document.getElementById("register");
 var log = document.getElementById("login");
 if (reg.style.display = 'none'){
	log.style.display = 'none';
	reg.style.display = 'block';
 }
}

function log_visible() {
 var reg = document.getElementById("register");
 var log = document.getElementById("login");
 if (reg.style.display = 'block'){
	log.style.display = 'block';
	reg.style.display = 'none';
 }
}