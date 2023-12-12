<?php
$currentURL = $_SERVER['REQUEST_URI'];

$pathSegments = explode('/', $currentURL);
$lastSegment = end($pathSegments);

$lastSegmentWithoutExtension = pathinfo($lastSegment, PATHINFO_FILENAME);

if (empty($lastSegmentWithoutExtension) || $lastSegmentWithoutExtension === 'index') {
    $pageTitle = 'Dashboard';
} else {
    $pageTitle = ucfirst($lastSegmentWithoutExtension); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--materials icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!--Style css-->
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
    <link rel="icon" type="image/jpg" href="images/logo.jpg"/>
</head>
<body>
<div class="container">
    <?php require_once('aside.php')?>
    <div class="wrapper-box">
        <div class="wrapper">
            <div class="top">
                <div class="left">
                <h1><?= $pageTitle ?></h1>
                </div>
                <div class="profile">
                    <div class="info">
                        <div class="txt">
                            <p>Hey, <b><?= $_SESSION['username'] ?></b></p>
                            <small class="text-muted">Admin</small>
                        </div>
                        <img src="images/profile-3.jpg">
                    </div>
                </div>
            </div>  