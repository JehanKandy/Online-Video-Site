<?php 
    include_once("../../function/function.php");

    if(empty($_SESSION['loginSession'])){
        header("../../views/login.php");
    }

    include_once("../../layouts/header.php");
    include_once("../../layouts/nav_loged_video.php");

?>

<div class="video-upload">
    <div class="video-upload-content">
        <div class="video-upload-content-title">
            <i class="fas fa-upload"></i>&nbsp;&nbsp;Upload a Video
            <hr>
        </div>
        <div class="video-upload-content-body">
            
        </div>
    </div>
</div>
