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

	$area4 = $resp1 + $resp2 + $resp3 + $resp4 + $resp5 + $resp6 + $resp7 + $resp8 + $resp9;

    $sql = "UPDATE `users` SET area4 = '".$area4."' WHERE email = '".$_SESSION['emailUsu']."';";
     
    $upd = mysql_query($sql);
 	
    $sql2 = "UPDATE results SET area4='".$area4."' WHERE user_id='".$_SESSION['id']."';";

    $ins = mysql_query($sql2);

    $sql3 = "SELECT * FROM results WHERE user_id = '".$_SESSION['id']."';";
    $rs = mysql_fetch_array(mysql_query($sql3));
    $SUM = $rs['area1'] + $rs['area2'] + $rs['area3'] + $rs['area4'];

    $sql4 = "UPDATE `users` SET result = '".$SUM."' WHERE email = '".$_SESSION['emailUsu']."';";
    $resultU = mysql_query($sql4);
    
    $sql5 = "UPDATE results SET result='".$SUM."' WHERE user_id='".$_SESSION['id']."';";
    $resultR = mysql_query($sql5);
?>
<script>
	window.location.href='<?php echo $url; ?>/parabens-qualidade.php';
</script>
