<?php
session_start();
// if(!isset($_COOKIE["user"])) {
//   //not set
//   echo "Cookie named 'user' is not set!";
// } else {
//   //is set
//   echo "Cookie 'user' is set!<br>";
//   echo "Value is: " . $_COOKIE["user"];
// }

include("header1.html");

require_once("connect.php");

$sql = "select * from challenge_list";

$statement1 = $db->prepare($sql);

if ($statement1->execute()) {
  $list = $statement1->fetchAll();
  $statement1->closeCursor();
} else {
  echo "Error Fetching challenges";
}
?>

<section>
  <div class="main-container">
    <?php
    foreach ($list as $l) {
    ?>
      <button class="<?php echo $l['status']; ?>" id="<?php echo $l['visible']; ?>" onclick="location.href='<?php echo $l['link']; ?>'">
        <p><span class="arc">Challenge #<?php echo $l['challenge_id'] ?><br></span><?php echo $l["title"]; ?></p>
      </button>
    <?php
    }
    ?>
  </div>
</section>
<?php
include('footer.html');
?>