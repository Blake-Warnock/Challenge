<?php
session_start();
include("header1.html");
?>
<section>
  <div class="main-container2">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <h1>Enter All Your "Personal" Info Here</h1>
      <h1>Name:</h1><br><input type="text" name="name" required="required" /><br><br>
      <h1>Username:</h1><br><input type="text" name="username" required="required" /><br><br>
      <h1>Email:</h1><br><input type="email" name="email" required="required" /><br><br>
      <h1>Password:</h1><br><input type="text" name="password" required="required" /><br>
      <!-- <h1>Phone: (xxx-xxx-xxxx)</h1><br><input type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required="required" /><br> -->
      <h1>Who's the coolest person ever?</h1><br><input type="text" name="cool" required="required" /><br>
      <input type="hidden" id="visibility" type="text" name="visible" value="y" required="required" /><br>
      <button type="submit" name="btn" class="btn" value="btn">Submit</button>
      <p class="tiny">I definitely wont use this information to scam you and steal your identity</p>
    </form>
    <?php
    if (isset($_POST['btn'])) {
      function test_input($data)
      {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    };
    require_once("connect.php");
    $username = $password = $name = $phone = $visible = $points = $email = "";
    $emailHit = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = test_input($_POST["name"]);
      $username = test_input($_POST["username"]);
      $email = test_input($_POST["email"]);
      $password = test_input($_POST["password"]);
      $phone = test_input($_POST["phone"]);
      $visible = test_input($_POST["visible"]);
      $cool = test_input($_POST["cool"]);

      $sqlCheck = "select * from user";

      $statementCheck = $db->prepare($sqlCheck);

      if ($statementCheck->execute()) {
        $account = $statementCheck->fetchAll();
        $statementCheck->closeCursor();
        foreach ($a as $account) {
          if ($email == $a['email']) {
            $emailHit = true;
          } else {
    ?>
            <script>
              alert("Email is not used");
            </script>
        <?php
          }
        }
      } else {
        echo "<h4>Error finding account information</h4>";
      }

      if ($emailHit) {
        ?>
        <script>
          alert("Email is already used");
        </script>
        <?php
      } else {
        $check = strtoupper($cool);
        if ($check == "BLAKE") {
          $points = 300;
        } else {
          $points = 100;
        }

        $sql = "insert into user
        (name, username, email, password, phone, visible, points) VALUES (:name, :username, :email, :password, :phone, :visible, :points)";

        $statement1 = $db->prepare($sql);

        $statement1->bindValue(':name', $name);
        $statement1->bindValue(':username', $username);
        $statement1->bindValue(':email', $email);
        $statement1->bindValue(':password', $password);
        $statement1->bindValue(':phone', $phone);
        $statement1->bindValue(':visible', $visible);
        $statement1->bindValue(':points', $points);

        if ($statement1->execute()) {
          $statement1->closeCursor();

          $sql2 = "select * from user";

          $statement2 = $db->prepare($sql2);

          if ($statement2->execute()) {
            $account = $statement2->fetchAll();
            $statement2->closeCursor();
          } else {
            echo "<h4>Error finding account information</h4>";
          }
          foreach ($account as $a) {
            if ($username == $a["username"] && $password == $a["password"]) {
              $_SESSION['user-login'] = 'true';
              $_SESSION['user-id'] = $a['user_id'];
              $_SESSION['first'] = 'true';
        ?>
              <script>
                alert("Account Successfully Created...\nRedirecting to Account Management")
                setTimeout(function() {
                  location.href = "account.php"
                }, 0000);
              </script>
    <?php
              break;
            }
          }
        } else {
          echo "<h4>Error creating account</h4>";
        }
      };
    }

    ?>
  </div>
  <div id="already">
    <h1>Already have an account?</h1>
    <h1>Click on the wrong button?</h1>
    <h1>Are you stupid?</h1>
    <h1>Do you need me to hold your little baby hand?</h1>
    <a href="login.php">
      <h1>Then click here stupid</h1>
    </a>
  </div>
</section>
<?php
include('footer.html');
?>