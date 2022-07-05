<?php 
  include_once("../function/function.php");
    //check the loginSession is not empty to enter to this page
  if(empty($_SESSION['loginSession'])){
      header('location:../views/login.php');
  }
?>

<link rel="stylesheet" href="../../css/style.css">
<?php include_once("../layouts/header.php"); ?>
<?php include_once("../layouts/nav_loged.php"); ?>


<?php 
    //pass video id to the fucntion file

    if(isset($_GET['id'])){
        $reult = get_video_id($_GET['id']);
        echo $reult;
    }

?>

<div class="video-full-view">
    <div class="content">
        <?php 
            //now echo video title and desctiption

            video_title_desc(); ?>

            <?php 
                //now echo video

                video_full_screen();
            
            ?>

    </div>
</div>
