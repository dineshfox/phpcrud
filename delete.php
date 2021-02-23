<?php
// include database connection
include "dbconnection.php";
 
try {
     
    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
    // delete query
    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
    //   echo "Record deleted successfully";
      header('Location: index.php?action=deleted');

      
    } else {
      echo "Error deleting record: " . $conn->error;
    }  
}
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

echo "<a href='index.php' class='btn btn-info m-r-1em'>View Data</a>";

?>