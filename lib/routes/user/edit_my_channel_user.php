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
        $result = update_channel_info_user($_POST['channel_id'], $_POST['channel_name']);
        echo $result;
    }
?>

<div class="update-page">
    <div class="update-content">
        <div class="title">
            Update Account Information
        </div>
        <?php user_channel_infor_edit(); ?>
    </div>
</div>