<?php
// include database connection
include "dbconnection.php";
 
try {
     
    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
    // delete query
    $sql = "SELECT id, firstname, lastname, email FROM users WHERE id= $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) { 
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        $fname = $row["firstname"];
        $lname = $row["lastname"];
        $email = $row["email"];
      }
    } else {
      echo "0 results";
    }

}

// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

if (isset($_POST['update'])){
    $fname =  $_POST["fname"];
    $lname =  $_POST["lname"];
    $email =  $_POST["email"];

    $sql = "UPDATE users
    SET firstname = '$fname', lastname = '$lname' , email = '$email' 
    WHERE id=$id ";

    if ($conn->query($sql) === TRUE) {
      echo "Update record successfully"."<br>";
      header('Location: index.php?action=updated');
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>User Details</title>
  </head>
  <body>
    

    <div class="container">
        <br>
        <h4 class="text-center">Update User Information </h4>
        <br>
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">First  Name</label>
                <input type="text" name="fname" value="<?php echo $fname; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="fname" placeholder="<?php echo $fname; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Last Name</label>
                <input type="text" name="lname" value="<?php echo $lname; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="lname" placeholder="<?php echo $lname; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="email" placeholder="<?php echo $email; ?>">
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href='index.php' class='btn btn-secondary'>Go Back</a>
        </form> 
        <p></p>
        

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>
