<?php
session_start();
require_once("connect.php");
include("header1.html");
$user = $_SESSION['user-id'];

$sql = "select * from cartle_attempt where user_id = $user";

$statement1 = $db->prepare($sql);

if ($statement1->execute()) {
    $account = $statement1->fetchAll();
    $statement1->closeCursor();
} else {
    "<h4>Error finding account information</h4>";
}
foreach ($account as $a) {
    $num = ($a['attemptNum'] / 7);
}

$sql2 = "select * from user where user_id = $user";

$statement2 = $db->prepare($sql2);

if ($statement2->execute()) {
    $account = $statement2->fetchAll();
    $statement2->closeCursor();
} else {
    "<h4>Error finding account information</h4>";
}
foreach ($account as $a) {
    $points = $a['points'];
    $pointsTemp = $a['points'];
    $name = $a['name'];
}


?>
<section>
    <article id="win">
        <div class="main-container2">
            <h1>Congratulation <span class="color"><?php echo $name; ?>!</span></h1>
            <p>It only took you <span class="color"><?php echo $num; ?></span> attempts</p>
            <?php

            if ($num <= 4) {
                $points = $points + 500;
            ?>
                <p class="sub-msg">Wait you had to have cheated to have guessed the answer so quickly... <br>
                    <span class="smallOne"> I'm telling Blake that you cheated...</span><span class="smallTwo"> You cheater</span>
                </p>
                <p class="sub-msg">Anyways you get <span class="color">+500 points</span><br>
                    <span class="smallOne">You were at <?php echo $pointsTemp; ?> but now you're at <?php echo $points; ?></span>
                </p>

            <?php
            } else if ($num <= 12) {
                $points = $points + 400;

            ?>
                <p class="sub-msg">Nicely done, didn't take you too long but still... <br>
                    <span class="smallOne">could have done better</span>
                </p>
                <p class="sub-msg">Anyways you get <span class="color">+400 points</span><br>
                    <span class="smallOne">You were at <?php echo $pointsTemp; ?> but now you're at <?php echo $points; ?></span>
                </p>

            <?php
            } else if ($num <= 30) {
                $points = $points + 250;
            ?>

                <p class="sub-msg">Jeez, I thought you were never going to get it <br>
                    <span class="smallOne">I mean <?php echo $num ?> attempts</span><br>
                    <span class="smallTwo">I'm just surprised you didn't give up...</span>
                </p>
                <p class="sub-msg">Anyways you get <span class="color">+250 points</span><br>
                    <span class="smallOne">You were at <?php echo $pointsTemp; ?> but now you're at <?php echo $points; ?></span>
                </p>

            <?php
            } else {
                $points = $points + 100;
            ?>
                <p class="sub-msg">ZZZZZZZZzzzzz.... ZZZZZZZZzzzzz.... ZZZZZZZZzzzzz.... <br>
                    <span class="smallOne">Huh? Oh you're done... </span><span class="bigOne"><?php echo $num ?> attempts!</span><br>
                    That's took you way too long...
                </p>
                <p class="sub-msg">Anyways you get <span class="color">+100 points</span><br>
                    <span class="smallOne">You were at <?php echo $pointsTemp; ?> but now you're at <?php echo $points; ?></span>
                </p>

            <?php
            }
            $sql3 = "update user 
                set points = :points
                where user_id = $user";

            $statement3 = $db->prepare($sql3);

            $statement3->bindValue(':points', $points);

            if ($statement3->execute()) {
                $statement3->closeCursor();
            } else {
                echo "<h4>Error updating account</h4>";
            }
            ?>
        </div>
    </article>
</section>
<?php
include('footer.html');
?>