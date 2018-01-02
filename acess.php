<?php 
require_once('functions.php');
	$nome = $_POST['nome'];
	$strqry =  mysql_fetch_array(mysql_query("SELECT * FROM users WHERE name = '".$nome."'"));
	$email = $_POST['email'];
	$strqry2 = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE email = '".$email."'"));	
	
	if($strqry && $strqry2){
		
		$usu = $strqry;
		
		$_SESSION['logado'] = 1;
		$_SESSION['email'] = $email;
		$_SESSION['user'] = $nome;
		$sessao = $_SESSION['email'];
		//redirect 
		?>
		<script>
			alert('Login efetuado com sucesso!');
			window.location='<?php echo $url; ?>/index.php/<?php echo $sessao;?>';
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