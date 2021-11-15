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
     <title>Document</title>
 </head>

 <body>


     <header>
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
             <div class="container-fluid">
                 <span class="navbar-brand" style="color:green; font-size:1.6em; font-weight:400; ">Pharmac-store</span>

                 </button>
                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-1">
                         <li class="nav-item">
                             <a class="nav-link active " aria-current="page" href="home.php">Home</a>
                         </li>
                         <!-- <li class="nav-item">
          <a class="nav-link" href="index.php">login</a>
        </li> -->
                         <!-- <li class="nav-item">
          <a class="nav-link" href="logout.php">logout</a>
        </li> -->
                     </ul>
                     <form class="d-flex">
                         <span class="fs-5 text-success text-capitalize mx-3 my-auto"
                             style="color:green;  font-weight:400;">Welcome,
                             <?php echo $_SESSION['username'] ?></span>
                         <ul class=" me-auto mb-2 mb-lg-0 list-unstyled ">
                             <li class=" nav-item ">
                                 <a class=" nav-link text-danger" href="logout.php">logout <i
                                         class="fas fa-power-off mx-auto"></i></a>

                             </li>
                         </ul>
                         <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button> -->
                     </form>
                 </div>
             </div>
         </nav>
     </header>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
     </script>
 </body>

 </html>