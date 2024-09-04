<?php
include('header.php');
include('conn.php');
require_once 'func.php';

$show = new func($conn);

if(isset($_SESSION['id'])){
    $function->checksession();
    // session_start();
    $name = $_SESSION['uname'];
    $id = $_SESSION['id'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View By Date</title>
    <style>
        .alldate {
            margin: 2% 10%;
        }

        .sort {
            display: flex;
            justify-content: space-evenly;
            width: 100%;
        }

        .all {
            margin: 5% 10%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .box {
            padding: 1% 1%;
            border: 1px solid gray;
            border-radius: 10px;
            width: 80%;
            margin-top: 2% !important;
            margin: auto;

        }

        .inimg {
            width: 100%;
            margin: auto;
            height: -webkit-fill-available;
        }

        .imbo {
            width: 30%;
            margin: 1%;
            padding: 2%;
        }

        .date {
            float: inline-end;
        }

        .upr {
            display: flex;
        }

        .all_cont {
            width: 80%;
            margin-top: 2%;
        }
    </style>
</head>

<body>
    <div class="alldate">
        <div class="sort">
            <form method="post">
                <input type="date" name="sdate" class="me-5" required>
                <input type="date" name="edate" class="ms-5 me-5" required>
                <input type="submit" value="Search" name="sub" class="btn btn-success btn-sm ms-5">
            </form>
        </div>

        <div class="disp">
            <?php
            if (isset($_POST['sub'])) {
                $sdate = $_POST['sdate'];
                $edate = $_POST['edate'];
                if (isset($_SESSION['id'])) {
                    foreach ($show->sortdate($id, $sdate, $edate) as $row) {
                        discont($row);       
                    }
                } else {
                    foreach ($show->sortdateforall($sdate, $edate) as $row) {
                        discont($row);
                    }

                }
            }
            ?>
        </div>

    </div>
</body>

</html>

<?php
function discont($row) {
    $text = $row['title'];
    $crop_title = substr($text, 0, 70) . '.........';

    $text = $row['content'];
    $crop_content = substr($text, 0, 110) . '.........';

    echo "<div class='box'>
    <div class='upr'>
        <div class='imbo'>
            <img src='img/{$row['img']}' alt='' class='inimg'>
        </div>
        <div class='all_cont'>
            <div class='title'>
                <a href='' class='text-dark text-decoration-none'>
                    <h2>$crop_title</h2>
                </a>
            </div>
            <hr>
            <div class='content'>
                <p>$crop_content</p>
            </div>
            <div class='tag'>
                <h5>Tags: {$row['category']}</h5>
            </div>
            <div class='date'>
                <small> ~  {$row['publish_date']}</small>
            </div>
        </div>
    </div>
    <div class='oper'>
        <a href='view.php?id={$row['id']}' class='btn btn-primary'>Read More</a>
    </div>
</div>";
}
?>