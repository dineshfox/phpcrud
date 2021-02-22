<?php

include "dbconnection.php";

// sql to create table
// $sql = "CREATE TABLE users (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     firstname VARCHAR(30) NOT NULL,
//     lastname VARCHAR(30) NOT NULL,
//     email VARCHAR(50),
//     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//     )";
    
//     if ($conn->query($sql) === TRUE) {
//       echo "Table MyGuests created successfully";
//     } else {
//       echo "Error creating table: " . $conn->error;
//     }
    
// $conn->close();

// $sql = "INSERT INTO users (firstname, lastname, email)
// VALUES ('dinesh', 'lewis', 'dinesh@example.com')";

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();


// sql to delete a record
// $sql = "DELETE FROM users WHERE id=2";

// if ($conn->query($sql) === TRUE) {
//   echo "Record deleted successfully";
// } else {
//   echo "Error deleting record: " . $conn->error;
// }

// $conn->close();

// $sql = "UPDATE users SET lastname='dinesh' WHERE id=1";

// if ($conn->query($sql) === TRUE) {
//   echo "Record updated successfully";
// } else {
//   echo "Error updating record: " . $conn->error;
// }


if(isset($_POST['insert'])){
    $message= "The insert function is called.";
    echo $message;
}
if(isset($_POST['select'])){
    $message="The select function is called.";
    echo $message;
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
    

    <?php
        echo "<div class="."container".">";
        echo "<h4 class="."text-center".">User Information </h4>";
        echo "<br>";    


        $action = isset($_GET['action']) ? $_GET['action'] : "";
 
        // if it was redirected from delete.php
        if($action=='deleted'){
            echo "<div class='alert alert-success'>Record was deleted.</div>";
        }


        echo "<table class="."table table-Light".">";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope="."col".">Number</th>";
        echo "<th scope="."col".">ID</th>";
        echo "<th scope="."col".">First Name</th>";
        echo "<th scope="."col".">Last Name</th>";
        echo "<th scope="."col".">Email</th>";
        echo "<th scope="."col".">Date and Time</th>";
        echo "<th scope="."col".">Actions</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

    $sql = "SELECT id, firstname, lastname, email, reg_date FROM users ORDER BY id";
    $result = $conn->query($sql);

    $rownumber=0;
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { 
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";


        $rownumber+=1;
        echo "<tr>";
        echo "<th scope="."row".">".$rownumber."</th>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["firstname"]."</td>";
        echo "<td>".$row["lastname"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["reg_date"]."</td>";
        echo "<td>";
        echo "<a href='read.php?id=".$row["id"]."' class='btn btn-info m-r-1em'>Read</a>";
        echo "<a href='#' class='btn btn-primary m-r-1em'>Edit</a>";
        echo "<a href='#' onclick='delete_user({$row["id"]});' class='btn btn-danger m-r-1em'>Delete</a>";
        echo "</td>";
  
        echo "</tr>";

        }

    } else {
    echo "0 results";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    $conn->close();

    ?>

    <form  method="post">
        <input type="submit" name="insert" value="insert">
        <input type="submit" name="select" value="select" >
    </form>


    <div class="container">
        <a href='add.php' class='btn btn-info'>Add New User</a>
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

<script type='text/javascript'>
// confirm record deletion
function delete_user( id ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    } 
}
</script>