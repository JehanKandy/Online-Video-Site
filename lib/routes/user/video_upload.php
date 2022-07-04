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
            <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                <span class="label">Video Title : </span>
                <input type="text" name="video_title" id="video_title" placeholder="Video Title" class="video_input">
            </form>
        </div>
    </div>
</div>
