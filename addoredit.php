<?php

session_start();

if(!isset($_SESSION["user"]))
{
    header("Location: login.php");
    die();
}

require "services/visitor_service.php";

$visitorService = new VisitorService();

$isEdit = isset($_GET["id"]) || isset($_POST["id"]);
$visitor = array("TC" => "", "Name" => "", "Surname" => "", "Phone" => "", "VisitReason" => "");

if($isEdit)
{
    $id = isset($_GET["id"]) ? $_GET["id"] : $_POST["id"];
    $visitor = $visitorService->GetVisitorById($id);
    
    if(!$visitor)
    {
        header("Location: index.php");
        die();
    }
}

if(isset($_POST["control"]))
{
    $visitor = array();
    
    if($isEdit)
        $visitor["Id"] = $_POST["id"];
    
    $visitor["TC"] = $_POST["tc"];
    $visitor["Name"] = $_POST["name"];
    $visitor["Surname"] = $_POST["surname"];
    $visitor["Phone"] = $_POST["phone"];
    $visitor["VisitReason"] = $_POST["visit-reason"];

    $visitorService->AddOrEdit($visitor);
}

?>
<?php include("template/header.php") ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <?php echo $isEdit ? "Ziyaretçi Düzenle" : "Yeni Ziyaretçi Ekle"; ?>
                </div>
                <div class="panel-body">
                    <form action="addoredit.php" method="post" class="custom-form">
                        <input type="hidden" name="id" value="<?php if($isEdit) echo $visitor["Id"]; ?>">
                        <input class="form-control" type="text" name="tc" value="<?php echo $visitor["TC"]; ?>" placeholder="T.C. Kimlik" required>
                        <input class="form-control" type="text" name="name" value="<?php echo $visitor["Name"]; ?>" placeholder="Ad" required>
                        <input class="form-control" type="text" name="surname" value="<?php echo $visitor["Surname"]; ?>" placeholder="Soyad" required>
                        <input class="form-control" type="text" name="phone" value="<?php echo $visitor["Phone"]; ?>" placeholder="Phone" required>
                        <input class="form-control" type="text" name="visit-reason" value="<?php echo $visitor["VisitReason"]; ?>" placeholder="Ziyaret Sebebi" required>
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

<?php 
    include("template/footer.php");
    unset($_SESSION["result"]);
?>