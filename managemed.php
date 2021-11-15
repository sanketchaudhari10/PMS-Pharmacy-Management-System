<?php

session_start();
require "config.php";

$added = false;
$updated = false;
$delete = false;
$error = "";
$berror = false;

 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 if (isset( $_POST['snoEdit'])){
   // Update the record
    //  $sno = $_POST["medidEdit"];
     // echo "sno = ".$sno;
     $name = $_POST["mednameEdit"];
     $price = $_POST["medpriceEdit"];
     $quantity = $_POST["medquantityEdit"];
     $company = $_POST["companyEdit"];
     $exp = $_POST["yrexpEdit"];
     $mfg = $_POST["yrpEdit"];

    //  if($company == "sunpharma"){
    //      $company = 1;
    //  }elseif($company == "cipla"){
    //      $company = 2;
    //  }else{
    //      $company = 3;
    //  }

//   // Sql query to be executed
     $sql = "UPDATE `medicine` SET  `company` = '$company', `exp` = '$exp', `mfg` = '$mfg', `price` = '$price', `quantity` = '$quantity' WHERE `medicine`.`mname` = '$name'";

 //   $sql = "UPDATE `medicine` SET `name` = '$name' , `price` = '$price',quantity = '$quantity', cmp_id = 'company',exp = '$exp', mfg = '$mfg' WHERE `medicine`.`med_id` = $sno";
   $result = mysqli_query($conn, $sql);
   if($result){
         $updated = true;
     }
     else{
         echo "We could not update the record successfully</br>";
         echo $sno . "</br>";
     // echo $company;
     }
 } 
 if(isset($_POST['medname']) ){
     $name = $_POST['medname'];
     $price= $_POST['medprice'];
     $quantity = $_POST['medquantity'];
     $company =$_POST['company'] ;
     $yrp =$_POST['yrp'];
     $yrexp = $_POST['yrexp'];

     $query = "INSERT INTO `medicine` (`mname`, `price`, `quantity`, `mfg`, `exp`, `company`) VALUES ('$name', '$price', '$quantity', '$yrp', '$yrexp', '$company');";
     $result = mysqli_query($conn, $query);
     if($result){ 
       $added = true;
   }
   else{
    //    echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
    $berror = true;
    $error = "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
   } 

 }

 }
 if(isset($_GET['delete'])){
   $sno = $_GET['delete'];
   $delete = true;
   $sql = "DELETE FROM `medicine` WHERE `medicine`.`mname` = '$sno'";
   $result = mysqli_query($conn, $sql);
  
 }

if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
    // echo "session not set or not logged in";
    header("location: index.php");
    exit;
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/managemed.css">
    <title>Manage Medicine Pharma-Store</title>
</head>

