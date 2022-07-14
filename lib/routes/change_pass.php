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
    <hr>
  </div>
  <?php 
    if(isset($_POST[''])){
      $result = pwd_reset($_POST['pass_email']);
      echo $result;
    }  
  ?>
  <div class="pass-body">
    <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
      <span>Enter Your  Email : </span>
      <input type="email" name="pass_email" id="pass_email" class="pass-input" placeholder="Email" required><br>
      <input type="submit" value="Verify Email" name="verify" class="btn btn-primary">
    </form>
  </div>
</div>
