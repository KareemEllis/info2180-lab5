<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
// $stmt = $conn->query("SELECT * FROM countries");
// $results = $stmt->fetchAll(PDO::FETCH_ASSOC);




if($_SERVER['REQUEST_METHOD'] == 'GET'){

  $userInput = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING);

  if(empty($userInput)){
    //IF INPUT IS EMPTY THEN SEARCH FOR ALL COUNTRIES
    $stmt = $conn->query("SELECT * FROM countries");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<ul>";
    foreach ($results as $row){
      echo "<li>".$row['name'] . ' is ruled by ' . $row['head_of_state']. "</li>";
    }
    echo "</ul>";
  }

  else{
    //SEARCH FOR ENTERED COUNTRY
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE '%:userInput%'");
    $stmt->bindParam(':userInput', $userInput, PDO::PARAM_STR);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row){
      echo "<li>".$row['name'] . ' is ruled by ' . $row['head_of_state']. "</li>";
    }

    //NEXT TO DO:
    //MAKE IT SO THAT IF A COUNTRY IS NOT FOUND, WE PRINT OUT A MESSAGE INDICATING SO
  }

}


// echo "<ul>";
// foreach ($results as $row){
//   echo "<li>".$row['name'] . ' is ruled by ' . $row['head_of_state']. "</li>";
// }
// echo "</ul>";

?>