<body>
    <!-- Edit -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
        Launch demo modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="managemed.php" class="userinputmodal" id="userinputmodal">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <h4 class="text-center mb-4">Update Medicine</h4>
                        <div class="row">
                            <!-- <div class="mb-2 col">
                                <label for="medidEdit" class="form-label">Name</label>
                                <input type="text" class="form-control" id="medidEdit" name="medidEdit">
                            </div> -->
                            <div class="mb-2 col">
                                <label for="mednameEdit" class="form-label">Name</label>
                                <input type="text" class="form-control" id="mednameEdit" name="mednameEdit" readonly>
                            </div>
                            <div class="mb-2 col">
                                <label for="medquantityEdit" class="form-label">Quantity</label>
                                <input type="text" class="form-control" id="medquantityEdit" name="medquantityEdit">
                            </div>
                            <div class="mb-2 col">
                                <label for="medpriceEdit" class="form-label">Price </label>
                                <input type="text" class="form-control" id="medpriceEdit" name="medpriceEdit">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-2 col">
                                <label for="yrpEdit" class="form-label">Year of Packaging</label>
                                <input type="text" class="form-control" id="yrpEdit" name="yrpEdit">
                            </div>
                            <div class="mb-2 col">
                                <label for="yrexpEdit" class="form-label">Year of Expiry</label>
                                <input type="text" class="form-control" id="yrexpEdit" name="yrexpEdit">
                            </div>
                            <div class="mb-2 col">
                                <label for="CompanyEdit" class="form-label">Company</label>
                                <!-- <input type="text" class="form-control" name="Company"> -->
                                <select class="form-select" id="companyEdit" name="companyEdit">
                                    <option selected>Select Company</option>
                                    <?php 

                         $query = "SELECT cname FROM company";
                         $result = mysqli_query($conn,$query);

                         while($row = mysqli_fetch_array (    $result)){   
                             echo "<option value = '$row[cname]'>$row[cname]</option>";
                         }
                        
                        ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    <?php 
        require "partials/innernav.php" ;
        if($added){
            echo '<div class="alert alert-success alert-dismissible fade show px-2 py-1" role="alert">
                    <strong>Success!</strong> Medicine has been added successfully
                    <button type="button" class="close px-2 py-1 pull-right" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
            // header("location:managemed.php");
        }
    ?>
    <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Medicine has been deleted successfully
    <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }

  if($updated){
            echo '<div class="alert alert-success alert-dismissible fade show px-2 py-1" role="alert">
                    <strong>Success!</strong> Medicine has been updated successfully
                    <button type="button" class="close px-2 py-1 pull-right" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
            // header("location:managemed.php");
        }
    if($berror){
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Failed!</strong>" .$error.
    "<button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
        
  ?>



    <!-- page -->
    <div class="container1">

        <div class="my-5 mx-auto">

            <form method="POST" action="managemed.php" class="userinput" id="userinput">
                <h4 class="text-center mb-4">Add new Medicine</h4>
                <div class="row">
                    <div class="mb-2 col">
                        <label for="medname" class="form-label">Name</label>
                        <input type="text" class="form-control" name="medname">
                    </div>
                    <div class="mb-2 col">
                        <label for="medquantity" class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="medquantity">
                    </div>
                    <div class="mb-2 col">
                        <label for="medprice" class="form-label">Price </label>
                        <input type="text" class="form-control" name="medprice">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2 col">
                        <label for="yrp" class="form-label">Year of Packaging</label>
                        <input type="text" class="form-control" name="yrp">
                    </div>
                    <div class="mb-2 col">
                        <label for="yrexp" class="form-label">Year of Expiry</label>
                        <input type="text" class="form-control" name="yrexp">
                    </div>
                    <div class="mb-2 col">
                        <label for="Company" class="form-label">Company</label>
                        <!-- <input type="text" class="form-control" name="Company"> -->
                        <select class="form-select" name="company" required>
                            <option selected>Select Company</option>
                            <?php 

                            $query = "SELECT cname FROM company";
                            $result = mysqli_query($conn,$query);

                            while($row = mysqli_fetch_array (    $result)){   
                                echo "<option value = '$row[cname]'>$row[cname]</option>";
                            }
                        
                        ?>

                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary execute" name="medadd">ADD</button>
            </form>
        </div>

        <div class="allrecords">
            <h3>List of Medicines:</h3>
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">S. no</th>

                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Mfg year</th>
                        <th scope="col">Exp year</th>
                        <th scope="col">Company</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                            $query = "SELECT * FROM medicine";
                            $result = mysqli_query($conn,$query);
                            $sno = 0;
                            while($row = mysqli_fetch_array (    $result)){ 
                                $sno = $sno+1;  
                                echo "<tr scope = 'row'> 
                                <td>$sno</td> 
                                <td class = 'text-capitalize'>$row[mname]</td> 
                                
                                <td>$row[price]</td> 
                                <td>$row[quantity]</td> 
                                <td>$row[mfg]</td> 
                                <td>$row[exp]</td> 
                                <td class = 'text-capitalize'>$row[company]</td> 
                                 <td> 
                                <button class='edit btn btn-sm btn-primary' id=".$row['mname'].">Edit
                                 </button>
                                 <button class='delete btn btn-sm btn-danger' id=d".$row['mname'].">Delete</button>  </td></tr>";
                            }
                        
                        ?>
                </tbody>
            </table>
            <hr>

        </div>
    </div>

    <?php 
        $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"> </script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            // console.log(" ");
            ename = e.target.id;
            // console.log(e.target);
            // console.log(e.target.parentNode.parentNode);
            // console.log(snoEdit);
            tr = e.target.parentNode.parentNode;
            // ename = tr.getElementsByTagName("td")[2].innerText;
            console.log(ename);
            eprice = tr.getElementsByTagName("td")[2].innerText;
            equantity = tr.getElementsByTagName("td")[3].innerText;
            emfg = tr.getElementsByTagName("td")[4].innerText;
            eexp = tr.getElementsByTagName("td")[5].innerText;
            ecompany = tr.getElementsByTagName("td")[6].innerText;

            companyEdit.value = ecompany;
            yrexpEdit.value = eexp;
            yrpEdit.value = emfg;
            medpriceEdit.value = eprice;
            medquantityEdit.value = equantity;
            mednameEdit.value = ename;
            // medidEdit.value = snoEdit;
            $('#editModal').modal('toggle');
        })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            // console.log(" ");
            sno = e.target.id.substr(1);
            // console.log(e.target);
            // console.log(sno);

            if (confirm("Are you sure you want to delete this record?")) {
                console.log("yes");
                window.location = `managemed.php?delete=${sno}`;

            } else {
                console.log("no");
            }
        })
    })
    </script>


</body>

</html>