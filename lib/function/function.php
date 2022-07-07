<?php 
    include("config.php");

    use FTP\Connection;
    session_start();

    
    /*
    Development history about fucntion.php file
    
    ---- 03 July 2022 - reg_user(), user_login(), video_upoload(), uploded_videos(),uploded_videos_loged()        
    ---- 04 July 2022 - check_user_id() and update --> reg_user(), user_login(), video_upoload(), uploded_videos(),uploded_videos_loged()
    ---- 05 July 2022 - get_video_id(), video_title_desc(), video_full_screen(), similer_videos(), count_users(), count_admis()
    ---- 06 July 2022 - count_channels(), count_videos(), count_pro_videos(), count_pro_users(), count_catagery(), all_free_users(), update_to_view_info(),
                        update_user(), deactive_free_user(), deactive_pro_user(), all_pro_users(), video_select_category(),
                        count_deactive_channels(), channal_info(), channal_update_view(),  update_channel(), count_videos_deavtive(), all_free_videos()
                        video_update_view(), update_free_video()                        
                        and update --> reg_uer(),video_upoload()
    ---- 07 July 2022 - count_pro_videos_deactive(), all_pro_videos(),pro_video_update_view(),update_ro_video(),
    ---- 08 July 2022 -  all_admins(),all_categories(), login_user_name(),
                        
    */

    //function for register an user
    
    function reg_user($username, $email, $password, $cpassword){
        $con = Connection();
        // check are there any user according to added username and email

        $check_sql = "SELECT * FROM user_tbl WHERE username = '$username' ||  email = '$email'";
        $check_reuslt = mysqli_query($con, $check_sql);
        $check_nor = mysqli_num_rows($check_reuslt);


        if($check_nor > 0){
            return "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>User Already Exists..!</div>&nbsp</center>"; 
        }else{
            if($password != $cpassword){
                return "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Password Does not Match</div>&nbsp</center>"; 
            }
            else{
                //add data to the user_tbl
                $add_user = "INSERT INTO user_tbl(username,email,pass1,roll,user_status,join_date)VALUES('$username','$email','$password','user','1',NOW())";
                $add_user_result = mysqli_query($con, $add_user);

                // add data to the channels table
                $add_channel = "INSERT INTO channels(username,user_email,channel_status,created_date)VALUES('$username','$email','1',NOW())";
                $add_channel_result = mysqli_query($con, $add_channel);
                header('location:../views/login.php');
            }        
        }  
    }

    //function for register an user

    function login_user($login_usern, $login_pwd){
        $con = Connection();
        //get values form database according to login username and password

        $check_login_user = "SELECT * FROM user_tbl WHERE username = '$login_usern' && pass1 = '$login_pwd'";
        $check_login_user_result = mysqli_query($con, $check_login_user);
        $check_login_user_nor = mysqli_num_rows($check_login_user_result);
        $check_login_user_row = mysqli_fetch_assoc($check_login_user_result);

        //check are there any recodes 
        if($check_login_user_nor > 0){
            //check the password is equal
            if($login_pwd == $check_login_user_row['pass1']){
                //check user rolls

                if($check_login_user_row['roll'] == 'user'){
                    //set a cookie for login as user with 1 hour
                    setcookie('login',$check_login_user_row['email'],time()+60*60,'/');

                    //create a session for login as user 
                    $_SESSION['loginSession'] = $check_login_user_row['email'];
                    header("location:../routes/user.php");
                }
                elseif($check_login_user_row['roll'] == 'admin'){
                    //set a cookie for login as user with 1 hour
                    setcookie('login',$check_login_user_row['email'],time()+60*60,'/');

                    //create a session for login as user 
                    $_SESSION['loginSession'] = $check_login_user_row['email'];
                    header("location:../routes/admin.php");
                }
            }
            else{
                return "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Password is Doesn't Match...!</div>&nbsp</center>"; 
            }
        }
        else{
            return "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>No recodes found..!</div>&nbsp</center>"; 
        }

    }

    //create function for get the loged user's username


    

    function check_user_id(){
        $con = Connection();
        //get the loginSession email and convert it to string using strval()

        $email = strval($_SESSION['loginSession']);
        // get all data according to loginSession email from database

        $get_user_data = "SELECT * FROM user_tbl WHERE email = '$email'";
        $get_user_data_result = mysqli_query($con, $get_user_data);

        //now get the username from database

        $get_user_data_row = mysqli_fetch_assoc($get_user_data_result);

        if($get_user_data_row['roll'] == 'admin'){
            echo "
                <a href='../routes/admin.php'>&nbsp;&nbsp;".$get_user_data_row['username']."</a>
                    ";
        }
        elseif($get_user_data_row['roll'] == 'user'){
            echo "
                <a href='../routes/user.php'>&nbsp;&nbsp;".$get_user_data_row['username']."</a>
                    ";
        }

    }
    

    // function for upload videos

    function video_upoload($video_title, $video_des, $video, $video_catagery, $video_type){
        $con = Connection();

        //get email form loginSession

        $email = strval($_SESSION['loginSession']);

        //get all data from database using above email

        $get_data = "SELECT * FROM user_tbl WHERE email = '$email'";
        $get_data_result = mysqli_query($con, $get_data);
        $get_data_row = mysqli_fetch_assoc($get_data_result);

        $username = $get_data_row['username'];
        
       /*
            ********* for find name, type, tmp_name, errors, size of video 
            and also we can use it for images, files for upload to the
            database ***********

           echo "<pre>";
           echo($username);
           print_r($video);

        */

        //create veriable for video name
        $video_name = $_FILES['video']['name'];
        //create veriable for video temp_name
        $tmp_name = $_FILES['video']['tmp_name'];
        //error
        $error = $_FILES['video']['error'];
    
        //now check are there any errors in this array

        if($error === 0){
            //now get the pathinfo of video 
            $video_mp4 = pathinfo($video_name, PATHINFO_EXTENSION);

            /*  now print it
                echo $video_mp4;  */
            //now convert video pathifo to lowercase
             
            $video_exe_lc = strtolower($video_mp4);

            //now give the user controlls for video upload
            // file type controllers(some of video file types are in array)

            $allowed_file_types = array("mp4","webm","avi","flv");

            //now do some error handlings

            if(in_array($video_exe_lc, $allowed_file_types)){

                //now make new name for video with lowercase extention
                $new_video = uniqid("video-", true).'.'.$video_exe_lc;

                //now make folder for uploaded videos
                $video_file_path = '../../../upload/'.$new_video;

                // now move the video to above folder
                move_uploaded_file($tmp_name, $video_file_path);


                //now upload files to the database
                $insert_video = "INSERT INTO videos(video_title,video_description,video_url,username,category,video_type,video_status,add_date)VALUES('$video_title','$video_des','$new_video','$username','$video_catagery','$video_type','1',NOW())";
                $insert_video_result = mysqli_query($con, $insert_video);

                //header to  view.php file for view uploaded videos
                header("location:../index_loged.php");
            }

            else{
                //print error
                $error_msg = "Wrong File Type";
                header("location:test_video_upload.php?error=$error_msg");
            }

        }

    }



    // create a function for view uploaded video
    function uploded_videos(){
        $con = Connection();
        
        $all_videos = "SELECT * FROM videos WHERE video_status = '1' LIMIT 30";
        $all_videos_result = mysqli_query($con, $all_videos);
        $all_video_nor = mysqli_num_rows($all_videos_result);
        
        if($all_video_nor > 0){
            while($video_row = mysqli_fetch_assoc($all_videos_result)){

                    /*  ********* for find database table column of video 
                        and also we can use it for images, files for view to the
                        database ***********    

                    echo "<pre>";
                    print_r($video_row);  */
                        
                echo "
                            
                                <div class='col-auto'>
                                    <div class='card-body'>
                                        <video src='upload/".$video_row['video_url']."' ></video>
                                        <div class='title-video'>

                                            <span class='title'>Video Title : ".$video_row['video_title']."</span>
                    
                                        </div>

                                    </div>
                                </div>
                            
                        ";

            }
        }
    }

    function uploded_videos_loged(){
        $con = Connection();
        
        $all_videos_loged = "SELECT * FROM videos WHERE video_status = '1' LIMIT 30";
        $all_videos_loged_result = mysqli_query($con, $all_videos_loged);
        $all_video_loged_nor = mysqli_num_rows($all_videos_loged_result);
        
        if($all_video_loged_nor > 0){
            while($video_row_loged = mysqli_fetch_assoc($all_videos_loged_result)){

                    /*  ********* for find database table column of video 
                        and also we can use it for images, files for view to the
                        database ***********    

                    echo "<pre>";
                    print_r($video_row);  */
                        
                echo "
                            
                                <div class='col-auto'>
                                    <a href='../routes/video_full_screen.php?id=".$video_row_loged['id']."'>
                                        <div class='card-body'>
                                            <video src='../../upload/".$video_row_loged['video_url']."'controls></video>
                                            <div class='title-video'>
                                                <span class='title'>".$video_row_loged['video_title']."</span>
                                            </div>                                    
                                        </div>
                                    </a>
                                </div>
                            
                        ";

            }
        }
    }

    //function for watch video id 

    function get_video_id($video_id){
        $con = Connection();
        //echo $video_id;     
        
        $_SESSION['Video_id'] = $video_id;
    }

    //function for Video title and description

    function video_title_desc(){
        $con = Connection();

        //get video id from get_video_id funtion

        $vid_id = strval($_SESSION['Video_id']);

        //echo $vid_id;

        //now get all data from database according to video id

        $get_video_data = "SELECT * FROM videos WHERE id = '$vid_id'";
        $get_video_data_result = mysqli_query($con, $get_video_data);

        //get video description from database

        $get_video_data_row = mysqli_fetch_assoc($get_video_data_result);

        $video_desc = $get_video_data_row['video_description'];

        // echo video description
        echo "
        <div class='video-title'>
            ".$get_video_data_row['video_title']."
        </div>
        <div class='video-desc'>
            ".$get_video_data_row['video_description']."
        </div>
        ";
    }


    //function for Video full screen

    function video_full_screen(){
        $con = Connection();

        //get video id from get_video_id funtion
        $videos_id = strval($_SESSION['Video_id']);

        //now get all data from database according to video id

        $get_videos_data = "SELECT * FROM videos WHERE id = '$videos_id'";
        $get_videos_data_result = mysqli_query($con, $get_videos_data);

        //get video description from database

        $get_videos_data_row = mysqli_fetch_assoc($get_videos_data_result);

        //now echo the video
        echo "
                <video src='../../upload/".$get_videos_data_row['video_url']."'controls></video>

            ";

    }

    //function of similer videos

    function similer_videos(){
        $con = Connection();

        //get similer videos from database

        $video_similer = "SELECT * FROM videos LIMIT 12";
        $video_similer_result = mysqli_query($con, $video_similer);

        // get 12 similer videos from database
        
        while($video_similer_row = mysqli_fetch_assoc($video_similer_result)){
            echo "
                            
                <div class='col-auto'>
                    <div class='card-body'>
                        <video src='../../upload/".$video_similer_row['video_url']."'controls></video>
                    </div>
                </div>
        
            ";
        }        
    }

    //function for count users

    function count_users(){
        $con = Connection();

        //get all data from database according to free users
        $free_user = "SELECT * FROM user_tbl WHERE roll = 'free' && user_status = '1'";
        $free_user_result = mysqli_query($con, $free_user);

        //cont free users in database

        $free_user_nor = mysqli_num_rows($free_user_result);
        echo ($free_user_nor);
    }

    //function for deactive free users
    function deactive_free_user(){
        $con = Connection();

        
        //get all data from database according to free deactive users
        $free_deactive_user = "SELECT * FROM user_tbl WHERE roll = 'free' && user_status = '0'";
        $free_deactive_user_result = mysqli_query($con, $free_deactive_user);

        //cont free users in database

        $free_deactive_user_nor = mysqli_num_rows($free_deactive_user_result);
        echo ($free_deactive_user_nor);
        
    }

    //function for count_pro_users
    function count_pro_users(){
        $con = Connection();

        //get data according to pro users in table
        $pro_users = "SELECT * FROM user_tbl WHERE roll = 'pro' && user_status = '1'";
        $pro_users_result = mysqli_query($con, $pro_users);

        //count pro_users
        $pro_users_nor = mysqli_num_rows($pro_users_result);

        //print number of free users
        echo $pro_users_nor;
    }

        //function for deactive pro users
        function deactive_pro_user(){
            $con = Connection();
    
            
            //get all data from database according to free deactive users
            $pro_deactive_user = "SELECT * FROM user_tbl WHERE roll = 'pro' && user_status = '0'";
            $pro_deactive_user_result = mysqli_query($con, $pro_deactive_user);
    
            //cont free users in database
    
            $pro_deactive_user_nor = mysqli_num_rows($pro_deactive_user_result);
            echo ($pro_deactive_user_nor);
            
        }

    //function for count_admis 

    function count_admins(){
        $con = Connection();

        // get all data from database according admins
        $admin_data = "SELECT * FROM user_tbl WHERE roll = 'admin'";
        $admin_data_result = mysqli_query($con, $admin_data); 
        
        //count admins in database

        $admin_data_nor = mysqli_num_rows($admin_data_result);
        echo ($admin_data_nor);
    }

    //function for count_channels

    function count_channels(){
        $con = Connection();

        //gat all data from database 
        $channels = "SELECT * FROM channels WHERE channel_status = '1'";
        $channels_result = mysqli_query($con, $channels);

        //count all channels

        $channels_nor = mysqli_num_rows($channels_result);
        //print numbers of channels

        echo ($channels_nor);
    }

    //function for count deactive channels

    function count_deactive_channels(){
        $con = Connection();
    
        //gat all data from database 
        $channels_deactive = "SELECT * FROM channels WHERE channel_status = '0'";
        $channels_deactive_result = mysqli_query($con, $channels_deactive);
    
        //count all channels
    
        $channels_deactive_nor = mysqli_num_rows($channels_deactive_result);
        //print numbers of channels
    
        echo ($channels_deactive_nor);
        }
    
    //function for count videos

    function count_videos(){
        $con = Connection();

        //get all data from database according to free videos
        $free_videos = "SELECT * FROM videos WHERE video_status = '1' && video_type = 'free'";
        $free_videos_result = mysqli_query($con, $free_videos);

        //count free videos
        $free_videos_nor = mysqli_num_rows($free_videos_result);

        echo($free_videos_nor);
    }

        //function for count videos

    function count_videos_deavtive(){
        $con = Connection();

        //get all data from database according to free videos
        $free_videos_deactive = "SELECT * FROM videos WHERE video_status = '0' && video_type = 'free'";
        $free_videos_deactive_result = mysqli_query($con, $free_videos_deactive);

        //count free videos
        $free_videos_deactive_nor = mysqli_num_rows($free_videos_deactive_result);

        echo($free_videos_deactive_nor);
    }

    //function for count pro videos
    function count_pro_videos(){
        $con = Connection();

        //get all data from database according to Pro videos
        $pro_videos = "SELECT * FROM videos WHERE video_type = 'pro' && video_status = '1'";
        $pro_videos_result = mysqli_query($con, $pro_videos);

        //count pro videos in database 

        $pro_videos_nor = mysqli_num_rows($pro_videos_result);

        //print Pro-videos

        echo ($pro_videos_nor);
    }

    //function for count pro videos
    function count_pro_videos_deactive(){
        $con = Connection();

        //get all data from database according to Pro videos
        $pro_videos_deactive = "SELECT * FROM videos WHERE video_type = 'pro' && video_status = '0'";
        $pro_videos_deactive_result = mysqli_query($con, $pro_videos_deactive);

        //count pro videos in database 

        $pro_videos_deactive_nor = mysqli_num_rows($pro_videos_deactive_result);

        //print Pro-videos

        echo ($pro_videos_deactive_nor);
    }

    //function for count catagery
    function count_catagery(){
        $con = Connection();

        //gat all data according to catagery
        $catagery = "SELECT * FROM categories";
        $catagery_result = mysqli_query($con,$catagery);

        //count catagery in database
        $catagery_nor = mysqli_num_rows($catagery_result);

        //print number of catagery
        echo $catagery_nor;
    }

    //fucntion for all free users
    function all_free_users(){
        $con = Connection();

        //gat all data from database accorfing to free users

        $all_free_users = "SELECT * FROM user_tbl WHERE roll = 'free'";
        $all_free_users_result = mysqli_query($con, $all_free_users);
        
        //now print all data in table

        while($all_free_users_row = mysqli_fetch_assoc($all_free_users_result)){
            $free_user =  "
            <tr>
                <td>".$all_free_users_row['id']."</td>
                <td>".$all_free_users_row['username']."</td>
                <td>".$all_free_users_row['email']."</td>
                <td>user</td>
                <td>".$all_free_users_row['roll']."</td>
                <td>".$all_free_users_row['join_date']."</td> ";

                if($all_free_users_row['user_status'] == 1){
                    $free_user .= "<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                }
                elseif($all_free_users_row['user_status'] == 0){
                    $free_user .= "<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                }

            $free_user .="    
                <td><a href='edit_free_user_info.php?id=".$all_free_users_row['username']."'><button class='btn btn-primary'>Action</button></a></td>
            </tr>
            
                ";

            echo $free_user;
        }

       }

    //fucntion for all pro users
    function all_pro_users(){
        $con = Connection();

        //gat all data from database accorfing to pro users

        $all_pro_users = "SELECT * FROM user_tbl WHERE roll = 'pro'";
        $all_pro_users_result = mysqli_query($con, $all_pro_users);
        
        //now print all data in table

        while($all_pro_users_row = mysqli_fetch_assoc($all_pro_users_result)){
            $free_user =  "
            <tr>
                <td>".$all_pro_users_row['id']."</td>
                <td>".$all_pro_users_row['username']."</td>
                <td>".$all_pro_users_row['email']."</td>
                <td>user</td>
                <td>".$all_pro_users_row['roll']."</td>
                <td>".$all_pro_users_row['join_date']."</td> ";

                if($all_pro_users_row['user_status'] == 1){
                    $free_user .= "<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                }
                elseif($all_pro_users_row['user_status'] == 0){
                    $free_user .= "<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                }

            $free_user .="    
                <td><a href='edit_pro_user_info.php?id=".$all_pro_users_row['username']."'><button class='btn btn-primary'>Action</button></a></td>
            </tr>
            
                ";

            echo $free_user;
        }

       }

       //function for update to view info

       function update_to_view_info(){
        $con = Connection();

        $id = $_GET['id'];
        //echo $id;

        //get data from user_tbl according to id
        $update_user = "SELECT * FROM user_tbl WHERE username = '$id'";
        $update_user_result = mysqli_query($con, $update_user);

        //fetch data 
        $update_user_row = mysqli_fetch_assoc($update_user_result);

        $update_user = "
                        <div class='body'>
                            <form action='' method='POST'>
                                <table border='0'>
                                    <tr>
                                        <td>
                                            <span class='label'>ID : </span>
                                        </td>
                                        <td>"
                                            .$update_user_row['id'].                                            
                                            "<input type='hidden' name='username' value='".$update_user_row['username']."'> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class='label'>Username :</span>
                                        </td>
                                        <td>
                                            ".$update_user_row['username']."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class='label'>Email:</span>
                                        </td>
                                        <td>
                                            ".$update_user_row['email']."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class='label'>Roll:</span>
                                        </td>
                                        <td>
                                            ".$update_user_row['roll']."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class='label'>Join Date:</span>
                                        </td>
                                        <td>
                                            ".$update_user_row['join_date']."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class='label'>User Status:</span>
                                        </td>";

                                        if($update_user_row['user_status'] == 1){
                                            $update_user .= "<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                                        }
                                        elseif($update_user_row['user_status'] == 0){
                                            $update_user .= "<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                                        }
                        


                            $update_user .="</tr>

                            <tr>
                                <td>
                                    <span class='label'>Join Date:</span>
                                </td>
                                <td>
                                    <select name='user_status' id='user_status'>
                                        <option value='1'>Active</option>
                                        <option value='0'>Deactive</option>    
                                    </select>
                                </td>
                            </tr>
                                   
                            <tr>
                                <td colspan='2'>
                                    <input type='submit' name='update' class='btn btn-success' value='Update'>
                                </td>
                            </tr>   
                                </table>   
                            </form>
                            <br><br>
                        <a href='all_free_users.php'><button class='btn btn-primary'>Back</button></a>
                            
                        </div>
                        ";


        echo $update_user;
    }

    
    // function for update user

    function update_user($update_user, $update_user_status){
        $con = Connection();

        //update user
        $update_user_data = "UPDATE user_tbl SET user_status = '$update_user_status' WHERE username = '$update_user'";
        $update_user_data_result = mysqli_query($con, $update_user_data);

        header("location:all_free_users.php");

    }



 //function for update to view info

    function update_to_view_info_pro(){
        $con = Connection();

        $id = $_GET['id'];
        //echo $id;

        //get data from user_tbl according to id
        $update_user_pro = "SELECT * FROM user_tbl WHERE username = '$id'";
        $update_user_pro_result = mysqli_query($con, $update_user_pro);

        //fetch data 
        $update_user_pro_row = mysqli_fetch_assoc($update_user_pro_result);

        $update_user = "
                        <div class='body'>
                            <form action='' method='POST'>
                                <table border='0'>
                                    <tr>
                                        <td>
                                            <span class='label'>ID : </span>
                                        </td>
                                        <td>"
                                            .$update_user_pro_row['id'].                                            
                                            "<input type='hidden' name='username' value='".$update_user_pro_row['username']."'> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class='label'>Username :</span>
                                        </td>
                                        <td>
                                            ".$update_user_pro_row['username']."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class='label'>Email:</span>
                                        </td>
                                        <td>
                                            ".$update_user_pro_row['email']."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class='label'>Roll:</span>
                                        </td>
                                        <td>
                                            ".$update_user_pro_row['roll']."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class='label'>Join Date:</span>
                                        </td>
                                        <td>
                                            ".$update_user_pro_row['join_date']."
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class='label'>User Status:</span>
                                        </td>";

                                        if($update_user_pro_row['user_status'] == 1){
                                            $update_user .= "<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                                        }
                                        elseif($update_user_pro_row['user_status'] == 0){
                                            $update_user .= "<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                                        }
                        


                            $update_user .="</tr>

                            <tr>
                                <td>
                                    <span class='label'>Join Date:</span>
                                </td>
                                <td>
                                    <select name='user_status' id='user_status'>
                                        <option value='1'>Active</option>
                                        <option value='0'>Deactive</option>    
                                    </select>
                                </td>
                            </tr>
                                
                            <tr>
                                <td colspan='2'>
                                    <input type='submit' name='update' class='btn btn-success' value='Update'>
                                </td>
                            </tr>   
                                </table>   
                            </form>
                            <br><br>
                        <a href='all_pro_users.php'><button class='btn btn-primary'>Back</button></a>
                            
                        </div>
                        ";


        echo $update_user;
    }
    // function for update user

    function update_user_pro($update_user_pro, $update_user_status_pro){
        $con = Connection();

        //update user pro
        $update_user_pro_data = "UPDATE user_tbl SET user_status = '$update_user_status_pro' WHERE username = '$update_user_pro'";
        $update_user_pro_data_result = mysqli_query($con, $update_user_pro_data);

        header("location:all_pro_users.php");

    }

    //function for video select category
    function video_select_category(){
        $con = Connection();

        //view avalabel categories for select to user

        $all_categories = "SELECT * FROM categories";
        $all_categories_result = mysqli_query($con, $all_categories);


        $category =  "
                    <span class='label'>Video Category</span>

                    <select name='video_catagory' id='video_catagory' class='video_input'>
                        <option>SELECT</option>";
                        
                        while($all_categories_row = mysqli_fetch_assoc($all_categories_result)){
          
 
        $category .= "<option value='".$all_categories_row['category_name']."'>".$all_categories_row['category_name']."</option>
                    </select>
        
            ";
        }
        
        echo $category;
    }

    //function for channal info
    function channal_info(){
        $con = Connection();

        //fetch channel data with videos
        $channel_info_echo = "SELECT * FROM channels";
        $channel_info_echo_result = mysqli_query($con, $channel_info_echo);

        while($channel_row = mysqli_fetch_assoc($channel_info_echo_result)){
            $channel = "
                    <tr>
                        <td>".$channel_row['id']."</td>
                        <td>".$channel_row['channel_name']."</td>
                        <td>".$channel_row['username']."</td>";
                        
                        if($channel_row['channel_status'] == 1){
                            $channel .="<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                        }
                        elseif($channel_row['channel_status'] == 0){
                            $channel .="<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                        }


                    $channel .="
                        <td>".$channel_row['created_date']."</td>
                        <td><a href='edit_channel_info.php?id=".$channel_row['id']."'><button class='btn btn-primary'>Action</button></td>
                    </tr>
                    ";
            echo $channel;
        }
    }

    //funtion for channel update view
    function channal_update_view(){
        $con = Connection();

        //get id from channal_info()
        $id = $_GET['id'];
        
        
        //get channel data from database
        $channel_data = "SELECT * FROM channels WHERE id ='$id'";
        $channel_data_result = mysqli_query($con, $channel_data);

        //fetch channel data

        $channel_data_row = mysqli_fetch_assoc($channel_data_result);

        $channel_data_edit = "
                            <div class='body'>
                                <form action='' method='POST'>
                                    <table border='0'>
                                        <tr>
                                            <td>ID : </td>
                                            <td>".$channel_data_row['id']."
                                            <input type='hidden' name='id' value='".$channel_data_row['id']."'></td>
                                        </tr>
                                        <tr>
                                            <td>Channel Name :</td>
                                            <td>".$channel_data_row['channel_name']."</td>
                                        </tr>
                                        <tr>
                                            <td>Username :</td>
                                            <td>".$channel_data_row['username']."</td>
                                        </tr>
                                        <tr>
                                            <td>Channel Status</td>";
                                            if($channel_data_row['channel_status'] == 1){
                                                $channel_data_edit .="<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                                            }
                                            elseif($channel_data_row['channel_status'] == 0){
                                                $channel_data_edit .="<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                                            }


                         $channel_data_edit .="</tr>
                                        <tr>
                                            <td>Create Date:</td>
                                            <td>".$channel_data_row['created_date']."</td>
                                        </tr>
                                        <tr>
                                            <td>Channel Status : </td>
                                            <td>
                                                <select name='channel_status' id='channel_status'>
                                                    <option value='1'>Active</option>
                                                    <option value='0'>Deactive</option> 
                                                </select>                                                   
                                            </td>
                                        </tr>
                                    <tr>
                                        <td><input type='submit' name='update' value='Update' class='btn btn-success'></td>
                                    </tr>
                                </form>
                                </table>
                                <br><br>
                                <a href='all_channels.php'><button class='btn btn-primary'>Back</button></a>
                            </div>


                        ";

        echo $channel_data_edit;

    }

    //function for update channel
    function update_channel($channel_id, $channel_status){
        $con = Connection();

        //update channel
        $update_channel_data = "UPDATE channels SET channel_status = '$channel_status' WHERE id = '$channel_id'";
        $update_channel_data_result = mysqli_query($con, $update_channel_data);
        header("location:all_channels.php");
    }


    //function for all free videos

    function all_free_videos(){
        $con = Connection();

        //get all data from databes
        $all_videos = "SELECT * FROM videos WHERE video_type = 'free'";
        $all_videos_result = mysqli_query($con, $all_videos);

        //fetch all data 
        while($all_videos_row = mysqli_fetch_assoc($all_videos_result)){
            $all_video_data = "
                        <tr>
                            <td>".$all_videos_row['id']."</td>
                            <td>".$all_videos_row['video_title']."</td>
                            <td>".$all_videos_row['username']."</td>
                            <td>".$all_videos_row['category']."</td>
                            <td>".$all_videos_row['video_type']."</td>
                            <td>".$all_videos_row['add_date']."</td>";
                            

                            if($all_videos_row['video_status'] == 1){
                                $all_video_data .="<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                            }
                            elseif($all_videos_row['video_status'] == 0){
                                $all_video_data .="<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                            }

            $all_video_data .="    
                            <td><a href='edit_free_video_info.php?id=".$all_videos_row['id']."'><button class='btn btn-primary'>Action</button></a></td>                      
                        </tr>                   
                    
                        ";
            echo $all_video_data;

        }
        
    }

    //function for video update view
    function video_update_view(){
        $con = Connection();

        //get id from all_free_videos()
        $id = $_GET['id'];

        $update_video = "SELECT * FROM videos WHERE id = '$id'";
        $update_video_result = mysqli_query($con, $update_video);


        //fetch data
        $update_video_row = mysqli_fetch_assoc($update_video_result);

        //echo data

        $update_video = "
                <div class='body'>
                    <form action='' method='POST'>
                        <table border='0'>
                            <tr>
                                <td>ID : </td>
                                <td>".$update_video_row['id']."
                                <input type='hidden' name='id' value='".$update_video_row['id']."'>
                                </td>
                            </tr>
                            <tr>
                                <td>Video Title : </td>
                                <td>".$update_video_row['video_title']."</td>
                            </tr>
                            <tr>
                                <td>Username : </td>
                                <td>".$update_video_row['username']."</td>
                            </tr>
                            <tr>
                                <td>Category : </td>
                                <td>".$update_video_row['category']."</td>
                            </tr>
                            <tr>
                                <td>Video Type : </td>
                                <td>".$update_video_row['video_type']."</td>
                            </tr>
                            <tr>
                                <td>Video Add Date : </td>
                                <td>".$update_video_row['add_date']."</td>
                            </tr>
                            <tr>
                                <td>Video Status : </td>";

                                if($update_video_row['video_status'] == 1){
                                    $update_video .="<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                                }
                                elseif($update_video_row['video_status'] == 0){
                                    $update_video .="<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                                }

                        
                $update_video .="</tr>
                            <tr>
                                <td>Video Status : </td>
                                <td>
                                    <select name='video_status' id='video_status'>
                                        <option value='1'>Active</option>
                                        <option value='0'>Deactive</option>                                        
                                    </select>    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type='submit' name='update' value='Update' class='btn btn-success'>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <br><br>
                    <a href='all_free_videos.php'><button class='btn btn-primary'>Back</button></a>
                </div>

            ";

        echo $update_video;
    }

    //function for update free video
    function update_free_video($video_id, $video_status){
        $con = Connection();

        //update video table
        $update_vid = "UPDATE videos SET video_status = '$video_status' WHERE id = '$video_id'";
        $update_video_result = mysqli_query($con, $update_vid);

        header("location:all_free_videos.php");

    }

    //function for all pro videos

    function all_pro_videos(){
        $con = Connection();

        //get all data from databes
        $all_videos_pro = "SELECT * FROM videos WHERE video_type = 'pro'";
        $all_videos_pro_result = mysqli_query($con, $all_videos_pro);

        //fetch all data 
        while($all_videos_pro_row = mysqli_fetch_assoc($all_videos_pro_result)){
            $all_video_pro_data = "
                        <tr>
                            <td>".$all_videos_pro_row['id']."</td>
                            <td>".$all_videos_pro_row['video_title']."</td>
                            <td>".$all_videos_pro_row['username']."</td>
                            <td>".$all_videos_pro_row['category']."</td>
                            <td>".$all_videos_pro_row['video_type']."</td>
                            <td>".$all_videos_pro_row['add_date']."</td>";
                            

                            if($all_videos_pro_row['video_status'] == 1){
                                $all_video_pro_data .="<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                            }
                            elseif($all_videos_pro_row['video_status'] == 0){
                                $all_video_pro_data .="<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                            }

            $all_video_pro_data .="    
                            <td><a href='edit_pro_video_info.php?id=".$all_videos_pro_row['id']."'><button class='btn btn-primary'>Action</button></a></td>                      
                        </tr>                   
                    
                        ";
            echo $all_video_pro_data;

        }
        
    }
 //function for pro video update view
 function pro_video_update_view(){
    $con = Connection();

    //get id from all_free_videos()
    $id = $_GET['id'];

    $update_video_pro = "SELECT * FROM videos WHERE id = '$id'";
    $update_video_pro_result = mysqli_query($con, $update_video_pro);


    //fetch data
    $update_video_pro_row = mysqli_fetch_assoc($update_video_pro_result);

    //echo data

    $update_pro_video = "
            <div class='body'>
                <form action='' method='POST'>
                    <table border='0'>
                        <tr>
                            <td>ID : </td>
                            <td>".$update_video_pro_row['id']."
                            <input type='hidden' name='id' value='".$update_video_pro_row['id']."'>
                            </td>
                        </tr>
                        <tr>
                            <td>Video Title : </td>
                            <td>".$update_video_pro_row['video_title']."</td>
                        </tr>
                        <tr>
                            <td>Username : </td>
                            <td>".$update_video_pro_row['username']."</td>
                        </tr>
                        <tr>
                            <td>Category : </td>
                            <td>".$update_video_pro_row['category']."</td>
                        </tr>
                        <tr>
                            <td>Video Type : </td>
                            <td>".$update_video_pro_row['video_type']."</td>
                        </tr>
                        <tr>
                            <td>Video Add Date : </td>
                            <td>".$update_video_pro_row['add_date']."</td>
                        </tr>
                        <tr>
                            <td>Video Status : </td>";

                            if($update_video_pro_row['video_status'] == 1){
                                $update_pro_video .="<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                            }
                            elseif($update_video_pro_row['video_status'] == 0){
                                $update_pro_video .="<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                            }

                    
            $update_pro_video .="</tr>
                        <tr>
                            <td>Video Status : </td>
                            <td>
                                <select name='video_status' id='video_status'>
                                    <option value='1'>Active</option>
                                    <option value='0'>Deactive</option>                                        
                                </select>    
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type='submit' name='update' value='Update' class='btn btn-success'>
                            </td>
                        </tr>
                    </table>
                </form>
                <br><br>
                <a href='all_free_videos.php'><button class='btn btn-primary'>Back</button></a>
            </div>

        ";

    echo $update_pro_video;
    }
    
    //function for update free video
    function update_pro_video($video_id_pro, $video_status_pro){
        $con = Connection();

        //update video table
        $update_vid_pro = "UPDATE videos SET video_status = '$video_status_pro' WHERE id = '$video_id_pro'";
        $update_vid_pro_result = mysqli_query($con, $update_vid_pro);

        header("location:all_pro_videos.php");

    }

    //function for all admins
    function all_admins(){
        $con = Connection();

        //get all data from databes
        $all_admin = "SELECT * FROM user_tbl WHERE roll = 'admin'";
        $all_admin_result = mysqli_query($con, $all_admin);

        //fetch all data 
        while($all_admin_row = mysqli_fetch_assoc($all_admin_result)){
            $all_admin_data = "
                        <tr>
                            <td>".$all_admin_row['id']."</td>
                            <td>".$all_admin_row['username']."</td>
                            <td>".$all_admin_row['email']."</td>
                            <td>".$all_admin_row['roll']."</td>
                            <td>".$all_admin_row['account_type']."</td>
                            <td>".$all_admin_row['join_date']."</td>";
                            

                            if($all_admin_row['user_status'] == 1){
                                $all_admin_data .="<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                            }
                            elseif($all_admin_row['user_status'] == 0){
                                $all_admin_data .="<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                            }

            echo $all_admin_data;

        }
    }

    //function for all Categories
    function all_categories(){
        $con = Connection();

        //get all data from databes
        $all_categories = "SELECT * FROM categories";
        $all_categories_result = mysqli_query($con, $all_categories);

        //fetch all data 
        while($all_categories_row = mysqli_fetch_assoc($all_categories_result)){
            $all_categories_data = "
                        <tr>
                            <td>".$all_categories_row['id']."</td>
                            <td>".$all_categories_row['username']."</td>
                            <td>".$all_categories_row['category_name']."</td>";

                            if($all_categories_row['category_status'] == 1){
                                $all_categories_data .="<td><h2 class='badge badge-pill badge-success'>Active</h2></td>";
                            }
                            elseif($all_categories_row['category_status'] == 0){
                                $all_categories_data .="<td><h2 class='badge badge-pill badge-danger'>Deactive</h2></td>";
                            }

            $all_categories_data  .=" <td>".$all_categories_row['category_date']."</td>";



            echo $all_categories_data;

        }
    }

    //function for get login_user name for my_channel
    function login_user_name(){
        $con = Connection();

        //get loginSession username
        $email = strval($_SESSION['loginSession']);

        //get Username form database according to loginSession
    }
?>
