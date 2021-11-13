<?php 
session_start();

if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
    // echo "session not set or not logged in";
    header("location: index.php");
    exit;
}
?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/home.css">
    <title>Home Pharmc-Store</title>
</head>

<body>
    <?php require "partials/innernav.php" ?>

    <div class="main">
        <img class="bg-img" src="assets/medbg.jpeg">
        <div class="menu">
            <div class="row gx-0">
                <div class="col-md-3 menu-card">
                    <div class="card-img"><img class="menu-img" src="assets/admin.jpeg"></div>
                    <div class="card-btn"><button class="btn btn-primary"> <a href="manageadmin.php"
                                style="color:white; text-decoration:none;"> Manage
                                Admin</button> </a> </div>
                </div>
                <div class="col-md-3 menu-card">
                    <div class="card-img"><img class="menu-img" src="assets/medimg.jpeg"></div>
                    <div class="card-btn"><button class="btn btn-primary"> <a href="managemed.php"
                                style="color:white; text-decoration:none;"> Manage
                                Medicine</button> </a>
                    </div>
                </div>
                <div class="col-md-3 menu-card">
                    <div class="card-img"><img class="menu-img" src="assets/company1.jpeg"></div>
                    <div class="card-btn"><button class="btn btn-primary"> <a href="managecomp.php"
                                style="color:white; text-decoration:none;"> Manage
                                Company</button> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>