<?php 
  include_once("../function/function.php");
    //check the loginSession is not empty to enter to this page
  if(empty($_SESSION['loginSession'])){
      header('location:../views/login.php');
  }

  include_once("../layouts/header.php");
?>


<?php include_once("../layouts/header.php"); ?>


<a href="../views/logout.php">Logout</a>
