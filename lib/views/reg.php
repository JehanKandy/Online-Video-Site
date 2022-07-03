<?php include_once("../layouts/header.php"); ?>
<?php include_once("../layouts/nav_reg.php"); ?>
<?php include_once("../function/function.php"); ?>

<div class="reg">
    <div class="reg-content">
        <div class="reg-content-title">
            <i class="fas fa-user-plus"></i> &nbsp;&nbsp; Register
            <hr>        
        </div>
        <?php 
            if(isset($_POST['Register'])){
                $result = reg_user($_POST['username'], $_POST['email'], md5($_POST['password']), md5($_POST['cpassword']));
                return $result;
            }        
        ?>
        <div class="reg-content-body">
            <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                <span class="label">Username : </span>
                <input type="text" name="username" id="username" placeholder="Username" class="login-input" required>

                <span class="label">Email Address : </span>
                <input type="email" name="email" id="email" placeholder="Email" class="login-input" required>

                <span class="label">Password : </span>
                <input type="password" name="password" id="password" placeholder="Password" class="login-input" required>

                <span class="label">Confirm Password : </span>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" class="login-input" required>

                <input type="submit" value="Register" name="Register" class="login-btn">&nbsp;&nbsp;&nbsp;<input type="reset" value="Clear" class="clr-btn">
            </form>
        </div>
    </div>
</div>
