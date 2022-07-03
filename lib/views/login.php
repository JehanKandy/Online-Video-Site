<?php include_once("../layouts/header.php"); ?>
<?php include_once("../layouts/nav_login.php"); ?>

<div class="login">
    <div class="login-content">
        <div class="login-content-title">
            <i class="fas fa-user-alt"></i> &nbsp; Login
            <hr>
        </div>
        <div class="login-content-body">
            <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                <span class="label">Username : </span>
                <input type="text" name="username" id="username" placeholder="Username" class="login-input">

                <span class="label">Password : </span>
                <input type="password" name="password" id="password" placeholder="Password" class="login-input">

                <input type="submit" value="Login" name="login" class="login-btn">
            </form>
        </div>
    </div>
</div>
