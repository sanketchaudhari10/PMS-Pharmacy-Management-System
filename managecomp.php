<?php 
session_start();
require "config.php";
$sno = 0;

$added = false;
$updated = false;
$delete = false;
$berror = false;
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    // $sno = $_POST["idEdit"];
    // echo "sno = ".$sno;
    $name = $_POST["compnameEdit"];
    $contact = $_POST["contactEdit"];
    $city = $_POST["cityEdit"];
    // $quantity = $_POST["medquantityEdit"];
    // $company = $_POST["companyEdit"];
    // $exp = $_POST["yrexpEdit"];
    // $mfg = $_POST["yrpEdit"];

    
  // Sql query to be executed
    $sql = "UPDATE `company` SET  `contact` = '$contact', `city` = '$city' WHERE `company`.`cname` = '$name'";
   
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
if(isset($_POST['compname']) ){
    $name = $_POST['compname'];
    $contact= $_POST['contact'];
    $city = $_POST['city'];
    // $company =$_POST['company'] ;
    // $yrp =$_POST['yrp'];
    // $yrexp = $_POST['yrexp'];

    $query = "insert into company(`cname`, `contact`,  `city`) values('$name','$contact','$city')";
    $result = mysqli_query($conn, $query);
    if($result){ 
      $added = true;
  }
  else{
    //   echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
    $berror = true;
    $error = "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 

}

}


if(isset($_GET['delete'])){
  $name = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `company` WHERE `company`.`cname` = '$name'";
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
    <link rel="stylesheet" href="css/managemed.css">
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <title>Manage Company Pharmac-Store</title>
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
                    <h5 class="modal-title" id="editModalLabel">Edit </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="managecomp.php" class="userinput" id="userinput">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <h4 class="text-center mb-4">Add new Company</h4>
                        <div class="row">
                            <div class="mb-2 col">
                                <label for="compnameEdit" class="form-label">Name</label>
                                <input type="text" class="form-control" name="compnameEdit" id="compnameEdit" readonly>
                            </div>

                            <div class="row">
                                <div class="mb-2 col">
                                    <label for="contactEdit" class="form-label">Contact</label>
                                    <input type="text" class="form-control" name="contactEdit" id="contactEdit">
                                </div>



                                <div class="mb-2 col">
                                    <label for="cityEdit" class="form-label">City</label>
                                    <input type="text" class="form-control" name="cityEdit" id="cityEdit">
                                </div>

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
                    <strong>Success!</strong> Company has been added successfully
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
    <strong>Success!</strong> Company has been deleted successfully
    <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  if($updated){
            echo '<div class="alert alert-success alert-dismissible fade show px-2 py-1" role="alert">
                    <strong>Success!</strong> Company has been updated successfully
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

    <div class="container1">

        <div class="my-5 mx-auto ">

            <form method="POST" action="managecomp.php" class="userinput" id="userinput">
                <h4 class="text-center mb-4">Add new Company</h4>
                <div class="row">
                    <div class="mb-2 col">
                        <label for="compname" class="form-label">Name</label>
                        <input type="text" class="form-control" name="compname" id="compname">
                    </div>

                    <div class="row">
                        <div class="mb-2 col">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" class="form-control" name="contact" id="contact">
                        </div>



                        <div class="mb-2 col">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" id="city">
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary execute" name="medcomp">ADD</button>
            </form>
        </div>


        <div class="allrecords w-100 my-5">
            <!-- <div class="allrecords w-100 my-5"> -->
            <h3>List of Companies:</h3>
            <table class=" table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">S. no</th>
                        <th scope="col">Company</th>
                        <th scope="col">Contact</th>
                        <th scope="col">City</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                            $query = "SELECT * FROM company";
                            $result = mysqli_query($conn,$query);
                            $sno = 0;
                            while($row = mysqli_fetch_array (    $result)){ 
                                $sno = $sno+1;  
                                echo "<tr scope = 'row'> 
                                <td>$sno</td> 
                                <td class = 'text-capitalize'>$row[cname]</td> 
                                <td>$row[contact]</td> 
                                <td class = 'text-capitalize'>$row[city]</td> 
                                 
                                 <td> 
                                <button class='edit btn btn-sm btn-primary' id=".$row['cname'].">Edit
                                 </button>
                                 <button class='delete btn btn-sm btn-danger' id=d".$row['cname'].">Delete</button>  </td></tr>";
                            }
                        
                        ?>
                </tbody>
            </table>
            <hr>

            <!-- </div> -->
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
            snoEdit = e.target.id;
            // console.log(e.target);
            // console.log(e.target.parentNode.parentNode);
            // console.log(snoEdit);
            tr = e.target.parentNode.parentNode;
            ename = tr.getElementsByTagName("td")[1].innerText;

            econtact = tr.getElementsByTagName("td")[2].innerText;
            ecity = tr.getElementsByTagName("td")[3].innerText;
            // emfg = tr.getElementsByTagName("td")[5].innerText;
            // eexp = tr.getElementsByTagName("td")[6].innerText;
            // ecompany = tr.getElementsByTagName("td")[7].innerText;

            console.log(ename, econtact, ecity);
            compnameEdit.value = ename;
            // console.log(compnameEdit);
            contactEdit.value = econtact;
            cityEdit.value = ecity;
            // medpriceEdit.value = eprice;
            // medquantityEdit.value = equantity;
            // mednameEdit.value = ename;
            // medidEdit.value = snoEdit;
            $('#editModal').modal('toggle');
        })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            // console.log(" ");
            sno = e.target.id.substr(1);
            console.log(e.target);
            console.log(sno);

            if (confirm(
                    " Deleting this will remove all medicines supplied by this company. Are you sure you want to delete this record?"
                )) {
                console.log("yes");
                window.location = `managecomp.php?delete=${sno}`;

            } else {
                console.log("no");
            }
        })
    })
    </script>
</body>

</html>