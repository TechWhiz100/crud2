<?php

@include 'config.php';


if(isset($_POST['register'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $department = $_POST['department'];


    if(empty($firstname) || empty($lastname) || empty($department)){
      $message[] = 'please fill out all';
   }else{
    $sql="insert into crud3(firstname, lastname, department)
        values('$firstname', '$lastname', '$department')";
        $result=mysqli_query($conn,$sql);
        if($result){
            $message[] =  "Data inserted successfully";
            // header("location:display.php");
        }else{
            $message[] = "failed to insert";
        }
    }
    };



 if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM crud3 WHERE id = $id");
   header('location:main.php');
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Txt CRUD operation</title>
    
    <!-- Copy cdn on bootstrap site and paste it here for bootstrap linkage -->

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->
   <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">
    


</head>
<body>

    <?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
    <h2 class="text-center">PERFORMING CRUD OPERATION ON TXT FILE USING PHP</h2>

    <!--<span id="display"></span>-->
<div class="cotainer">
    <div class="row">
        <div class="col-lg-6">
            <form action="" method="post">
               <table  class="table  table-striped table-bordered table-hover">
                    <tr>
                        <td><i class="fa fa-user">Firstname</i></td>
                        <td><input type="text" class="form-control" name="firstname"></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-key">Lastname</i></td>
                        <td><input type="text" class="form-control" name="lastname"></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-cloud-upload">Deparment<i/></td>
                        <td><input type="text" class="form-control" name="department"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="register" class="btn btn-success" value="register"></td>
                    </tr>
                </table>
            </form>
        </div>


        <div class="col-lg-6">
            <!-- width="60%" border="1" cellpadding="0" cellspacing="0"  -->


   <?php

   $select = mysqli_query($conn, "SELECT * FROM crud3");
   
   ?>


            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td>S/N</td>
                    <td>Firstname</td>
                    <td>Lastname</td>
                    <td>Department</td>
                    <td>Action</td>
                </tr>

        <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td>
               <a href="main.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger"> <i class="fas fa-trash"></i> Delete </a>
            </td>
         </tr>
      <?php } ?>

            </table>
        </div>

    </div>
</div>







    
</body>
</html>