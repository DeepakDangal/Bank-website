

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #004080;
            color: #fff;
            text-align: center;
            padding: 1em;
            position: relative;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-align: left;
            float: left;
            border-radius: 15%;
        }

        .logo img {
            width: 150px;
            height: auto;
            margin-right: 10px;
            border-radius: 15%;
        }

        .logo h1 {
            font-size: 1.5em;
            margin: 0;
        }

        .search-bar {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;

        }

        input[type="text"] {
            padding: 0.5em;
            border: none;
            border-radius: 4px;
            margin-right: 0.5em;
            font-size: 14px;
        }

        button {
            background-color: #2980b9;
            color: #fff;
            border: none;
            padding: 0.5em 1em;
            border-radius: 4px;
            cursor: pointer;
        }

        nav {
            background-color: #004080;
            color: #fff;
            padding: 0.5em;
            text-align: right;
            float: right;

        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 1em;
            margin: 0 0.5em;

        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            padding: 2em;
        }

        footer {
            background-color: #004080;
            color: #fff;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        form {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #2980b9;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 50%;
        }

        button:hover {
            background-color: #216a94;
        }
    </style>
</head>
<body>
<?php

$msg="";
$nameErr = $emailErr = $passwordErr = "";
$name = $email = $password = "";
$valid = true;

// define variables and set to empty values
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $valid = false;
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
            $valid = false;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $valid = false;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid = false;
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $valid = false;
    } else {
      //  $password = password_hash(test_input($_POST["password"]), PASSWORD_BCRYPT);
        $password=md5($password);
        echo $password;
    }

    if ($valid) {
        $servername = "localhost";
        $username = "root";
        $dbpassword = "";
        $dbname = "csd223_deepak";

        $conn = new mysqli($servername, $username, $dbpassword, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

           
        $sql = "INSERT INTO `tbl_user`(`name`,`email`,`password`) VALUES ('".$name."','".$email."','".$password."')";

            if ($conn->query($sql) === TRUE) {
           // echo "New record created successfully";
            $msg="New record created successfully";
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

      

    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
 <!--   <header>
        <div class="logo">
            <img src="bank of nepal.png" alt="Logo">
            <h1>Welcome to Bank Of Nepal</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button>Search</button>
        </div>
    </header>

    <nav>
        <a href="/class-3/page.php">Home</a>
        <a href="#about">About Us</a>
        <a href="#findmore">Find More</a>
        <a href="#services">Services</a>
        <a href="#contract">Contract</a>

    </nav> !-->
    <?php include('header.php');?>
    <main>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php echo $msg ; ?>
            <h2>SIGN-UP</h2>

           
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>


            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
            
        </form>
    </main>

    <footer>
        <p>Contact us at: contact@bankofnepal.com</p>
    </footer>
</body>

</html>