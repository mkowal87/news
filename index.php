
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News Test</title>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>


<?php


session_start();
// Checks if user is logged in, so correct page could be displayed.
if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
    // Page for all manipulation of newses
    include("news_admin.php");
}else{
    // Main page for not logged in user, where all active newses are displayed, and register or login is possible
    include('register.php');
}

include('footer.php');