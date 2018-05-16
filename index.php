<?php

session_start();

if(!isset($_SESSION["user"]))
{
    header("Location: login.php");
    die();
}

require "services/visitor_service.php";

$visitorService = new VisitorService();

$users = $visitorService->GetAllVisitors();

?>

<?php include("template/header.php") ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">Ziyaretçi Listesi</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="addoredit.php" class="btn btn-primary form-control add-button">
                                    <span class="glyphicon glyphicon-plus"></span> Yeni Ziyaretçi Ekle
                                </a>
                            </div>
                        </div>
                        <div class="row filters">
                            <div class="col-md-5">
                                <input type="text" name="filter-input" placeholder="Ad, Soyad ya da T.C. Kimlik ile arayın." class="form-control">
                            </div>
                            <div class="col-md-5">
                                <input type="date" name="filter-date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success form-control">
                                    <span class="glyphicon glyphicon-ok"></span> Uygula
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="col-md-3">T.C. NO</th>
                                    <th>Ad</th>
                                    <th>Soyad</th>
                                    <th>Tarih</th>
                                    <th class="col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $item) { ?>
                                <tr>
                                    <td><?php echo $item["Id"] ?></td>
                                    <td><?php echo $item["TC"] ?></td>
                                    <td><?php echo $item["Name"] ?></td>
                                    <td><?php echo $item["Surname"] ?></td>
                                    <td><?php echo $item["VisitDate"] ?></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-info">
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                        </a>
                                        <a href="#" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        <a href="#" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

<?php include("template/footer.php") ?>