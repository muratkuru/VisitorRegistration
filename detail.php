<?php 

session_start();

if(!isset($_SESSION["user"]))
{
    header("Location: login.php");
    die();
}

require "services/visitor_service.php";

$visitorService = new VisitorService();

$visitor = array();

if(isset($_GET["id"]))
{
    $visitor = $visitorService->GetVisitorById($_GET["id"]);
    if(!$visitor)
    {
        header("Location: index.php");
        die();
    }
}
else
{
    header("Location: index.php");
    die();
}

?>

<?php include("template/header.php") ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Ziyaretçi Detay</div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>T.C. Numarası: </dt>
                        <dd><?php echo $visitor["TC"] ?></dd>
                        <dt>Adı: </dt>
                        <dd><?php echo $visitor["Name"] ?></dd>
                        <dt>Soyadı: </dt>
                        <dd><?php echo $visitor["Surname"] ?></dd>
                        <dt>Telefon: </dt>
                        <dd><?php echo $visitor["Phone"] ?></dd>
                        <dt>Ziyaret Sebebi: </dt>
                        <dd><?php echo $visitor["VisitReason"] ?></dd>
                        <dt>Ziyaret Tarihi: </dt>
                        <dd><?php echo $visitor["VisitDate"] ?></dd>
                    </dl>
                </div>
                <div class="panel-footer">
                    <a href="index.php" class="btn btn-info">
                        <span class="glyphicon glyphicon-th-list"></span> Ziyaretçi Listesi
                    </a>
                    <a onclick="return confirm('Ziyaretçi silinsin mi?')" href="delete.php?id=<?php echo $visitor["Id"]; ?>" class="btn btn-danger">
                        <span class="glyphicon glyphicon-trash"></span> Ziyaretçi Sil
                    </a>
                    <a href="addoredit.php?id=<?php echo $visitor["Id"]; ?>" class="btn btn-warning">
                        <span class="glyphicon glyphicon-pencil"></span> Ziyaretçi Düzenle
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("template/footer.php") ?>