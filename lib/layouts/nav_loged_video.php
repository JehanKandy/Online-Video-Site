<?php 
  include_once("../../function/function.php");
    //check the loginSession is not empty to enter to this page
  if(empty($_SESSION['loginSession'])){
      header('location:../views/login.php');
  }
?>

<link rel="stylesheet" href="../../../css/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="../index_loged.php">&nbsp;&nbsp;ABC Videos</a>
    <span class="navbar-text">
        <a href="../routes/user/video_upload.php"><i class="fas fa-upload">&nbsp;&nbsp;</i>Upload</a> &nbsp;&nbsp;&nbsp;   
        <a href="#"><i class="fas fa-user-alt">&nbsp;&nbsp;</i><?php check_user_id(); ?></a> &nbsp;&nbsp;&nbsp;   
        <a href="../views/logout.php"><button class="logout-btn-nav">Logout</button></a>&nbsp;&nbsp;&nbsp;&nbsp;
    </span>
</nav>