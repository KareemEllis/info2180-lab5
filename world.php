<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// $stmt = $conn->query("SELECT * FROM countries");
// $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

function displayTable($results){
  echo(
    "<table>".
      "<tr>".
        "<th>Name</th> <th>Continent</th> <th>Independence</th> <th>Head of State</th>"
  );
  
  foreach ($results as $row){
    echo "<tr>";
    echo "<td>".$row['name']."</td>" . "<td>".$row['continent']."</td>" . "<td>".$row['independence_year']."</td>" . "<td>".$row['head_of_state']."</td>";
    echo "</tr>";
  }
  
  echo(
      "</tr>".
    "</table>"
  );
}


if($_SERVER['REQUEST_METHOD'] == 'GET'){

  $userInput = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING);

  if(empty($userInput)){
    //IF INPUT IS EMPTY THEN SEARCH FOR ALL COUNTRIES
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $stmt = $conn->query("SELECT * FROM countries");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    displayTable($results);
  }

  else{
    //SEARCH FOR ENTERED COUNTRY
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :userInput");
    $stmt->bindValue(':userInput', "%$userInput%", PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    displayTable($results);

  }

}


// echo "<ul>";
// foreach ($results as $row){
//   echo "<li>".$row['name'] . ' is ruled by ' . $row['head_of_state']. "</li>";
// }
// echo "</ul>";

?>
