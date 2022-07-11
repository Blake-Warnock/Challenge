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
    console.log(checkvar)
  </script>
  <?php
  // //is set
  // echo "Cookie 'user' is set!<br>";
  // echo "Value is: " . $_COOKIE["user"];
}
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
require_once("connect.php");

$sql = "select * from user";

$statement1 = $db->prepare($sql);

if ($statement1->execute()) {
  $account = $statement1->fetchAll();
  $statement1->closeCursor();
} else {
  echo "<h4>Error finding account information</h4>";
}


$dataPoints = array();

foreach ($account as $a) {
  if ($a['visible'] == "y") {
    $name = $a['name'];
    $points = $a['points'];

    $dataPoints[] = array("y" => $points, "label" => $name);
  }
};


?>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>DaMindChallenge</title>
  <link rel="stylesheet" href="stylesheet.css" type="text/css">
  <link rel="stylesheet" href="UI/jquery-ui.min.css">
  <!-- font-family: 'Syne Tactile', cursive; -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne+Tactile&display=swap" rel="stylesheet">
  <!-- font-family: 'Architects Daughter', cursive; -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
  <!-- font-family: 'Dongle', sans-serif; -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dongle&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="UI/jquery-ui.min.js"></script>
  <script src="global.js"></script>
</head>

<body>
  <header>
    <a href="index.php">
      <div id="box-title">
        <h1><span id="da">Da</span><span id="mind">Mind</span><span id="challenge">Challenge</span></h1>
      </div>
    </a>

    <a href="account.php"><img src="images/brain.png"></a>

    <a href="leaderboard.php"><img src="images/leaderboard.png"></a>
    <script>
      window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          backgroundColor: "#333",
          theme: "dark1",
          title: {
            text: "Leader Board",
            fontColor: "snow",
          },
          axisY: {
            title: "Points",
            titleFontColor: "snow"
          },
          data: [{
            type: "column",
            yValueFormatString: "#,###. points",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
          }]
        });

        chart.render();
      }
    </script>
  </header>
  <section>
    <div class="main-container3">
      <div id="chartContainer" style="height: 670px; width: 100%;"></div>
      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </div>
  </section>
  <?php
  include('footer.html');
  ?>