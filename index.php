<?php


$login = false;
$showmodal = false;
// session_start();
// $_SESSION['username'] = '';
if($_SERVER["REQUEST_METHOD"]=="POST"){

  require 'config.php';
  // $_SESSION['username'] = $_POST["username"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  
  $sql ="SELECT `username`, `password` FROM `admin` WHERE username='$username' AND password= '$password'";
  
  $result = mysqli_query($conn,$sql);
  $num = mysqli_num_rows($result);
  
  if($num == 1){
    $row=mysqli_fetch_assoc($result);
    echo "loggedin in php script";
    $login = true;
    session_start();
    $_SESSION['loggedin'] = true;
        // $_SESSION['username'] = $row['username'];
     $_SESSION['username'] = $username;
    header("location: home.php");
  }else{
    $showmodal = true;
     echo $num;
     echo "<br/> invalid credentials";
     exit();
    
  }
  
  // if(!$result){
  //   echo "some error";
  // }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login Pharmc-Store</title>
</head>

<body>
    <img src="assets/med2.jpg" class="bg" alt="bg">
    <?php require 'partials/navbar.php';
     
    //   if($login){
    //    echo "you are logged in";
    //  }else{
    //    echo "cant login";
    //    echo   $username ;
    //   }
    
    
    
     ?>


    <form action="index.php" method="post" class="form">


        <div class="alert alert-info" role="alert">
            <h4>Pharmacy Management System</h4>
        </div>
        <div class="container">

            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button class="submit" type="submit">Login</button>

        </div>


    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>