<?php

session_start();

require "services/account_service.php";

$accountService = new AccountService();

if(isset($_POST["control"]))
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    $accountService->Login($username, $password);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ziyaretçi Takip Sistemi</title>

    <!-- Bootstrap -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3>Kullanıcı Girişi</h3>
                <form action="login.php" method="post" class="custom-form">
                    <input class="form-control" type="text" name="username" placeholder="Kullanıcı Adı" required>
                    <input class="form-control" type="password" name="password" placeholder="Şifre" required>
                    <button class="btn btn-success" name="control">
                        <span class="glyphicon glyphicon-log-in"></span> Giriş
                    </button>
                </form><br>
                <?php if(isset($_SESSION["error"])) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $_SESSION["error"]; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="public/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="public/js/bootstrap.min.js"></script>
</body>

</html>

<?php unset($_SESSION["error"]); ?>
