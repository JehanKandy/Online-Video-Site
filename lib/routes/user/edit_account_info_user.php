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
        $result = edit_user_account($_POST['update_id'], $_POST['update_username']);
        echo $result;
    }
?>

<div class="update-page">
    <div class="update-content">
        <div class="title">
            Update Account Information
        </div>
        <?php update_user_account(); ?>
    </div>
</div>