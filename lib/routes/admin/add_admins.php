<?php 
    include_once("../../function/function.php");

    if(empty($_SESSION['loginSession'])){
        header("../../views/login.php");
    }

    include_once("../../layouts/header.php");
    include_once("../../layouts/nav_loged_video.php");

?>

<div class="update-page">
    <div class="update-content">
        <div class="title">
            Add Admin
        </div>
        <div class="body">
            <?php 
                if(isset($_POST['add_admin'])){
                    $result = add_admin($_POST['admin_username'], $_POST['admin_email']);
                    echo $result;
                }            
            ?>
            <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
                <table border="0">
                    <tr>
                        <td><span class="label">Admin Username : </span></td>
                        <td><input type="text" name="admin_username" id="admin_username" class="login-input"></td>
                    </tr>
                    <tr>
                        <td><span class="label">Admin Email : </span></td>
                        <td><input type="email" name="admin_email" id="admin_email" class="login-input"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="ADD Admin" name="add_admin" class="btn btn-success"></td>
                    </tr>
                </table>
        
            </form>
        </div>
    </div>
</div>