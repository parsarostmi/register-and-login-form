<?php

// set variables 
$username = $email = $password = '';
$connect = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'user');
$select_user = " SELECT username FROM signup WHERE username = '$username' ";
$select_email = " SELECT email FROM signup WHERE email = '$email' ";
$checking_user = mysqli_query($connect, $select_user);
$checking_email = mysqli_query($connect, $select_email);
$error = array();


if (isset($_POST['btn'])) {


    $username = ($_POST['username']);
    $password = ($_POST['password']);
    $email = ($_POST['email']);



    // checking empty and duplicate data 
    if (empty($username)) {
        $error['u'] = " username is required ";
    } elseif (mysqli_num_rows($checking_user) > 0) {
        $error['u'] = " username exist ";
    } else {
        $error['u'] = " ";
    }

    if (empty($email)) {
        $error['e'] = " email is required ";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['e'] = " email is not valid ";
    } elseif (mysqli_num_rows($checking_email) > 0) {
        $error['e'] = " email exist ";
    } else {
        $error['e'] = " ";
    }

    if (empty($password)) {
        $error['p'] = " password is required ";
    } elseif (strlen($password) < 8) {
        $error['p'] = " password must be at least 8 characters  ";
    } else {
        $error['p'] = "";
    }


    if (count($error) == 0) {
        echo " success ";
        $add = " INSERT INTO signup(username,password,email) VALUES ('$username' , '$password' , '$email')";
        $run = mysqli_query($connect, $add);
        header("location:login.php");

    }




}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .error {}
    </style>
</head>

<body>
    <div class="login-page">
        <div class="form">
            <form class="register-form" method="post">
                <input type="text" name="username" placeholder="username"
                    value="<?php echo htmlspecialchars($username); ?>" />
                <?php if (isset($_POST['btn']) && $error == true) {
                    echo '<p class="signup-errors"> ' . $error['u'] . ' </p>';
                } ?> <br>
                <input type="password" name="password" placeholder="password"
                    value="<?php echo htmlspecialchars($password); ?>" />
                <?php if (isset($_POST['btn']) && $error == true) {
                    echo '<p class="signup-errors"> ' . $error['p'] . ' </p>';
                } ?> <br>
                <input type=" email" name="email" placeholder="email" value="<?php echo htmlspecialchars($email); ?>" />
                <?php if (isset($_POST['btn']) && $error == true) {
                    echo '<p class="signup-errors"> ' . $error['e'] . ' </p>';
                } ?> <br>
                <button name=" btn">create</button>
                <p class="message">Already registered? <a href="login.php">Sign In</a></p>
            </form>
        </div>
    </div>
</body>

</html>