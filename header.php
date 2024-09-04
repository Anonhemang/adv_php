<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <style>
        .head {
            width: 100%;
            padding: 3%;
            /* justify-content: end; */
            /* float: right; */
            display: inline-flex;
            margin-left: auto;
            margin-right: auto;
            background-color: black;
        }

        .header {
            width: 100%;
            padding: 0 3%;
            justify-content: end;
            float: right;
            display: flex;
            margin-left: auto;
            margin-right: auto;
            background-color: black;
        }

        .ahead {
            padding: 1%;
            margin: 0 2%;
            text-decoration: none;
            color: white;
            font-size: medium !important;
            font-weight: 300 !important;
        }
    </style>
</head>

<body>
    <div class="whole">

        <div class="head">
            <h1 class="text-light fs-1">Blog</h1>
            <div class="header">
                <?php
                error_reporting(0);
                include('conn.php');
                session_start();
                if ($_SESSION['uname']) {
                    $name = $_SESSION['uname']; ?>
                    <a href="home.php" class="ahead">Home</a>
                    <a href="date.php" class="ahead">Date</a>


                    <a href="?logout=true" class="ahead">Logout</a>
                    <p class="ahead">Hello,<?php echo " " . ucfirst($name) ?></p>
                    <?php
                } else {
                    ?>
                     <a href="index.php" class="ahead">Home</a>
                    <a href="date.php" class="ahead">Date</a>
                    <a href="categories.php" class="ahead">Categories</a>
                    <a href="login.php" class="ahead">Login</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>

<?php
require_once 'func.php';
$function = new func($conn);
if (isset($_GET['logout'])) {
    $function->logout();
}
?>