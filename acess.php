<?php 
require_once('functions/functions.php');

	
	$nome = $_POST['nome'];
	
	$strqry =  mysql_query("SELECT * FROM users WHERE name = '".$nome."'");
	
	$email = $_POST['email'];
	
	$strqry2 = mysql_query("SELECT * FROM users WHERE email = '".$email."'");	
	
	if(mysql_num_rows($strqry) >= 1 && mysql_num_rows($strqry2) >= 1){
		
		$usu = mysql_fetch_array($strqry);
		
		$_SESSION['logado'] = 1;
		$_SESSION['emailUsu'] = $usu['email'];
		$_SESSION['nomeUsu'] = $usu['name'];
		//redirect 
		?>
		<script>
		alert('Login efetuado com sucesso!');
		window.location='<?php echo $url; ?>';
		</script>
	<?php
	}else{
		
	?>

	
		<script>
				alert('Email ou senha incorretos.Por favor tente novamente!');
				window.location.href='<?php echo $url; ?>';
		</script>
		<?php
		
	}
	
	
	



?>