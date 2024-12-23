<?php 
$HOST = 'localhost';
$DBNAME = 'dbsituation';
$USERNAME = 'amineremote';
$PASSWORD = 'amine';
$PORT = 3305;


$con = new mysqli($HOST , $USERNAME , $PASSWORD  ,$DBNAME ,$PORT );
// echo 'test' ;
if ($con->connect_error) {
    echo "Connection failed: " . $con->connect_error;
}
return $con;
?>