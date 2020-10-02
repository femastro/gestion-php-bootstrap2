<?php 
	session_start();

	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$local = $_POST['local'];
	
	require "../conexion.php";

	$sql = "SELECT idusuarios, usuario, privilegios AS role FROM usuarios WHERE usuario='".$username."' AND password='".$password."'";

	$resp = mysqli_query($link,$sql) or die(mysqli_error($link));

	$cont = mysqli_num_rows($resp);

	$user = mysqli_fetch_assoc($resp);

	if ($cont == 1) {
		$_SESSION['login'] = 1;
		$_SESSION['local'] = $local;
		$_SESSION['iduser'] = $user['idusuarios'];
?>
	<script>
		function addItem(user,role,local){
			sessionStorage.setItem("user",user);
			sessionStorage.setItem('role',role);
			sessionStorage.setItem('local',local);
		}

		addItem('<?php echo $user['usuario'] ?>','<?php echo $user['role'] ?>','<?php echo $local ?>');

		location.href="../index.php"		
	</script>
<?php
	}else{
?>
	<script>
		location.href="../index.php?error=1";
	</script>
<?php
	}
	mysqli_close($link);
?>