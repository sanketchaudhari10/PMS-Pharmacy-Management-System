<?php 

session_start();
require "config.php";

$change = false;
$error= false;
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
    // echo "session not set or not logged in";
    header("location: index.php");
    exit;
}
// echo $_SESSION['username'];
// echo "welcome in welcome" 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['newPass']) ){
    $newp = $_POST['newPass'];
    $newcon = $_POST['newPassConfirm'];

    if($newp == $newcon){
       
        $uname = $_SESSION['username'];
        $query = "UPDATE `admin` SET `password` = '$newp' WHERE `admin`.`username` = '$uname'";
        $result = mysqli_query($conn, $query);
        if($result){
             $change = true;
        }

    }else{
        $error = true;
    }
}

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/innernav.css">
    <title>Reset Password Pharmac-Store</title>
</head>

<body>

    <?php
        require "partials/innernav.php";
 
 
        if($change){
            echo '<div class="alert alert-success alert-dismissible fade show px-2 py-1" role="alert">
                    <strong>Success!</strong> Password changed successfully
                    <button type="button" class="close px-2 py-1 pull-right" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
    
        }
        if($error){
            echo '<div class="alert alert-danger alert-dismissible fade show px-2 py-1" role="alert">
                    <strong>Failed!</strong>Password could not be changed, confirm both entered passwords are same
                    <button type="button" class="close px-2 py-1 pull-right" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
        }

?>

    <div class="container">
        <section class="mx-auto my-5 text-center w-50 px-5" style="background-color:#fcffa4;">

            <h3 class="py-3">Set a new password for <span
                    class="text-success text-capitalize font-weight-bold fs-2"><?php echo $_SESSION['username'];?></span>
            </h3>

            <form action="manageadmin.php" method="POST" class="px-5 py-3">

                <div class="md-form md-outline my-3">
                    <input type="text" id="newPass" class="form-control" name="newPass" required>
                    <label data-error="wrong" data-success="right" for="newPass">New password</label>
                </div>

                <div class="md-form md-outline mt-3 mb-4">
                    <input type="password" id="newPassConfirm" class="form-control" name="newPassConfirm" required>
                    <label data-error="wrong" data-success="right" for="newPassConfirm">Confirm password</label>
                </div>

                <button type="submit" class="btn btn-danger mb-4">Change password</button>

            </form>



        </section>
    </div>


    <?php
         $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>