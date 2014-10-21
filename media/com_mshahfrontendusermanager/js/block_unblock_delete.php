<?php 
 include_once("../../../configuration.php");

$jconfig = new JConfig();

$mysqli = new mysqli($jconfig->host, $jconfig->user, $jconfig->password, $jconfig->db);

 $prefix = $jconfig->dbprefix;

// User 

function deleteUser($mysqli,$prefix,$val){
	$mysqli->query("DELETE FROM ".$prefix."users WHERE id = $val  ");
	$mysqli->query("DELETE FROM ".$prefix."user_usergroup_map` WHERE user_id = $val  ");
	//Closes MySQL connection.
	$mysqli->close();
	return true;
}

function blockUser($mysqli,$prefix,$val){ 
    $mysqli->query("UPDATE ".$prefix."users SET block = 1 where id = $val  ");
    //Closes MySQL connection.
	$mysqli->close();
    return true;
} //

function unblockUser($mysqli,$prefix,$val){ 
	$mysqli->query("UPDATE ".$prefix."users SET block = 0 where id = $val  ");
	//Closes MySQL connection.
	$mysqli->close();
    return true;
}

///// START ///// 

?> 
<html><body> 

<?php 

 $val = $_GET['checkbox'];
 $linkchoice=$_GET['run']; 


if($linkchoice=='deleteUser'){
	deleteUser($mysqli,$prefix,$val);
}
if($linkchoice=='blockUser'){
	blockUser($mysqli,$prefix,$val);
}
if($linkchoice=='unblockUser'){
	unblockUser($mysqli,$prefix,$val);
}

?> 
