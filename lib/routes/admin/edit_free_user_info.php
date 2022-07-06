<?php 
    include_once("../../function/function.php");

    if(empty($_SESSION['loginSession'])){
        header("../../views/login.php");
    }

    include_once("../../layouts/header.php");
    include_once("../../layouts/nav_loged_video.php");

?>


<?php 
    if(isset($_POST['update'])){
        
    }
?>

<div class="update-page">
    <div class="update-content">
        <div class="title">
            Update Personal Information
        </div>
        <?php update_to_view_info(); ?>
    </div>
</div>
