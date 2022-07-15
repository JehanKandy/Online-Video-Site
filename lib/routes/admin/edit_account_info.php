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
        $result = edit_admin_account($_POST['update_channel_id'], $_POST['update_channel_name']);
        echo $result;
    }
?>

<div class="update-page">
    <div class="update-content">
        <div class="title">
            Update My Channel Information
        </div>
        <?php update_admin_account(); ?>
    
</div>
