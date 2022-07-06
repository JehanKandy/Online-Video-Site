<?php 
    include_once("../../function/function.php");

    if(empty($_SESSION['loginSession'])){
        header("../../views/login.php");
    }

    include_once("../../layouts/header.php");
    include_once("../../layouts/nav_loged_video.php");

?>

<div class="update-page">
    <div class="update-content">
        <div class="title">
            Update
        </div>
        <div class="body">
            Body
        </div>
    </div>
</div>
