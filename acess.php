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
		//redirect 
		?>
		<script>
		alert('Login efetuado com sucesso!');
		window.location='<?php echo $url; ?>/ambiente-pessoal.php';
		</script>
	<?php
	}else{
		
	?>
		<script>
				alert('Ocorreram erros.Por favor tente novamente!');
				window.location.href='<?php echo $url; ?>';
		</script>
		<?php
	}
	
?>