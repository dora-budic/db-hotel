<?php
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "db_hotel";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn && $conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
  }

  header('Content-Type: application/json');

  if (!empty($_GET) && $_GET['id']) {
    $id = $_GET['id'];
    $filteredData = [];

    $stmt = $conn->prepare("SELECT * FROM stanze WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
      $filteredData[] = $row;
    }

    echo json_encode($filteredData);
  } else {
    $sql = "SELECT * FROM stanze";
    $result = $conn->query($sql);

    $allData = [];

    if ($result && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $allData[] = $row;
      }
    }

    echo json_encode($allData);
  }

  $conn->close();
?>
