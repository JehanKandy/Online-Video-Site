<?php 
    include_once("../../function/function.php");

    if(empty($_SESSION['loginSession'])){
        header("../../views/login.php");
    }

    include_once("../../layouts/header.php");
    include_once("../../layouts/nav_loged_video.php");

?>
<link rel="stylesheet" href="../../css/style.css">

<div class="admin-content">
    <section class="sidebar">
        <ul class="nav-bar">
            <li><a href="index_loged.php"><i class='far fa-file-video' style='font-size:20px'></i>&nbsp;&nbsp;View All Videos</a></li>
            <li><a href="#"><i class='fas fa-tachometer-alt' style='font-size:20px'></i>&nbsp;&nbsp;Dashboard</a></li>
            <li><a href="admin/all_free_users.php"><i class='fas fa-users' style='font-size:20px'></i>&nbsp;&nbsp;Users</a></li>
            <li><a href="#"><i class='fas fa-user-tie' style='font-size:20px'></i>&nbsp;&nbsp;Pro - Users</a></li>
            <li><a href="#"><i class='fas fa-tv' style='font-size:20px'></i>&nbsp;&nbsp;Channels</a></li>
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
          <h1 class="display-4">All Free Users</h1>
          <hr>

          <div class="row">
            <div class="col-auto">
              <div class="card bg-success text-white">
                <div class="card-body">
                  <h4><i class='fas fa-users' style='font-size:40px'></i>&nbsp;Active Users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php count_users(); ?></b>
                  </h5>
                </div>
              </div>
            </div>     
            <div class="col-auto">
              <div class="card bg-danger text-white">
                <div class="card-body">
                  <h4><i class='fas fa-user-alt-slash' style='font-size:40px'></i>&nbsp;Deactive Users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php count_pro_users(); ?></b>
                  </h5>
                </div>
              </div>
            </div> 
        </div>
        
        <br>
        <hr>
        <br>
            <h2>Data in Table with pagination</h2>
            <table class="table table-fluid" id="myTable">
            <thead>
            <tr>
                <td>
                ID
                </td>
                <td>
                Username
                </td>
                <td>
                Email
                </td>
                <td>
                Roll
                </td>
                <td>
                Account Type
                </td>
                <td>
                Join Date
                </td>
                <td>
                Action
                </td>
            </tr>
            </thead>
            <tbody>
            <tr><td>1</td><td>Jehan</td><td>jehan@123</td><td>user</td><td>free</td><td>date</td><td>action</td></tr>

            </tbody>
            </table>

    </section>
</div>

<script src="../../../script.js"></script>
