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
        $result = update_free_video($_POST['id'], $_POST['video_status']);
        echo $result;
    }
?>

<div class="update-page">
    <div class="update-content">
        <div class="title">
            Update Free Video Information
        </div>
        <?php pro_video_update_view(); ?>
    </div>
</div>
