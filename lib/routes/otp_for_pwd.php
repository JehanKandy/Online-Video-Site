<?php 
  include_once("../function/function.php");
    //check the loginSession is not empty to enter to this page
  if(empty($_SESSION['loginSession'])){
      header('location:../views/login.php');
  }
?>

<link rel="stylesheet" href="../../css/style.css">
<?php include_once("../layouts/header.php"); ?>

<div class="pass-content">
  <div class="pass-title">
    Password Reset OTP
  </div>
  <?php 
    if(isset($_POST['otp'])){
      $result = check_otp($_POST['otp_num']);
      echo $result;
    }  
  ?>
  <div class="pass-body">
    <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
      <span class="label">Enter OTP : </span>
      <input type="number" name="otp_num" id="otp" placeholder="OTP" class="pass-input" required>
      <br>
      <input type="submit" value="Verify OTP" name="otp" class="btn btn-primary">
    </form>
  </div>
</div>
