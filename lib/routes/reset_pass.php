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
    Reset Password
  </div>
  <?php 
    if(isset($_POST['reset'])){
      $result = new_pass($_POST['otp_email'], $_POST['otp_password'], $_POST['otp_cpassword']);
      echo $result;
    }  
  ?>
  <div class="pass-body">
    <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
      <table border="0">
        <tr>
          <td><span class="label">Enter Email : </span></td>
          <td><input type="email" name="otp_email" id="otp_email" placeholder="Email" class="pass-input" required></td>
        </tr>
        <tr>
          <td><span class="label">New Password : </span></td>
          <td><input type="password" name="otp_password" id="otp_password" placeholder="New Password" class="pass-input" required></td>
        </tr>
        <tr>
          <td><span class="label">Confirm New Password : </span></td>
          <td><input type="password" name="otp_cpassword" id="otp_password" placeholder="Confirm New Password" class="pass-input" required></td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" value="Reset Passowrd" name="reset" class="btn btn-primary"></td>
        </tr>
      </table>
    </form>

  </div>
</div>
