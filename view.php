<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>User Detail</h1>

<table id="customers">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>



  <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Bank-management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    // echo "<tr>";
    // echo "<td>".$row["id"]."</td>";
    // echo "<td>".$row["name"]."</td>";
    // echo "<td>".$row["email"]."</td>";
    // echo "<td><button>Edit</button></td>";
    // echo '<td><a href="delete.php?id='.$row['id'].'"><button>Delete</button></a></td>';
 
    // echo "</tr>";

    ?>

      <tr>
      <td><?php echo $row["id"] ?></td>
      <td><?php echo $row["name"] ?></td>
      <td><?php echo $row["email"] ?></td>
      <td><a href="edit.php"><button>Delete</button></a></td>
      <td><a href="delete.php?id=<?php echo $row["id"] ?>"><button>Delete</button></a></td>
     
      </tr>
    <?php




    //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["email"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();

?>

 
 
</table>

</body>
</html>