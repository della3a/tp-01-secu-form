<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/my-secured-form.css">
    <link rel="icon" type="image/png" href="./assets/images/logo.jpg">
    <title>snflwr</title>
  </head>
  <body> <?php
  session_start();
  ini_set("display_errors", 1);
  ini_set("display_startup_errors", 1);
  error_reporting(E_ALL);

  // connect to the database
  $server = "localhost";
  $username = "root";
  $passwd = "";
  $dbname = "identification_form";

  $conn = new mysqli($server, $username, $passwd, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // check if the lock time variable is set
  if (!isset($_SESSION["lock_time"])) {
      $_SESSION["lock_time"] = 0;
  }

  // check if the page is locked
  if ($_SESSION["counter"] >= 3 && time() < $_SESSION["lock_time"] + 15) {
      $seconds = 15 - (time() - $_SESSION["lock_time"]);
      $lock_message = "The page is locked for $seconds seconds. Please try again later.";
      echo $lock_message;
      exit();
  } elseif ($_SESSION["counter"] >= 3) {
      // reset the lock time and counter variables
      $_SESSION["lock_time"] = 0;
      $_SESSION["counter"] = 0;
  }

  // increment the counter variable
  $_SESSION["counter"]++;

  // set the lock time
  $_SESSION["lock_time"] = time();
  ?> <header>
      <img src="./assets/images/logo.jpg" alt="logo">
      <h1>My Secured Identification Form</h1>
    </header>
    <header>
    <h3>Empowered by Manel Kheffache</h3>
    </header>
    <form action="my-secured-form.php" method="post" onsubmit="return validateForm()">
      <label for='username'>Username:</label>
      <input id='username' type='text' name='username' />
      <br />
      <br />
      <label for='password'>Password:</label>
      <input id='password' type='password' name='password' />
      <br />
      <br />
      <div class="buttons-div">
        <button type="submit" name="login">Login</button>
        <button type="submit" name="add_account">Add Account</button>
        <button @click.prevent="resetForm">Reset form</button>
      </div>
    </form> <?php // add user to the database when the button  add account is clicked

// add user to the database when the button add account is clicked
    if (isset($_POST["add_account"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $pattern =
            '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/';

        // check if username already exists
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "Username is already taken. Please choose a different username. 😎";
        } else {
            if (preg_match($pattern, $password)) {

                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (username, password_hash) VALUES ('$username', '$password_hash')";
                ?>
      <div id="output">
          <?php if ($conn->query($sql) === true) {
              echo "User added successfully 🌻";
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
            } else {
                echo "Your password is not valid. It must contain at least one uppercase letter, a number, a symbol, and be 12 characters long.";
            }
        }
    } ?>

    <?php // login

if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // check if username exists
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // username exists, check if password is correct
            $user = $result->fetch_assoc();
            $password_hash = $user["password_hash"];
            if (password_verify($password, $password_hash)) {
                // password is correct
                echo "Connected successfully 🦄 ";
            } else {
                // password is incorrect
                $_SESSION["counter"]++;
                echo "Incorrect password ❌ ";
            }
        } else {
            // username does not exist
            echo "Username does not exist. Please add an account first. 😎";
        }
    } ?>

    <script> 
    function resetForm() {
      document.querySelectorAll('input').forEach(input => {
        input.value = '';
      });
      document.querySelector('#output').innerHTML = '';
    }

    function validateForm() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    
    if (username.includes(' ') || password.includes(' ')) {
      alert('Username or password cannot contain spaces!');
      return false;
    }

    return true;
  }
    </script>

  </body>
</html>