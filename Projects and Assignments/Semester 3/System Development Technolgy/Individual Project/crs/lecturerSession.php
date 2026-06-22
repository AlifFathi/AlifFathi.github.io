<?php

if(!session_id()){

    session_start();
}

if(!isset($_SESSION['lecturer_sid'])) {

    header("location:index.php");
}

?>