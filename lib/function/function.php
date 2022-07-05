<?php 
    include("config.php");

    use FTP\Connection;
    session_start();

    
    /*
    Development history about fucntion.php file
    
    ---- 03 July 2022 - reg_user(), user_login(), video_upoload(), uploded_videos(),uploded_videos_loged()        
    ---- 04 July 2022 - check_user_id() and update --> reg_user(), user_login(), video_upoload(), uploded_videos(),uploded_videos_loged()
    ---- 05 July 2022 - get_video_id(), video_title_desc(), video_full_screen(), similer_videos(), count_users(), count_admis()
    ---- 06 July 2022 - count_channels(), count_videos(), and update --> reg_uer(),
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
                    header("location:../routes/index_loged.php");
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

    function video_upoload($video_title, $video_des, $video){
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
                $insert_video = "INSERT INTO videos(video_title,video_description,video_url,username,add_date)VALUES('$video_title','$video_des','$new_video','$username',NOW())";
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
        
        $all_videos = "SELECT * FROM videos LIMIT 30";
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
        
        $all_videos_loged = "SELECT * FROM videos LIMIT 30";
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
        $free_user = "SELECT * FROM user_tbl WHERE roll = 'user'";
        $free_user_result = mysqli_query($con, $free_user);

        //cont free users in database

        $free_user_nor = mysqli_num_rows($free_user_result);
        echo ($free_user_nor);
    }

    //function count_admis 

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
        $channels = "SELECT * FROM channels";
        $channels_result = mysqli_query($con, $channels);

        //count all channels

        $channels_nor = mysqli_num_rows($channels_result);
        //print numbers of channels

        echo ($channels_nor);
    }

    //function for count videos

    function count_videos(){
        
    }
?>
