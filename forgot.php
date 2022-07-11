<?php
session_start();
$n = 6;
function code($n)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';

  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
  }

  return $randomString;
}
$_SESSION["forgot-code"] = code($n);

include("header1.html");
?>
<section>
  <div class="main-container2">
    <form action="process-forgot.php" method="post">
      <h1>Enter your email address so I can send you a lame ass email</h1>
      <h1>Email:</h1><br><input type="text" name="email" required="required" /><br><br>
      <button type="submit" name="btn" class="btn" value="btn">Send</button>
    </form>
  </div>
</section>
<?php
include('footer.html');
?>