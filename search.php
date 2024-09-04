<?php

// include('header.php');
require_once 'func.php';
include('conn.php');
error_reporting(0);

$function = new func($conn);

// $function->checksession();
session_start();
$name = $_SESSION['uname'];
$id = $_SESSION['id'];

include('conn.php');
if (isset($_POST['query'])) {
    $query = $_POST['query'];

    if(isset($_SESSION['id'])){
    session_start();
    $id = $_SESSION['id'];
    $function->search($query, $id);
    }
    
    else{
        $function->searchforall($query);
    }

}
