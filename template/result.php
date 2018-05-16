<?php 
if(isset($_SESSION["result"])) 
{ 
    $result = $_SESSION["result"]; 
?>

<div class="alert <?php echo $result["isSuccess"] ? "alert-success" : "alert-danger"; ?> alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $result["message"]; ?>
</div>

<?php } ?>