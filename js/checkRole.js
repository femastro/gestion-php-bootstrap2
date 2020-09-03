var role = getRole();
function getRole(){
	const role = sessionStorage.getItem('role');
	return role;
}
if (role < 3) {
	window.alert("UD. No tiene autorización para acceder a este menú.");
	location.href='index.php';
}
