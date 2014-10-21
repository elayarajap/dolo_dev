<?php 
 include_once("../../../configuration.php");

$jconfig = new JConfig();
$mysqli = new mysqli($jconfig->host, $jconfig->user, $jconfig->password, $jconfig->db);
$prefix = $jconfig->dbprefix;

if($_GET['status'] == '1') {
	$status = 0;
} else {
	$status = 1;
}
$id = $_GET['id'];
$linkchoice=$_GET['run']; 


if($linkchoice=='blockCampaign'){
	blockUnblockCampaign($mysqli,$prefix,$val, $id, $status);
} else if($linkchoice=='blockBrand') {
	blockUnblockBrand($mysqli,$prefix,$val, $id, $status);
}

function blockUnblockCampaign($mysqli,$prefix,$val,$id, $status){ 
    $mysqli->query("UPDATE ".$prefix."dolo_campaign SET state = $status where id = $id  ");
    //Closes MySQL connection.
	$mysqli->close();
    return true;
} 

function blockUnblockBrand($mysqli,$prefix,$val,$id, $status){ 
    $mysqli->query("UPDATE ".$prefix."dolo_brand SET state = $status where id = $id  ");
    //Closes MySQL connection.
	$mysqli->close();
    return true;
}
?> 