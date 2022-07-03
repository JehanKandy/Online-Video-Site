<?php include_once("../layouts/header.php"); ?>
<?php include_once("../layouts/nav_reg.php"); ?>

<div class="reg">
    <div class="reg-content">
        <div class="reg-content-title">
            <i class="fas fa-user-plus"></i> &nbsp;&nbsp; Register
            <hr>        
        </div>
        <?php ?>
        <div class="reg-content-body">
            <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                <p>Username : </p>
                <input type="text" name="username" id="username" placeholder="Username" class="login-input" required><br><br>

                <p>Email Address : </p>
                <input type="email" name="email" id="email" placeholder="Email" class="login-input" required><br><br>

                <p>Password : </p>
                <input type="password" name="password" id="password" placeholder="Password" class="login-input" required><br><br>

                <p>Confirm Password : </p>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" class="login-input" required><br><br>

                <input type="submit" value="Register" name="Register" class="login-btn">&nbsp;&nbsp;&nbsp;<input type="reset" value="Clear" class="clr-btn">
            </form>
        </div>
    </div>
</div>