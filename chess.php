<?php
session_start();
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
    console.log("user-id: " + checkvar);
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


//check if they've been here before
require_once("connect.php");

$userHit = false;

$sql = "select * from chess";

$statement1 = $db->prepare($sql);

if ($statement1->execute()) {
  $account = $statement1->fetchAll();
  $statement1->closeCursor();
} else {
  echo "<h4>Error finding account information</h4>";
}
foreach ($account as $a) {
  if ($_SESSION['user-id'] == $a["user_id"]) {
    $userHit = true;
    break;
  } else {
    echo $a["user_id"];
  }
}

if (!$userHit) {
  //if first time add new entries to chess
  $sql2 = "insert into chess
  (user_id) VALUES (:user_id)";

  $statement2 = $db->prepare($sql2);

  $statement2->bindValue(':user_id', $_SESSION["user-id"]);

  if ($statement2->execute()) {
    $statement2->closeCursor();
  } else {
    echo "<h4>Error filling attempt tables... Call the police NOW!</h4>";
  }
}
?>

<section>
  <div class="main-container">
    <div id="chessBoard">
      <?php
      $checkUser = $_SESSION['user-id'];
      $sql3 = "select * from chess where user_id = $checkUser";

      $statement3 = $db->prepare($sql3);

      if ($statement3->execute()) {
        $account = $statement3->fetchAll();
        $statement3->closeCursor();
      } else {
        echo "<h4>Error finding account information</h4>";
      }
      foreach ($a as $account) {
        $wrl = $a['wrl'];
        $wkl = $a['wkl'];
        $wbl = $a['wbl'];
        $wq = $a['wq'];
        $wk = $a['wk'];
        $wbr = $a['wbr'];
        $wkr = $a['wkr'];
        $wrr = $a['wrr'];
        $wp1 = $a['wp1'];
        $wp2 = $a['wp2'];
        $wp3 = $a['wp3'];
        $wp4 = $a['wp4'];
        $wp5 = $a['wp5'];
        $wp6 = $a['wp6'];
        $wp7 = $a['wp7'];
        $wp8 = $a['wp8'];
        $bp1 = $a['bp1'];
        $bp2 = $a['bp2'];
        $bp3 = $a['bp3'];
        $bp4 = $a['bp4'];
        $bp5 = $a['bp5'];
        $bp6 = $a['bp6'];
        $bp7 = $a['bp7'];
        $bp8 = $a['bp8'];
        $brl = $a['brl'];
        $bkl = $a['bkl'];
        $bkl = $a['bkl'];
        $bq = $a['bq'];
        $bk = $a['bk'];
        $bbr = $a['bbr'];
        $bkr = $a['bkr'];
        $brr = $a['brr'];
        break;
      }
      for ($y = 1; $y < 9; $y++) {
      ?>
        <div class="strip">
          <?php
          for ($x = 1; $x < 9; $x++) {
            $space;
            switch ($y) {
              case 1:
                $space = "a" . $x;
                break;
              case 2:
                $space = "b" . $x;
                break;
              case 3:
                $space = "c" . $x;
                break;
              case 4:
                $space = "d" . $x;
                break;
              case 5:
                $space = "e" . $x;
                break;
              case 6;
                $space = "f" . $x;
                break;
              case 7;
                $space = "g" . $x;
                break;
              case 8:
                $space = "h" . $x;
                break;
            }
            $dom = new DOMDocument('1.0', 'utf-8');
            $element = $dom->createElement('div', "$space");
            $attribute = $dom->createAttribute('id');
            $attribute2 = $dom->createAttribute('class');
            $attribute->value = $space;
            if ($y % 2 == 1) {
              if ($x % 2 == 1) {
                $attribute2->value = "dark";
              } elseif ($x % 2 == 0) {
                $attribute2->value = "white";
              }
            } elseif ($y % 2 == 0) {
              if ($x % 2 == 1) {
                $attribute2->value = "white";
              } elseif ($x % 2 == 0) {
                $attribute2->value = "dark";
              }
            }
            $element->appendChild($attribute);
            $element->appendChild($attribute2);
            $dom->appendChild($element);
            echo $dom->saveXML();
          }
          ?>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>
<?php
include('footer.html');
?>