<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authorization</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<p>
    <?php
    $accessVar = 0;
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        if (!preg_match("/^(([a-zA-Z])||([а-яА-Я]))*$/", $name)) {
            $_SESSION['name_message'] = "Invalid name input";
        } else {
            $_SESSION['name_message'] = "$name is correct";
            $accessVar++;
        }
    }
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
        if (!preg_match("/^([+][0-9]{3} [0-9]{2} [0-9]{3}-[0-9]{2}-[0-9]{2})*$/", $phone)) {
            $_SESSION['phone_message'] = "Invalid phone input. ";
        } else {
            $_SESSION['phone_message'] = "$phone is correct";
            $accessVar++;
        }
    }
    if ($accessVar == 2) {
        $time = (int)$_POST['time'];
        $red = 1;
        $green = 1;
        $red_t = 1;
        $green_t = 1;
        $bac = 2;
        for ($i = 1; $i <= $time; $i++) {

            $green = ($green_t * 3) + ($red_t * 7);
            $red = ($green_t * 4) + ($red_t * 5);

            $green_t = $green;
            $red_t = $red;
            $bac = $green + $red;

        }
        $_SESSION['bacterium'] = "In " . $time . " cycles, 1 green and 1 red bacteria turned into " . $green . " green
         and " . $red . " red bacteria! Which in total gives " . $bac." bacteria!";
    }
    ?>
</p>
<form action="index.php" method="post">
    <label>Name</label>
    <input type="text" name="name" placeholder="Name">
    <p>
        <?php
        if (isset($_SESSION['name_message'])) {
            echo '<p class="msg">' . $_SESSION['name_message'] . '</p>';
        }
        unset($_SESSION['name_message']);
        ?>
    </p>
    <label>Phone number</label>
    <input type="text" name="phone" placeholder="+375 29 123-45-67">
    <p>
        <?php
        if (isset($_SESSION['phone_message'])) {
            echo '<p class="msg">' . $_SESSION['phone_message'] . '</p>';
        }
        unset($_SESSION['phone_message']);
        ?>
    </p>
    <label>Email</label>
    <input type="text" name="email" placeholder="Email">
    <?php
    if (isset($_SESSION['email_message'])) {
        echo '<p class="msg">' . $_SESSION['email_message'] . '</p>';
    }
    unset($_SESSION['email_message']);
    ?>
    <label>Time units</label>
    <input type="text" name="time" placeholder="Time">
    <?php
    if (isset($_SESSION['time_message'])) {
        echo '<p class="msg">' . $_SESSION['time_message'] . '</p>';
    }
    unset($_SESSION['time_message']);
    ?>
    <button type="submit">Calculate</button>
    <p>
        <?php
        if (isset($_SESSION['bacterium'])) {
            echo $_SESSION['bacterium'];
        }
        unset($_SESSION['bacterium']);
        ?>
    </p>


</form>

</body>
</html>
