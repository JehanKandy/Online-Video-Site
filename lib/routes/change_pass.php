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

<div class="pass-content">
  <div class="pass-title">
    Reset Password
  </div>
</div>
