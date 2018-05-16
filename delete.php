<h3>Redirecting...</h3>

<?php

session_start();

require "services/account_service.php";

$accountService = new AccountService();
$accountService->Logout();

?>
