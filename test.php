<?php
//  echo "Start Process...";
//  // Connect to hosts
//  $dsn = "cassandra:host=127.0.0.1;port=9160";
//  $db = new PDO($dsn);
//  $db->exec("USE demospace");
 
//  echo "After connection";
//  $stmt = $db->prepare("UPDATE users SET fname = :fname WHERE user_id = :user_id;");
//  $stmt->bindValue(':user_id', '1745');
//  $stmt->bindValue(':fname', 'cassandraname');
//  $stmt->execute();
 
//  echo "After Update";
//  $stmt = $db->prepare("SELECT user_id, fname, lname FROM users;");
//  // $stmt->bindValue(':user_id', 1745);
//  $stmt->execute();
//  echo "After select";

// var_dump($stmt->fetchAll());
// echo "End!!!!";

error_reporting(E_ALL);


 echo "Start Process...";
 //echo die("conection end");
 // Connect to hosts
 $dsn = "cassandra:host=54.89.101.237;port=9160";

 $db = new PDO($dsn);
 
  die("host pdo");
 $db->exec("USE tile_store");
 echo "After connection==>";


 

 $stmt = $db->prepare("SELECT * FROM  analyticsbuckets;");
 $stmt->execute();
 echo "After select";

 var_dump($stmt->fetchAll());
 echo "End!!!!";
?>
