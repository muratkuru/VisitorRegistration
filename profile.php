<?php

session_start();

if(!isset($_SESSION["user"]))
{
    header("Location: login.php");
    die();
}

require "services/account_service.php";

$accountService = new AccountService();

if(isset($_POST["control"]))
{
    $oldPassword = $_POST["old-password"];
    $newPassword = $_POST["new-password"];
    $confirmPassword = $_POST["confirm-password"];

    $accountService->ChangePassword($oldPassword, $newPassword, $confirmPassword);
}

?>

<?php include("template/header.php") ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Parola Değişikliği</div>
                <div class="panel-body">
                    <form action="profile.php" method="post" class="custom-form">
                        <input class="form-control" type="password" name="old-password" placeholder="Eski parola" required>
                        <input class="form-control" type="password" name="new-password" id="newPassword" placeholder="Yeni parola" required>
                        <input class="form-control" type="password" name="confirm-password" id="confirmPassword" placeholder="Yeni parola(Tekrar)" required>
                        <button class="btn btn-success" name="control">
                            <span class="glyphicon glyphicon-floppy-disk"></span> Kaydet
                        </button>
                    </form><br>
                <?php include("template/result.php"); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var newPassword = document.getElementById("newPassword");
    var confirmPassword = document.getElementById("confirmPassword");

    function validatePassword() {
        if(newPassword.value != confirmPassword.value)
            confirmPassword.setCustomValidity("Parola eşleşmedi!");
        else
            confirmPassword.setCustomValidity("");
    }

    newPassword.onchange = validatePassword;
    confirmPassword.onkeyup = validatePassword;

</script>

<?php 
    include("template/footer.php");
    unset($_SESSION["result"]);
?>