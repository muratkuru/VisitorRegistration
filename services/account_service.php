<?php

require 'data/db_config.php';

class AccountService
{
    private $dbConfig = null;

    public function __construct()
    {
        $this->dbConfig = new DbConfig();
    }

    function Login($username, $password)
    {
        $user = $this->dbConfig->GetSingle(
            "select * from users where Username = '$username' and Password = '$password'"
        );
        if($user)
        {
            $_SESSION["user"] = $user["Username"];
            header("Location: index.php");
            die();
        }
        else
        {
            $_SESSION["error"] = "Kullanıcı adı veya şifre hatalı.";
        }
    }

    function Logout()
    {
        session_destroy();
        header("Location: login.php");
        die();
    }

    function ChangePassword($username, $password, $newPassword, $confirmPassword)
    {
        if($newPassword == $confirmPassword)
        {
            $user = $this->dbConfig->GetSingle(
                "select * from users where Username = '$username' and password = '$password'"
            );
            if($user)
            {
                $updatedUser = $this->dbConfig->ExecuteQuery(
                    "update users set Password = '$newPassword'"
                );
                if($updatedUser)
                    $_SESSION["result"] = array("isSuccess" => true, "message" => "Parola değişikliği başarılı!");
                else
                    $_SESSION["result"] = array("isSuccess" => false, "message" => "Veritabanı hatası!");
            }
            else
                $_SESSION["result"] = array("isSuccess" => false, "message" => "Eski parola hatalı!");
        }
        else
            $_SESSION["result"] = array("isSuccess" => false, "message" => "Parolalar eşleşmedi!");
    }
}

?>