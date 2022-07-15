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
<section id="sidebar">
        <ul class="nav-bar">
            <li><a href="../index_loged.php"><i class='far fa-file-video' style='font-size:20px'></i>&nbsp;&nbsp;View All Videos</a></li>
            <li><a href="../user.php"><i class='fas fa-tachometer-alt' style='font-size:20px'></i>&nbsp;&nbsp;Dashboard</a></li>
            <li><a href="user_all_channels.php"><i class='fas fa-tv' style='font-size:20px'></i>&nbsp;&nbsp;Channels</a></li>
            <li><a href="user_all_categories.php"><i class='fas fa-lightbulb' style='font-size:20px'></i>&nbsp;&nbsp;Categories</a></li>
            <li><a href="my_channel_user.php"><i class='fas fa-tv' style='font-size:20px'></i>&nbsp;&nbsp;My Channel</a></li>
            <li><a href="edit_account_user.php"><i class='fas fa-cog' style='font-size:20px'></i>&nbsp;&nbsp;Account Settings</a></li>
        </ul>

    </section>
    <section class="admin-panel">
        <div class="container-fluid">
          <h1 class="display-4">Channel Username : <?php login_user_name(); ?></h1>
          <hr>
          <div class="row">
            <div class="col-auto">
                <?php user_channel_info(); ?>
            </div>
          </div>
          <br>
          <hr>
          <br>

          <div class="row">
            <div class="col-auto">
              <div class="card bg-primary text-white">
                <div class="card-body">
                  <h4><i class='far fa-file-video' style='font-size:40px'></i>&nbsp;Videos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php channel_free_videos(); ?></b>
                  </h5>
                </div>
              </div>
            </div> 
            <div class="col-auto">
              <div class="card bg-warning text-white">
                <div class="card-body">
                  <h4><i class='fas fa-film' style='font-size:40px'></i>&nbsp;Pro - Videos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php channel_pro_videos(); ?></b>
                  </h5>
                </div>
              </div>
            </div>     
        </div>
          <br>
          <hr>
          <br>
        <div class="row">
          <?php channel_videos(); ?>
        </div>
    </section>
</div>

<script src="../../../script.js"></script>