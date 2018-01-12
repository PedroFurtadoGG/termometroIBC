<?php 
require_once('functions/functions.php');
	$resp1 = $_POST['radio1'];
	$resp2 = $_POST['radio2'];
	$resp3 = $_POST['radio3'];
	$resp4 = $_POST['radio4'];
	$resp5 = $_POST['radio5'];
	$resp6 = $_POST['radio6'];
	$resp7 = $_POST['radio7'];
	$resp8 = $_POST['radio8'];
	$resp9 = $_POST['radio9'];

	$area2 = $resp1 + $resp2 + $resp3 + $resp4 + $resp5 + $resp6 + $resp7 + $resp8 + $resp9;

    $sql = "UPDATE `users` SET area2 = '".$area2."' WHERE email = '".$_SESSION['emailUsu']."';";
       
    $upd = mysql_query($sql);
 	
    $sql2 = "UPDATE results SET area2='".$area2."' WHERE user_id='".$_SESSION['id']."';";
    $ins = mysql_query($sql2);
?>
<script>
	window.location.href='<?php echo $url; ?>/parabens-profissional.php';
</script>
