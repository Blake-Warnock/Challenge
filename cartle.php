<?php
session_start();
function loginCookie()
{
  $cookie_value = $_SESSION['user-id'];
  // echo "<script>alert('$cookie_value');</script>";
  setcookie("user", $cookie_value, time() + (438000 * 60), "/");
};

$show = true;

if (!isset($_SESSION['user-login'])) {
  $_SESSION['user-login'] = false;
}
if (!isset($_SESSION['user-id'])) {
  $_SESSION['user-login'] = false;
}

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
    console.log("user: " + checkvar);
  </script>
<?php
}
require_once("connect.php");
include("header1.html");
?>
<script src="cartle.js"></script>
<?php
// will only run if the user is not logged in
if ($_SESSION["user-login"] != 'true') {
  if ($loginCheck != 'true') {
    //will only run when cookie is not set, the user is not being remembered
    $_SESSION['user-id'] = 1;
    $show = false;
?>
    <section id="mini-login">
      <div id="sign-box">
        <h1>Sign up here</h1>
        <a href="sign.php">
          <h1>Click Here</h1>
        </a>
        <br><br>
        <h1>Forgot Login Info, You Idiot</h1>
        <a href="forgot.php">
          <h1>Click Here</h1>
        </a>
      </div>
      <div class="login-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <h1>Enter Login Info Here</h1>
          <h1>Username:</h1><br><input type="text" name="username" id="username" required="required" /><br><br>
          <h1>Password:</h1><br><input type="text" name="password" required="required" /><br>
          <h1 id="rememberMini">Remember me</h1><br><input type="checkbox" name="checkbox" id="rememberMeMini" value="checked"><span class="tiny two">yes please</span>
          <button type="submit" name="btn" id="check" class="btn mini" value="btn">Submit</button>
        </form>
        <?php
        if (isset($_POST['btn'])) {
          require_once("connect.php");
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = test_input($_POST["username"]);
            $password = test_input($_POST["password"]);
            $checkbox = test_input($_POST["checkbox"]);

            $sqlLogin = "select * from user";

            $statementLogin = $db->prepare($sqlLogin);

            if ($statementLogin->execute()) {
              $account = $statementLogin->fetchAll();
              $statementLogin->closeCursor();
            } else {
              echo "<h4>Error finding account information</h4>";
            }
            foreach ($account as $a) {
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
                alert("Login successful...");
                setTimeout(function() {
                  location.href = "cartle.php?"
                }, 0000);
              </script>
            <?php
            } else {
            ?>
              <script>
                alert("Wow, you can't even remember you login information!\nTry again tho...");
                window.location.replace("cartle.php");
              </script>
        <?php
            }
          }
        }
        ?>
      </div>
      <div class="main-container3 temp">
        <div id="side-container">
          <h1>Attempts</h1>
        </div>
        <div class="row one">
          <input id="input1" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input2" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input3" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input4" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input5" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input6" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input7" maxlength="1" minlength="0" type="text" onkeydown="return false">
        </div>
        <div class="row two">
          <input id="input8" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input9" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input10" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input11" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input12" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input13" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input14" maxlength="1" minlength="0" type="text" onkeydown="return false">
        </div>
        <div class="row three">
          <input id="input15" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input16" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input17" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input18" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input19" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input20" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input21" maxlength="1" minlength="0" type="text" onkeydown="return false">
        </div>
        <div class="row four">
          <input id="input22" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input23" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input24" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input25" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input26" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input27" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input28" maxlength="1" minlength="0" type="text" onkeydown="return false">
        </div>
        <div class="keyboard">
          <div class="keyboard-row one">
            <button class="key" id="Q">Q</button>
            <button class="key" id="W">W</button>
            <button class="key" id="E">E</button>
            <button class="key" id="R">R</button>
            <button class="key" id="T">T</button>
            <button class="key" id="Y">Y</button>
            <button class="key" id="U">U</button>
            <button class="key" id="I">I</button>
            <button class="key" id="O">O</button>
            <button class="key" id="P">P</button>
          </div>
          <div class="keyboard-row two">
            <button class="key" id="A">A</button>
            <button class="key" id="S">S</button>
            <button class="key" id="D">D</button>
            <button class="key" id="F">F</button>
            <button class="key" id="G">G</button>
            <button class="key" id="H">H</button>
            <button class="key" id="J">J</button>
            <button class="key" id="K">K</button>
            <button class="key" id="L">L</button>
          </div>
          <div class="keyboard-row three">
            <button class="key" id="Z">Z</button>
            <button class="key" id="X">X</button>
            <button class="key" id="C">C</button>
            <button class="key" id="V">V</button>
            <button class="key" id="B">B</button>
            <button class="key" id="N">N</button>
            <button class="key" id="M">M</button>
          </div>
          <div class="keyboard-row four">
            <button class="key" id="back">Del</button>
            <button class="key" id="enter">Submit</button>
          </div>
        </div>
    </section>

  <?php
  }
}



