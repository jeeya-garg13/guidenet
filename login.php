
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome To GuideNet</title>
    <link rel="stylesheet" href="style_sign-log.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <a href="home.php">
                <img src="logo.png" width="50px" height="50px"> GuideNet
            </a>
        </div>
        <!--<div class="icons"></div>-->
    </div>
    <div class="full-page">
        <div class="form-box">
            <div class="welcome"><h1>Welcome To GuideNet</h1></div>
            <div class='button-box'>
                <div class="log-btn"></div>
                    <button type='button' class='toggle-btn' onclick="location.href='signup.php'"> Sign Up </button>
                    <button type='button' class='toggle-btn'> Login </button>
            </div>

    <!--establishing connection-->
    <?php
    session_start();
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "guidenet";
    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    ?>

    
        <!--login----- onsubmit = "return openForm()"---->
    <?php
    if (isset($_REQUEST['id'])) {
        $id = stripslashes($_REQUEST['id']);
        $id = mysqli_real_escape_string($conn, $id);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);

        $query3 = "SELECT id FROM studentlogin WHERE id = '$id' ";
        $result3 = mysqli_query($conn, $query3);

        if (mysqli_num_rows($result3) > 0) {          // if id does exist in database
            $pwd = "SELECT password FROM `studentlogin` WHERE id = '$id' ";
            $result4 = mysqli_query($conn, $pwd);
            if(mysqli_num_rows($result4) > 0) {
                while($row = mysqli_fetch_array($result4)) {
                    if(password_verify($password, $row["password"])) {      // check password
                        $_SESSION["id"] = $id;
                        //header("location:newdashboard.php");
                        echo "<script>
                        sessionStorage.setItem('id', '$id'); 
                        window.location.href = 'newdashboard.php';
                        </script>";
                        exit;
                    }
                    else {      //incorrect password
                        echo "<center><h1>Incorrect Password</h1>
                            <br>Click here to <a href='login.php'>Login again</a></center>";
                    }
                }
            }
        }
        else {              // if id does not exist in database
            echo "<center><h1>Incorrect Username</h1>
                <br>Click here to <a href='login.php'>Login again</a></center>";
        }
    }

    else {
    ?>

    <form id='login' class='input-group-login' action="" method="POST">
        <input type='text'class='input-field' placeholder='Student ID' name="id" required >
        <input type='password'class='input-field' placeholder='Password' name="password" required>
        <br><a href="forgetpwd.php" class="forget">Forget Password?</a><br><br>
        <button type='submit'class='submit-btn' id='login-btn'>Log in</button>
    </form>
 
    <?php
    }
    ?>

</body>
</html>



