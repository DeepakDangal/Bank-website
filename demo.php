<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <link rel="stylesheet" href="account_style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" href="#">Sneha Bank</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="homepage.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact-form">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Signupform.php">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">LogOut</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" >
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form>
      </div>
    </nav>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "CSD223_";

    // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }

        $balance=0;

        $sql = "SELECT balance FROM account WHERE user_id='".$_SESSION['user_id']."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $balance=$row['balance'];
        }
        } else {
             $balance=0;
        }

        //echo $balance;





        if(isset($_POST['withdraw']))
        {

            $balance=$balance-$_POST['amount'];

           // $sql = "INSERT INTO accounts ( withdraw, balance) VALUES ('".$_POST['amount']."','".$balance."')";

           $sql="INSERT INTO `account`( `withdraw`, `balance`,`user_id`) VALUES ('".$_POST['amount']."','".$balance."','".$_SESSION['user_id']."')";

            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
                } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            
        }

        if(isset($_POST['deposit']))
        {

            $balance=$balance+$_POST['amount'];

           // $sql = "INSERT INTO accounts ( withdraw, balance) VALUES ('".$_POST['amount']."','".$balance."')";

           $sql="INSERT INTO `account`( `deposit`, `balance`,`user_id`) VALUES ('".$_POST['amount']."','".$balance."','".$_SESSION['user_id']."')";

          // echo $sql;
           
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
                } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            
        }


        

        

       



    ?>
    <div class="account-details-container">
        <div class="header">
            <h1> Account Details</h1>
        </div>
        <div class="details">
          
            <div class="balance">
                <p><strong>Account Balance:</strong> $</p>
                <p><strong>Available Balance:</strong> $</p>
            </div>
            <hr>
            <form method="post" action="">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount" required>
                <button type="submit" name="deposit" class="dpt" >Deposit</button>
                <button type="submit" name="withdraw" class="wth">Withdraw</button>
            </form>
            <hr>
            <h2>Recent Transactions</h2>
            <table class="table_details">
                <tr>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Blanace</th>
                    <th>Date</th>
                </tr>

                <?php  
                
                $sql = "SELECT * FROM account  WHERE user_id='".$_SESSION['user_id']."'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {

                    ?>

                    <tr>
                        <td><?php  if($row['deposit']==0){ echo 'Withdraw'; }else if($row['withdraw']==0){ echo 'Deposit';} ?></td>
                        <td><?php  if($row['deposit']==0){  echo $row['withdraw'];   }else if($row['withdraw']==0){ echo $row['deposit'];}  ?></td>
                        <td><?php  echo $row['balance']  ?></td>
                        <td></td>
                    </tr>

                    <?php 
                  //  echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                }
                } else {
                echo "0 results";
                }

                mysqli_close($conn);

                
                ?>
                
            </table>
            
        </div>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>
    <footer class="footer">
      <p>&copy; 2024 Banking Software. All rights reserved.By Sneha Shrestha</p>
 </footer>

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>