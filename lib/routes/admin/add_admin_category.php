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
            Add Category
        </div>
        <div class="body">
            <?php 
                if(isset($_POST['add'])){
                    $result = add_catogery($_POST['category_name'], $_POST['category_desc']);
                    echo $result;
                }            
            ?>
            <form action="<?php echo($SERVER['PHP_SELF']); ?>" method="POST">
                <table border="0">
                    <tr>
                        <td><span class="label">Category Name : </span></td>
                        <td><input type="text" name="category_name" id="category_name" class="login-input"></td>
                    </tr>
                    <tr>
                        <td><span class="label">Category Description : </span></td>
                        <td><textarea name="category_desc" id="category_desc" class="text-area"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="ADD Category" name="add" class="btn btn-success"></td>
                    </tr>
                </table>
        
            </form>
        </div>
    </div>
</div>
