<?php

$jconfig = new JConfig();
$db_error = "I am sorry! There is an error in db connection.";
$db_config = mysql_connect( $jconfig->host, $jconfig->user, $jconfig->password ) or die( $db_error );
mysql_select_db( $jconfig->db, $db_config ) or die( $db_error );

?>