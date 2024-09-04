<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        .all {
            width: 100%;
        }

        .box {
            width: 30%;
            padding: 3%;
            display: grid;
            margin: 5% auto;
            border: 2px solid lightgrey;
        }

        .inp {
            font-size: large;
            padding: 2% 1%;
            margin: 3% auto;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    include('header.php')
        ?>
    <div class="all">
        <div class="box">
            <form method="post">
                <center>
                    <h3 class="fw-normal">Add New Tag</h3>
                </center>
                <input type="text" name="tag" class="inp" placeholder="Tag Name" required autocomplete="off">
                <center><input type="submit" value="Add" name="sub" class="btn btn-success mt-2" style="width:40%">
                </center>
            </form>
        </div>
    </div>
</body>

</html>

<?php
include('conn.php');
require_once 'func.php';

$category = new func($conn);
if (isset($_POST['sub'])) {

    $tag = $_POST['tag'];
    $category->addnewcategory($tag);
}
?>