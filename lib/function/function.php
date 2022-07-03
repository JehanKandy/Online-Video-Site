
<?php 
    include("config.php");

    use FTP\Connection;
    session_start();

    
    /*
    Development history about fucntion.php file
    
    ---- 03 July 2022 - reg_user(), user_login(), video_upoload(), uploded_videos()    
    
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
                $add_user = "INSERT INTO user_tbl(username,email,pass1,roll,user_status,join_date)VALUES('$username','$email','$password','user','1',NOW())";
                $add_user_result = mysqli_query($con, $add_user);
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


    // function for upload videos

    function video_upoload($username, $video){
        $con = Connection();

        
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
                $video_file_path = 'upload/'.$new_video;

                // now move the video to above folder
                move_uploaded_file($tmp_name, $video_file_path);


                //now upload files to the database
                $insert_video = "INSERT INTO videos(video_url,username,add_date)VALUES('$new_video','$username',NOW())";
                $insert_video_result = mysqli_query($con, $insert_video);

                //header to  view.php file for view uploaded videos
                header("location:view.php");
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
                                    </div>
                                </div>
                            
                        ";

            }
        }
    }


?>
