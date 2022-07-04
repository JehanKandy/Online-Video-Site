@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fjalla+One&family=Kdam+Thmor+Pro&family=Roboto+Flex:opsz@8..144&family=Rubik&family=Teko:wght@300&display=swap');

/*

    use font families

        font-family: 'Bebas Neue', cursive;
        font-family: 'Fjalla One', sans-serif;
        font-family: 'Kdam Thmor Pro', sans-serif;
        font-family: 'Roboto Flex', sans-serif;
        font-family: 'Rubik', sans-serif;
        font-family: 'Teko', sans-serif;





        This style sheet is responsive for following Devices

        1. standard laptop screen 
        2. standard iPad screen
        3. standard iPad Air screen
        4. standard iPad Mini screen

*/

.home {
    height: 100%;
    width: 100%;
    background-color: rgba(238, 238, 238, 0.281);
}

.home-content {
    padding: 60px;
}

.logout-btn-nav {
    width: 100px;
    height: 45px;
    color: white;
    border: none;
    border-radius: 5px;
    background: -webkit-linear-gradient(right, #ce4444, #ff8e8e);
    transition: 0.5s;
}

.logout-btn-nav:hover {
    background: -webkit-linear-gradient(right, #ff8e8e, #ce4444);
    box-shadow: 0 2px 4px 0 rgba(255, 255, 255, 0.678), 0 3px 10px 0 rgba(255, 255, 255, 0.596);
}

.login-btn-nav {
    width: 100px;
    height: 45px;
    color: white;
    border: none;
    border-radius: 5px;
    background: -webkit-linear-gradient(right, #56d8e4, #9f01ea);
    transition: 0.5s;
}

.login-btn-nav:hover {
    background: -webkit-linear-gradient(right, #9f01ea, #56d8e4);
    box-shadow: 0 2px 4px 0 rgba(255, 255, 255, 0.678), 0 3px 10px 0 rgba(255, 255, 255, 0.596);
}

video {
    width: 320px;
    height: 240px;
}

.reg {
    padding-top: 60px;
    padding-left: 500px;
    padding-right: 500px;
    padding-bottom: 60px;
}

.reg-content {
    width: 500px;
    height: 100%;
    border: 1px solid rgb(182, 182, 182);
    border-radius: 5px;
    font-size: 20px;
}

.reg-content-title {
    padding-top: 30px;
    padding-left: 50px;
    padding-right: 50px;
    padding-bottom: 15px;
    font-family: 'Roboto Flex', sans-serif;
    font-size: 25px;
}

.reg-content-body {
    padding-top: 5px;
    padding-left: 50px;
    padding-right: 50px;
    padding-bottom: 70px;
    font-family: 'Roboto Flex', sans-serif;
    font-size: 20px;
}

.reg-content-body .login-input {
    margin-top: 10px;
    margin-bottom: 10px;
    width: 100%;
    height: 50px;
    border: 1px solid rgb(182, 182, 182);
    border-radius: 5px;
    font-size: 20px;
}

.reg-content-body .login-btn,
.clr-btn {
    width: 48%;
    height: 50px;
    background: -webkit-linear-gradient(right, #56d8e4, #9f01ea);
    border: none;
    border-radius: 5px;
    color: white;
    transition: all 0.5s;
    margin-top: 15px;
}

.reg-content-body .clr-btn {
    background: -webkit-linear-gradient(right, #cacaca, #888888);
}

.reg-content-body .login-btn:hover {
    box-shadow: 0 2px 4px 0 rgba(41, 41, 41, 0.678), 0 3px 10px 0 rgba(71, 71, 71, 0.596);
}

.reg-content-body .clr-btn:hover {
    box-shadow: 0 2px 4px 0 rgba(41, 41, 41, 0.678), 0 3px 10px 0 rgba(71, 71, 71, 0.596);
}

.login {
    padding-top: 60px;
    padding-left: 500px;
    padding-right: 500px;
    padding-bottom: 60px;
}

.login-content {
    width: 500px;
    height: 100%;
    border: 1px solid rgb(182, 182, 182);
    border-radius: 5px;
    font-size: 20px;
}

.login-content-title {
    padding-top: 30px;
    padding-left: 50px;
    padding-right: 50px;
    padding-bottom: 15px;
    font-family: 'Roboto Flex', sans-serif;
    font-size: 25px;
}

.login-content-body {
    padding-top: 5px;
    padding-left: 50px;
    padding-right: 50px;
    padding-bottom: 70px;
    font-family: 'Roboto Flex', sans-serif;
    font-size: 20px;
}

.login-content-body .login-input {
    margin-top: 10px;
    margin-bottom: 10px;
    width: 100%;
    height: 50px;
    border: 1px solid rgb(182, 182, 182);
    border-radius: 5px;
    font-size: 20px;
}

.login-content-body .login-btn {
    width: 100%;
    height: 50px;
    background: -webkit-linear-gradient(right, #56d8e4, #9f01ea);
    border: none;
    border-radius: 5px;
    color: white;
    transition: all 0.5s;
    margin-top: 15px;
}

.video-upload {
    padding-top: 60px;
    padding-left: 400px;
    padding-right: 400px;
    padding-bottom: 60px;
}

.video-upload-content {
    width: 800px;
    height: 100%;
    border: 1px solid rgb(182, 182, 182);
    border-radius: 5px;
    font-size: 20px;
}

.video-upload-content-title {
    padding-top: 30px;
    padding-left: 50px;
    padding-right: 50px;
    padding-bottom: 15px;
    font-family: 'Roboto Flex', sans-serif;
    font-size: 25px;
}

.video-upload-content-body .video-btn {
    width: 100%;
    height: 50px;
    background: -webkit-linear-gradient(right, #56d8e4, #9f01ea);
    border: none;
    border-radius: 5px;
    color: white;
    transition: all 0.5s;
    margin-top: 15px;
    margin-top: 20px;
}

.video-upload-content-body .video-btn:hover {
    background: -webkit-linear-gradient(right, #9f01ea, #56d8e4);
    box-shadow: 0 2px 4px 0 rgba(148, 148, 148, 0.678), 0 3px 10px 0 rgba(71, 71, 71, 0.596);
}

.video-upload-content-body {
    padding-top: 5px;
    padding-left: 50px;
    padding-right: 50px;
    padding-bottom: 70px;
    font-family: 'Roboto Flex', sans-serif;
    font-size: 20px;
}

.video-upload-content-body .video_input {
    margin-top: 10px;
    margin-bottom: 10px;
    width: 100%;
    height: 50px;
    border: 1px solid #d4d4d4;
    border-radius: 5px;
    font-size: 20px;
}

.video-upload-content-body .video-text_area {
    width: 700px;
    height: 100px;
    border: 1px solid #d4d4d4;
    resize: none;
    border-radius: 5px;
}

.title-video {
    background-color: rgb(194, 194, 194);
}


/* for standard laptop screen size 
        width : 1366px
        height : 768px

        in here I use media queries for laptop screen size
*/

@media only screen and (max-width: 1400px) {
    .home-content {
        padding: 50px;
    }
    video {
        width: 350px;
        height: 240px;
    }
    .reg {
        padding-top: 30px;
        padding-left: 400px;
        padding-right: 400px;
        padding-bottom: 30px;
    }
    .login {
        padding-top: 50px;
        padding-left: 400px;
        padding-right: 400px;
        padding-bottom: 30px;
    }
    .video-upload {
        padding-top: 60px;
        padding-left: 250px;
        padding-right: 250px;
        padding-bottom: 60px;
    }
}


/*
    iPad

for standard iPad screen size 
        width : 768px
        height : 1024px
       
*/

@media screen and (min-width: 712px) and (max-width: 1024px) {
    .home {
        height: 100%;
        width: 100%;
        background-color: rgba(238, 238, 238, 0.281);
    }
    .home-content {
        padding-left: 40px;
        padding-right: 20px;
    }
    video {
        width: 640px;
        height: 480px;
    }
    .reg {
        padding-top: 100px;
        padding-left: 140px;
        padding-right: 140px;
        padding-bottom: 30px;
    }
    .login {
        padding-top: 100px;
        padding-left: 140px;
        padding-right: 140px;
        padding-bottom: 30px;
    }
    .video-upload {
        padding-top: 60px;
        padding-left: 80px;
        padding-right: 80px;
        padding-bottom: 60px;
    }
    .video-upload-content {
        width: 600px;
        height: 100%;
        border: 1px solid rgb(182, 182, 182);
        border-radius: 5px;
        font-size: 20px;
    }
    .video-upload-content-body .video-text_area {
        width: 500px;
        height: 100px;
        border: 1px solid #d4d4d4;
        resize: none;
        border-radius: 5px;
    }
}


/*Samsung Galaxy A51/71 

/ under development
 for standard Samsung Galaxy A51/71 screen size 
        width : 412px
        height : 914px */

@media screen and (max-width: 412px) {
    .home {
        height: 100%;
        width: 100%;
        background-color: rgba(238, 238, 238, 0.281);
    }
    .home-content {
        padding-top: 15px;
        padding-left: 30px;
        padding-right: 30px;
    }
    .reg {
        padding-top: 100px;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 30px;
    }
    .reg-content {
        width: 320px;
        height: 100%;
        border: 1px solid rgb(182, 182, 182);
        border-radius: 5px;
        font-size: 20px;
    }
    .reg-content-body {
        padding-top: 5px;
        padding-left: 15px;
        padding-right: 15px;
        padding-bottom: 70px;
        font-family: 'Roboto Flex', sans-serif;
        font-size: 20px;
    }
    .reg-content-body .login-btn,
    .clr-btn {
        width: 47%;
        height: 50px;
        background: -webkit-linear-gradient(right, #56d8e4, #9f01ea);
        border: none;
        border-radius: 5px;
        color: white;
        transition: all 0.5s;
        margin-top: 15px;
    }
    .login {
        padding-top: 100px;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 30px;
    }
    .login-content {
        width: 320px;
        height: 100%;
        border: 1px solid rgb(182, 182, 182);
        border-radius: 5px;
        font-size: 20px;
    }
    .login-content-body {
        padding-top: 5px;
        padding-left: 15px;
        padding-right: 15px;
        padding-bottom: 70px;
        font-family: 'Roboto Flex', sans-serif;
        font-size: 20px;
    }
}
