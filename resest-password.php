<?php
session_start();
include("header1.html");

if (isset($_POST['btn'])) {
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = test_input($_POST["email"]);

  $sql = "select * from user";

  $statement1 = $db->prepare($sql);

  if ($statement1->execute()) {
    $account = $statement1->fetchAll();
    $statement1->closeCursor();
  } else {
    echo "<h4>Error finding account information</h4>";
  }
  foreach ($account as $a) {
    if ($email == $a["email"]) {
      $msg = "Here's your damn reset code" . $_SESSION['forgot-code'];
      // mail($email,"WASTING MY DAMN TIME",$msg); 
    }
  }
}
?>
<section>
  <div class="main-container2">
    <form action="reset-password.php" method="post">
      <h1>I just sent your forgetful ass a code<br>Enter it below...</h1>
      <p id="tiny">if you can even manage that</p>
      <h1></h1><input type="text" name="code" maxlength="6" min="6" required="required" /><br><br>
      <button type="submit" name="btn" class="btn" value="btn">Send</button>
    </form>
  </div>
</section>
<?php
include('footer.html');
?>