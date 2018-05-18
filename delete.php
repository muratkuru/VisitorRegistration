<h3>Redirecting...</h3>

<?php

session_start();

if(!isset($_SESSION["user"]))
{
    header("Location: login.php");
    die();
}

require "services/visitor_service.php";

$visitorService = new VisitorService();

if(isset($_GET["id"]))
    $visitorService->DeleteVisitor($_GET["id"]);

header("Location: index.php");
die();

?>