//check if they've been here before

if ($show) {
  $userHit = false;
} else {
  $userHit = true;
}


$sql = "select * from cartle_attempt";

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
    // echo $a["user_id"];
  }
}
if (!$userHit) {
  //if first time add new entries to cartle_toockie_attempt & cartle_toockie_letter_bunch
  $sql2 = "insert into cartle_attempt
    (user_id) VALUES (:user_id)";

  $statement2 = $db->prepare($sql2);

  $statement2->bindValue(':user_id', $_SESSION["user-id"]);

  if ($statement2->execute()) {
    $statement2->closeCursor();


    $sql3 = "insert into cartle_letter_bunch
      (user_id) VALUES (:user_id)";

    $statement3 = $db->prepare($sql3);

    $statement3->bindValue(':user_id', $_SESSION['user-id']);

    if ($statement3->execute()) {
      $statement3->closeCursor();

      $sqlLogin = "insert into cartle_value
            (user_id) VALUES (:user_id)";

      $statement3 = $db->prepare($sqlLogin);

      $statement3->bindValue(':user_id', $_SESSION["user-id"]);

      if ($statement3->execute()) {
        $statement3->closeCursor();
      } else {
        echo "<h4>Error filling letter value tables... Call the police NOW!</h4>";
      }
    } else {
      echo "<h4>Error filling letter tables... Call the police NOW!</h4>";
    }
  } else {
    echo "<h4>Error filling attempt tables... Call the police NOW!</h4>";
  }
}

$user = $_SESSION['user-id'];

$sqlL = "select * from cartle_letter_bunch where user_id = $user";

$statementL = $db->prepare($sqlL);

