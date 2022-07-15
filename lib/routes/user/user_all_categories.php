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
          <h1 class="display-4">All Admins</h1>
          <hr>

          <div class="row">
            <div class="col-auto">
              <div class="card bg-success text-white">
                <div class="card-body">
                  <h4><i class='fas fa-user-alt' style='font-size:40px'></i>&nbsp;All Admins&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                  <hr style="background-color:white">
                  <h5>
                    <b><?php count_admins(); ?></b>
                  </h5>
                </div>
              </div>
            </div>    
        </div>
        
        <br>
        <hr>
        <a href="#"><button class="btn btn-success"><i class="fas fa-user-plus">&nbsp;</i>Add Admin</button></a>
        <br>
        <br>
            <h2>All Admins</h2>
            <table class="table table-fluid" id="myTable">
            <thead>
            <tr>
                <th>
                ID
                </th>
                <th>
                Username
                </th>
                <th>
                Email
                </th>
                <th>
                Roll
                </th>
                <th>
                Account Type
                </th>
                <th>
                Join Date
                </th>
                <th>
                Account Status
                </th>
            </tr>
            </thead>
            <tbody>
           <?php all_admins(); ?>

            </tbody>
            </table>

    </section>
</div>

<script src="../../../script.js"></script>