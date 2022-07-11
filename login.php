<?php
session_start();
function loginCookie()
{
  $cookie_value = $_SESSION['user-id'];
  // echo "<script>alert('$cookie_value');</script>";
  setcookie("user", $cookie_value, time() + (438000 * 60), "/");
};
include("header1.html");
?>
<div id="sign-box">
  <h1>Sign up here</h1>
  <a href="sign.php">
    <h1>Click Here</h1>
  </a>
  <br><br>
  <h1>Forgot Your Login Info</h1>
  <a href="forgot.php">
    <h1>Click Here</h1>
  </a>
</div>
<section>
  <div class="main-container2 login">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <h1>Enter Login Info Here</h1>
      <h1>Username:</h1><br><input type="text" name="username" id="username" required="required" /><br><br>
      <h1>Password:</h1><br><input type="text" name="password" required="required" /><br>
      <h1 id="rememberTitle">Remember me</h1><br><input type="checkbox" name="checkbox" id="rememberMe" value="checked"><span class="tiny">yes please</span>
      <button type="submit" name="btn" id="check" class="btn" value="btn">Submit</button>
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
      require_once("connect.php");
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);
        $checkbox = test_input($_POST["checkbox"]);

        $sql = "select * from user";

        $statement1 = $db->prepare($sql);

        if ($statement1->execute()) {
          $account = $statement1->fetchAll();
          $statement1->closeCursor();
        } else {
          echo "<h4>Error finding account information</h4>";
        }
        foreach ($account as $a) {
          //   $check = $a["user_id"];
          // echo "<script>alert('$check');</script>";
          if ($username == $a["username"] && $password == $a["password"]) {
            $_SESSION['user-login'] = 'true';
            $_SESSION['user-username'] = $a['username'];
            $_SESSION['user-id'] = $a['user_id'];
          } else if ($username == $a["email"] && $password == $a["password"]) {
            $_SESSION['user-login'] = 'true';
            $_SESSION['user-username'] = $a['email'];
            $_SESSION['user-id'] = $a['user_id'];
          }
        }
        if ($_SESSION['user-login'] == 'true') {
          if ($checkbox == "checked") {
            loginCookie();
          }

    ?>
          <script>
            alert("Login successful...\nRedirecting to Account Management");
            setTimeout(function() {
              location.href = "account.php?"
            }, 0000);
          </script>
        <?php
        } else {
        ?>
          <script>
            alert("Wow, you can't even remember you login information!\nTry again tho...");
            window.location.replace("login.php");
          </script>
    <?php
        }
      }
    }
    ?>
  </div>
</section>
<?php
include('footer.html');
?>