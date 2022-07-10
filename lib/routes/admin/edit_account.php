<?php 
    include_once("../../function/function.php");

    if(empty($_SESSION['loginSession'])){
        header("../../views/login.php");
    }

    include_once("../../layouts/header.php");
    include_once("../../layouts/nav_loged_admin_f.php");

?>
<link rel="stylesheet" href="../../css/style.css">

<div class="admin-content">
    <section class="sidebar">
        <ul class="nav-bar">
            <li><a href="../index_loged.php"><i class='far fa-file-video' style='font-size:20px'></i>&nbsp;&nbsp;View All Videos</a></li>
            <li><a href="../admin.php"><i class='fas fa-tachometer-alt' style='font-size:20px'></i>&nbsp;&nbsp;Dashboard</a></li>
            <li><a href="all_free_users.php"><i class='fas fa-users' style='font-size:20px'></i>&nbsp;&nbsp;Users</a></li>
            <li><a href="all_pro_users.php"><i class='fas fa-user-tie' style='font-size:20px'></i>&nbsp;&nbsp;Pro - Users</a></li>
            <li><a href="all_channels.php"><i class='fas fa-tv' style='font-size:20px'></i>&nbsp;&nbsp;Channels</a></li>
            <li><a href="all_free_videos.php"><i class='far fa-file-video' style='font-size:20px'></i>&nbsp;&nbsp;Videos</a></li>
            <li><a href="all_pro_videos.php"><i class='fas fa-film' style='font-size:20px'></i>&nbsp;&nbsp;Pro Videos</a></li>
            <li><a href="all_admins.php"><i class='fas fa-user-alt' style='font-size:20px'></i>&nbsp;&nbsp;Admins</a></li>
            <li><a href="all_categories.php"><i class='fas fa-lightbulb' style='font-size:20px'></i>&nbsp;&nbsp;Categories</a></li>
            <li><a href="my_channel.php"><i class='fas fa-tv' style='font-size:20px'></i>&nbsp;&nbsp;My Channel</a></li>
            <li><a href="edit_account.php"><i class='fas fa-cog' style='font-size:20px'></i>&nbsp;&nbsp;Account Settings</a></li>
        </ul>

    </section>
    <section class="admin-panel">
        <div class="container-fluid">
          <h1 class="display-4">Account</h1>
          <hr>

          <div class="row">
            <div class="col-auto">
                <?php edit_account(); ?>
            </div>    
        </div>
        
        <br>
        <hr>
        <br>
          
    </section>
</div>

<script src="../../../script.js"></script>