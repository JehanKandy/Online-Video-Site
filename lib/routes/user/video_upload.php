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
        <?php 
            if(isset($_POST['upload'])){
                $result = video_upoload($_POST['video_title'], $_POST['video_desc'], $_FILES['video'],$_POST['video_catagory'], $_POST['video_type']);
                echo $result;
            }
        
        ?>
        <div class="video-upload-content-body">
            <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <span class="label">Video Title : </span>
                <input type="text" name="video_title" id="video_title" placeholder="Video Title" class="video_input">

                <span class="label">Video Description : </span><br>
                <textarea name="video_desc" id="video_desc" class="video-text_area" placeholder="Video Description"></textarea>

                <span class="label">Video File : </span>
                <input type="file" name="video" id="video" accept="video/*">
                <br><br>

                <?php video_select_category(); ?>

                <br><br>
                <span class="label">Video Type : </span>
                <select name="video_type" id="video_type" class="video_input">
                    <option value="free">Free</option>
                    <option value="pro">Pro</option>                    
                </select>

                <br>
                <input type="submit" value="Upload Video" name="upload" class="video-btn">
            </form>
        </div>
    </div>
</div>
