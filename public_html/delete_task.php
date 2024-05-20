<?php

include("db.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM task WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Eliminaste bien sos buenisimo eliminando, espero que haya sido tuyo si no fuiste que quede en tu conciencia';
  $_SESSION['message_type'] = 'success';
  header('Location: index2.php');
}

?>