if ($statementL->execute()) {
  $letters = $statementL->fetchAll();
  $statementL->closeCursor();
}
foreach ($letters as $l) {
  ?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input id="store" name="store" type="hidden"></input>
    <input id="letterT" name="letterT" value="<?php echo $l["T"] ?>" type="hidden"></input>
    <input id="letterO" name="letterO" value="<?php echo $l["O"] ?>" type="hidden"></input>
    <input id="letterC" name="letterC" value="<?php echo $l["C"] ?>" type="hidden"></input>
    <input id="letterK" name="letterK" value="<?php echo $l["K"] ?>" type="hidden"></input>
    <input id="letterI" name="letterI" value="<?php echo $l["I"] ?>" type="hidden"></input>
    <input id="letterE" name="letterE" value="<?php echo $l["E"] ?>" type="hidden"></input>
    <input id="posOne" name="posOne" type="hidden"></input>
    <input id="posTwo" name="posTwo" type="hidden"></input>
    <input id="posThree" name="posThree" type="hidden"></input>
    <input id="posFour" name="posFour" type="hidden"></input>
    <input id="posFive" name="posFive" type="hidden"></input>
    <input id="posSix" name="posSix" type="hidden"></input>
    <input id="posSeven" name="posSeven" type="hidden"></input>
    <input id="letterOne" name="letterOne" type="hidden"></input>
    <input id="letterTwo" name="letterTwo" type="hidden"></input>
    <input id="letterThree" name="letterThree" type="hidden"></input>
    <input id="letterFour" name="letterFour" type="hidden"></input>
    <input id="letterFive" name="letterFive" type="hidden"></input>
    <input id="letterSix" name="letterSix" type="hidden"></input>
    <input id="letterSeven" name="letterSeven" type="hidden"></input>
    <button id="btnThree" name="btnThree"></button>
  <?php
}
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_POST['btnThree'])) {
  $attempt = $letterT = $letterO = $letterC = $letterK = $letterI = $letterE = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attempt = test_input($_POST["store"]);
    $letterT = test_input($_POST["letterT"]);
    $letterO = test_input($_POST["letterO"]);
    $letterC = test_input($_POST["letterC"]);
    $letterK = test_input($_POST["letterK"]);
    $letterI = test_input($_POST["letterI"]);
    $letterE = test_input($_POST["letterE"]);
    $pos1 = test_input($_POST["posOne"]);
    $pos2 = test_input($_POST["posTwo"]);
    $pos3 = test_input($_POST["posThree"]);
    $pos4 = test_input($_POST["posFour"]);
    $pos5 = test_input($_POST["posFive"]);
    $pos6 = test_input($_POST["posSix"]);
    $pos7 = test_input($_POST["posSeven"]);
    $letter1 = test_input($_POST["letterOne"]);
    $letter2 = test_input($_POST["letterTwo"]);
    $letter3 = test_input($_POST["letterThree"]);
    $letter4 = test_input($_POST["letterFour"]);
    $letter5 = test_input($_POST["letterFive"]);
    $letter6 = test_input($_POST["letterSix"]);
    $letter7 = test_input($_POST["letterSeven"]);




    // checks the users attempts and targets the next row. If need will create a new row

    $sql4 = "select attemptNum from cartle_attempt where user_id = $user";

    $statement4 = $db->prepare($sql4);
    if ($statement4->execute()) {
      $account = $statement4->fetchAll();
      $statement4->closeCursor();
      foreach ($account as $a) {
        $attemptNum = $a["attemptNum"];
        $attemptNum++;
        echo "<h4>$attemptNum</h4>";
        break;
      }
    } else {
      echo "<h4>Error finding account information</h4>";
    }
    //grabs the highest numbered row
    $sql5 = "select attemptNum from cartle_attempt order by attemptNum DESC";

    $statement5 = $db->prepare($sql5);

    if ($statement5->execute()) {
      $account = $statement5->fetchAll();
      $statement5->closeCursor();
      foreach ($account as $a) {
        $attemptTop = $a["attemptNum"];
        echo "<h4>$attemptTop</h4>";
        break;
      }
    } else {
      echo "<h4>Error finding attempt number information</h4>";
    }



    //ensures additional attempts
    $seven = $attemptNum + 7;
    $add = 1;

    for ($x = $attemptNum; $x < $seven; $x++) {
      if ($attemptNum > $attemptTop) {

        $sql7 = "alter table cartle_attempt add attempt" . $x . " varchar(7) not null";

        $statement7 = $db->prepare($sql7);

        if ($statement7->execute()) {
          $statement7->closeCursor();
        } else {
          echo "<h4>Error adding new column to attempts</h4>";
        }

        $sql10 = "alter table cartle_value add attempt" . $x . " varchar(7) not null";

        $statement10 = $db->prepare($sql10);

        if ($statement10->execute()) {
          $statement10->closeCursor();
        } else {
          echo "<h4>Error adding new column to attempts</h4>";
        }
      }

      $sql8 = "update cartle_attempt
          set attempt" . $x . " = :letter
          where user_id = $user";

      $statement8 = $db->prepare($sql8);

      $statement8->bindValue(":letter", ${"letter" . $add});



      if ($statement8->execute()) {
        $statement8->closeCursor();
      } else {
        echo "<h4>Error adding attempt to attempt table</h4>";
      }

      $sql11 = "update cartle_value
          set attempt" . $x . " = :pos
          where user_id = $user";

      $statement11 = $db->prepare($sql11);

      $statement11->bindValue(":pos", ${"pos" . $add});



      if ($statement11->execute()) {
        $statement11->closeCursor();
      } else {
        echo "<h4>Error adding attempt to attempt table</h4>";
      }
      $add++;
    }
    $attemptNum = $attemptNum + 6;
    $sql6 = "update cartle_attempt
              set attemptNum = :attemptNum 
              where user_id = $user";

    $statement6 = $db->prepare($sql6);

    $statement6->bindValue(':attemptNum', $attemptNum);

    if ($statement6->execute()) {
      $statement6->closeCursor();
    } else {
      echo "<h4>Error updating attempts</h4>";
    }
    $sql12 = "update cartle_value
          set attemptNum = :attemptNum 
          where user_id = $user";

    $statement12 = $db->prepare($sql12);

    $statement12->bindValue(':attemptNum', $attemptNum);

    if ($statement12->execute()) {
      $statement12->closeCursor();
    } else {
      echo "<h4>Error updating attempts</h4>";
    }
    $sql9 = "update cartle_letter_bunch
      set C = :letterC,
      E = :letterE,
      I = :letterI,
      K = :letterK,
      O = :letterO,
      T = :letterT
      where user_id = $user";

    $statement9 = $db->prepare($sql9);

    $statement9->bindValue(":letterC", $letterC);
    $statement9->bindValue(":letterE", $letterE);
    $statement9->bindValue(":letterI", $letterI);
    $statement9->bindValue(":letterK", $letterK);
    $statement9->bindValue(":letterO", $letterO);
    $statement9->bindValue(":letterT", $letterT);

    if ($statement9->execute()) {
      $statement9->closeCursor();
    } else {
      echo "<h4>Error adding letters to letter table</h4>";
    }
  }
  if ($attempt == "TOOCKIE") {
    header("Location: http://localhost/MindChallenge/win.php");
  } else {
    header("Location: http://localhost/MindChallenge/cartle.php");
  }
}
if ($show) {
  ?>
  </form>
  <section>
    <script src="cartle.js"></script>
    <div class="main-container3">
      <?php
      $sql13 = "select * from cartle_value where user_id = $user";

      $statement13 = $db->prepare($sql13);

      if ($statement13->execute()) {
        $allAttempts = $statement13->fetchAll();
        $statement13->closeCursor();

        $sql14 = "select * from cartle_attempt where user_id = $user";

        $statement14 = $db->prepare($sql14);

        if ($statement14->execute()) {
          $allLetters = $statement14->fetchAll();
          $statement14->closeCursor();
        } else {
          echo "<h4>Error fetching letter attempts</h4>";
        }
      } else {
        echo "<h4>Error fetching letter attempts</h4>";
      }
      foreach ($allAttempts as $all) {
        $allNum = $all["attemptNum"];
        foreach ($allLetters as $letter) {
          if ($allAttempts > 0) {
      ?>
            <div id="side-container">
              <h1>Attempts</h1>
              <?php
              for ($x = 1; $x <= $allNum; $x++) {

              ?>
                <p class="result <?php echo $all["attempt" . $x] ?>"><?php echo $letter["attempt" . $x] ?></p>
              <?php
                $x - 1;
                if (($x % 7) == 0) {
                  echo "<h1 id='space'>a</h1>";
                }
              }
              ?>
              <br>
              <br>
            <?php
          }
            ?>
            </div>
        <?php
        }
      }
        ?>

        <div class="row one">
          <input id="input1" maxlength="1" minlength="0" type="text">
          <input id="input2" maxlength="1" minlength="0" type="text">
          <input id="input3" maxlength="1" minlength="0" type="text">
          <input id="input4" maxlength="1" minlength="0" type="text">
          <input id="input5" maxlength="1" minlength="0" type="text">
          <input id="input6" maxlength="1" minlength="0" type="text">
          <input id="input7" maxlength="1" minlength="0" type="text">
        </div>
        <div class="row two">
          <input id="input8" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input9" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input10" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input11" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input12" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input13" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input14" maxlength="1" minlength="0" type="text" onkeydown="return false">
        </div>
        <div class="row three">
          <input id="input15" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input16" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input17" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input18" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input19" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input20" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input21" maxlength="1" minlength="0" type="text" onkeydown="return false">
        </div>
        <div class="row four">
          <input id="input22" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input23" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input24" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input25" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input26" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input27" maxlength="1" minlength="0" type="text" onkeydown="return false">
          <input id="input28" maxlength="1" minlength="0" type="text" onkeydown="return false">
        </div>

        <div class="keyboard">
          <?php
          foreach ($letters as $l) {
          ?>
            <div class="keyboard-row one">
              <button class="key" id="Q">Q</button>
              <button class="key" id="W">W</button>
              <button class="key <?php echo $l["E"] ?>" id="E">E</button>
              <button class="key" id="R">R</button>
              <button class="key <?php echo $l["T"] ?>" id="T">T</button>
              <button class="key" id="Y">Y</button>
              <button class="key" id="U">U</button>
              <button class="key <?php echo $l["I"] ?>" id="I">I</button>
              <button class="key <?php echo $l["O"] ?>" id="O">O</button>
              <button class="key" id="P">P</button>
            </div>
            <div class="keyboard-row two">
              <button class="key" id="A">A</button>
              <button class="key" id="S">S</button>
              <button class="key" id="D">D</button>
              <button class="key" id="F">F</button>
              <button class="key" id="G">G</button>
              <button class="key" id="H">H</button>
              <button class="key" id="J">J</button>
              <button class="key <?php echo $l["K"] ?>" id="K">K</button>
              <button class="key" id="L">L</button>
            </div>
            <div class="keyboard-row three">
              <button class="key" id="Z">Z</button>
              <button class="key" id="X">X</button>
              <button class="key <?php echo $l["C"] ?>" id="C">C</button>
              <button class="key" id="V">V</button>
              <button class="key" id="B">B</button>
              <button class="key" id="N">N</button>
              <button class="key" id="M">M</button>
            </div>
          <?php
          }
          ?>
          <div class="keyboard-row four">
            <button class="key" id="back">Del</button>
            <button class="key" id="enter">Submit</button>
          </div>
        </div>
  </section>
<?php

  include('footer.html');
}
?>