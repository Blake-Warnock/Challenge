<?php
session_start();
// echo $_SESSION["user-id"];
$loginCheck = true;
if (!isset($_COOKIE["user"])) {
  // //not set
  // echo "Cookie named 'user' is not set!";
  $loginCheck = false;
} else {
  $_SESSION['user-id'] = $_COOKIE['user'];
?>
  <script>
    var checkvar = "<?php echo $_SESSION['user-id'] ?>";
    console.log(checkvar)
  </script>
  <?php
  // //is set
  // echo "Cookie 'user' is set!<br>";
  // echo "Value is: " . $_COOKIE["user"];
}

include("header1.html");

if ($loginCheck != 'true') {
  //will only run when cookie is not set, the user is not being remembered
  if ($_SESSION["user-login"] != 'true') {
    //will only run if the user is not logged in
  ?>
    <script>
      window.location.replace("login.php");
    </script>
<?php
  }
}
$user = $_SESSION["user-id"];
require_once("connect.php");

$sql = "select * from user where user_id = $user";

$statement1 = $db->prepare($sql);

if ($statement1->execute()) {
  $account = $statement1->fetchAll();
  $statement1->closeCursor();
} else {
  echo "<h1>Error fetching users information</h1>";
}
?>
<section>
  <div class="main-container2">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <h1>This is Your "Personal Info"</h1>
      <p class="tiny">I definitely haven't already registered 6 credit cards under your name</p>
      <?php
      foreach ($account as $a) {
      ?>
        <h1>"Your" Name:</h1><br><input type="text" name="name" value="<?php echo $a['name']; ?>" required="required" /><br><br>
        <h1>"Your" Username:</h1><br><input type="text" name="username" value="<?php echo $a['username']; ?>" required="required" /><br><br>
        <h1>"Your" Email:</h1><br><input type="text" name="email" value="<?php echo $a['email']; ?>" required="required" /><br><br>
        <h1>"Your" Password:</h1><br><input type="password" name="password" value="<?php echo $a['password']; ?>" required="required" /><br>
        <h1>"Your" Phone Number:</h1><br><input type="text" name="phone" value="<?php echo $a['phone']; ?>" required="required" /><br>
        <h1>"Your" Points:</h1><br><input disabled="disabled" id="points" type="text" name="points" value="<?php echo $a['points']; ?>" required="required" /><br>
      <?php
      }
      ?>
      <button type="submit" name="btn2" class="btn" value="btn2">Update Info</button>
    </form>

    <?php
    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $username = $password = $name = $phone = $points = $email = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = test_input($_POST["name"]);
      $username = test_input($_POST["username"]);
      $email = test_input($_POST["email"]);
      $password = test_input($_POST["password"]);
      $phone = test_input($_POST["phone"]);

      $sql2 = "update user
        set name = :name,
        username = :username,
        email = :email,
        password = :password,
        phone = :phone
        where user_id = $user";

      $statement1 = $db->prepare($sql2);

      $statement1->bindValue(':name', $name);
      $statement1->bindValue(':username', $username);
      $statement1->bindValue(':email', $email);
      $statement1->bindValue(':password', $password);
      $statement1->bindValue(':phone', $phone);

      if ($statement1->execute()) {
        $statement1->closeCursor();
    ?>
        <script>
          alert("Account Successfully Updated");
          setTimeout(function() {
            location.href = "account.php"
          }, 0000);
        </script>
    <?php
      } else {
        echo "<h4>Error creating account</h4>";
      }
    };
    ?>
  </div>
</section>
<?php
include('footer.html');
?>