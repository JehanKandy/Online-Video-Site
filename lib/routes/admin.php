<?php 
  include_once("../function/function.php");

  if(empty($_SESSION['loginSession'])){
      header('location:../views/login.php');
  }

  include_once("../layouts/header.php");
  include_once("../layouts/nav_loged.php");
?>
<link rel="stylesheet" href="../../css/style.css">

<div class="admin-content">
    <section class="sidebar">
        <ul class="nav-bar">
            <li><a href="index_loged.php"><i class='far fa-file-video' style='font-size:20px'></i>&nbsp;&nbsp;View All Videos</a></li>
            <li><a href="#"><i class='fas fa-tachometer-alt' style='font-size:20px'></i>&nbsp;&nbsp;Dashboard</a></li>
            <li><a href="admin/all_free_users.php"><i class='fas fa-users' style='font-size:20px'></i>&nbsp;&nbsp;Users</a></li>
            <li><a href="admin/all_pro_users.php"><i class='fas fa-user-tie' style='font-size:20px'></i>&nbsp;&nbsp;Pro - Users</a></li>
            <li><a href="admin/all_channels.php"><i class='fas fa-tv' style='font-size:20px'></i>&nbsp;&nbsp;Channels</a></li>
            <li><a href="#"><i class='far fa-file-video' style='font-size:20px'></i>&nbsp;&nbsp;Videos</a></li>
            <li><a href="#"><i class='fas fa-film' style='font-size:20px'></i>&nbsp;&nbsp;Pro Videos</a></li>
            <li><a href="#"><i class='fas fa-user-alt' style='font-size:20px'></i>&nbsp;&nbsp;Admins</a></li>
            <li><a href="#"><i class='fas fa-lightbulb' style='font-size:20px'></i>&nbsp;&nbsp;Categories</a></li>
            <li><a href="#"><i class='fas fa-tv' style='font-size:20px'></i>&nbsp;&nbsp;My Channel</a></li>
            <li><a href="#"><i class='fas fa-cog' style='font-size:20px'></i>&nbsp;&nbsp;Account Settings</a></li>

        </ul>

    </section>
    <section class="admin-panel">
        <div class="container-fluid">
          <h1 class="display-4">Welcome to Dashboard</h1>
          <hr>

          <div class="row">
            <div class="col-auto">
              <div class="card bg-primary text-white">
                <div class="card-body">
                  <h4><i class='fas fa-users' style='font-size:40px'></i>&nbsp;Users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php count_users(); ?></b>
                  </h5>
                </div>
              </div>
            </div>     
            <div class="col-auto">
              <div class="card bg-success text-white">
                <div class="card-body">
                  <h4><i class='fas fa-user-tie' style='font-size:40px'></i>&nbsp;Pro - Users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php count_pro_users(); ?></b>
                  </h5>
                </div>
              </div>
            </div>   
            <div class="col-auto">
              <div class="card bg-warning text-white">
                <div class="card-body">
                  <h4><i class='fas fa-tv' style='font-size:40px'></i>&nbsp;Channels &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php count_channels(); ?></b>
                  </h5>
                </div>
              </div>
            </div>   
            <div class="col-auto">
              <div class="card bg-info text-white">
                <div class="card-body">
                  <h4><i class='far fa-file-video' style='font-size:40px'></i>&nbsp;Videos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php count_videos(); ?></b>
                  </h5>
                </div>
              </div>
            </div>   
            <div class="col-auto">
              <div class="card bg-success text-white">
                <div class="card-body">
                  <h4><i class='fas fa-film' style='font-size:40px'></i>&nbsp;Pro - Videos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php count_pro_videos(); ?></b>
                  </h5>
                </div>
              </div>
            </div>         
            <div class="col-auto">
              <div class="card bg-info text-white">
                <div class="card-body">
                  <h4><i class='fas fa-user-alt' style='font-size:40px'></i>&nbsp;Admins&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php count_admins(); ?></b>
                  </h5>
                </div>
              </div>
            </div>     
            <div class="col-auto">
              <div class="card bg-warning text-white">
                <div class="card-body">
                  <h4><i class='fas fa-lightbulb' style='font-size:40px'></i>&nbsp;Categories&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php count_catagery(); ?></b>
                  </h5>
                </div>
              </div>
            </div>   
          </div>
        </div>        
    </section>
</div>
