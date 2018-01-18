<?php 
require_once('functions/functions.php');

	$nome 		   = $_POST['nome'];
	$email 		   = $_POST['email'];
	$cidade 	   = $_POST['cidade'];
	$dt_nascimento = $_POST['dt_nascimento'];
	$escolaridade  = $_POST['escolaridade'];
	$sexo 		   = $_POST['sexo'];
	$date 		   = date('Y-m-d H:i:s');
	$uid 		   = time();

	$queryEmail = "SELECT * FROM users WHERE email = '".$email."'";
	$queryEmailExe = mysql_query($queryEmail);
	if(mysql_num_rows($queryEmailExe) < 1 ){
		$sql = "INSERT INTO users (uid, uname, name, email, birthday, gender, location, created_at, area1, area2, area3, area4, answers, result, shared) 
							VALUES ('".$uid."','".$nome."', '".$nome."', '".$email."','".$dt_nascimento."', '".$sexo."', '".$cidade."', '".$date."', '0', '0', '0', '0', '0', '0', '0')";
		$ins = mysql_query($sql);
		if($ins){
			$_SESSION['logado']   = 1;
			$_SESSION['emailUsu'] = $_POST['email'];
			$_SESSION['nomeUsu']  = $_POST['nome'];
			$sql = "SELECT id FROM users WHERE email = '".$_POST['email']."'";
			$resultado = mysql_query($sql);
			$linha = mysql_fetch_assoc($resultado);
			$x = $linha['id'];
			$_SESSION['id'] = $x;

	}
?>
		<script>
		alert('Login efetuado com sucesso!');
		window.location='<?php echo $url; ?>/ambiente-pessoal.php';
		</script>
		<?php
	}else{

		$_SESSION['logado']   = 1;
		$_SESSION['emailUsu'] = $_POST['email'];
		$_SESSION['nomeUsu']  = $_POST['nome'];
		$sql = "SELECT id FROM users WHERE email = '".$_POST['email']."'";
		$resultado = mysql_query($sql);
		$linha = mysql_fetch_assoc($resultado);
		$x = $linha['id'];
		$_SESSION['id'] = $x;

	?>
		<script>
				alert('Email já constado na base de dados!Login efetuado automaticamente.');
				window.location.href='<?php echo $url; ?>/ambiente-pessoal.php';
		</script>
	?>
	<?php } ?>