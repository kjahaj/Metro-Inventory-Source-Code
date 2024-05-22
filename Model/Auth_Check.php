<?php
include_once "../../Model/AuthMiddleware.php";
include_once "../../Model/user.php";
include_once '../../Model/session.php';

$authMiddleware = new AuthMiddleware();

//In here we get the current users group since we will need it to compare it
$userGroup = unserialize($_SESSION["user"])->getGroup();

//Get the current path
$requestedPath = basename($_SERVER['PHP_SELF']);

//Use the middleware to check if the user has access to the requested path
if (!$authMiddleware->handle($userGroup, $requestedPath)) {
//If user doesnt have access they get redirected to the Handle method
    exit();
}