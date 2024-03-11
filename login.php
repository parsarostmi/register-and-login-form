<?php
$username = $password = '';
$error = array();

if (isset($_POST['btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $connect = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'user');
    $sql = " SELECT * FROM signup WHERE username = '$username' and password = '$password' ";
    $run = mysqli_query($connect, $sql);

    if (empty($username) || empty($password)) {
        $error = " complete the all fields ";
    } elseif (!$run->num_rows == 1) {
        $error = " user name or password not found ";

    } else {
        session_start();
        echo '<script> alert(" welcome to panel ") </script>';
    }

    /*
        if ($run->num_rows == 1) {
            session_start();
            echo '<script> alert(" welcome to panel ") </script>';
     */



}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body>
    <div class="login-page">
        <div class="form">
            <form class="login-form" method="post">
                <input type="text" placeholder="username" name="username"
                    value="<?php echo htmlspecialchars($username); ?>" />
                <input type="password" placeholder="password" name="password"
                    value="<?php echo htmlspecialchars($password); ?>" />
                <?php if (isset($_POST['btn']) && $error == true) {
                    echo '<p class="login-errors">' . $error . '</p>';
                } ?>
                <button name="btn">login</button>
                <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
            </form>
        </div>
    </div>

</body>

</html>