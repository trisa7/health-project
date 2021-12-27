<?php
function db():PDO
{
    $ConnectingDB=null;
    $DSN='mysql:host=localhost;dbname=doctor_appointment';
    $ConnectingDB= new PDO($DSN,'root','');
    return $ConnectingDB;
}
?>