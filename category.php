<?php
error_reporting(0);
include('header.php');
require_once 'func.php';
include('conn.php');
$function = new func($conn);
if (isset($_SESSION['id'])) {
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>

    <style>
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

        .sa {
            width: 70%;
        }

        .topp {
            display: flex;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="topp">

        <!-- Search code -->
        <div class="sa">
            <input type="text" name="" placeholder="Search" id="search" class="mt-3 ms-5 pe-5 ps-3 pt-1 pb-1">
            <div id="result" class="result"></div>
        </div>

        <script>
            $(document).ready(function () {
                $('#search').keyup(function () {
                    var query = $(this).val();
                    if (query !== '') {
                        $.ajax({
                            url: 'search.php',
                            method: 'POST',
                            data: { query: query },
                            success: function (data) {
                                $('#result').html(data);
                            }
                        })
                    } else {
                        $('#result').html('');
                    }
                })
            })
        </script>
        <!-- Search end -->


        <!-- <a href="addnewpost.php" class="btn btn-info mt-3 me-5 float-end">Add New Post</a>
        <a href="categories.php" class="btn btn-info me-5 mt-3 float-end">View All Categories</a> -->
    </div>
    <div class="all">
        <!-- Box 1 -->
        <?php
        if (isset($_GET['category'])) {
            $category = $_GET['category'];
            foreach ($function->fetchdataaccordcategory($category) as $row) {
                ?>
                <div class="box">
                    <div class="upr">
                        <div class="imbo">
                            <img src="img/<?php echo $row['img'] ?>" alt="" class="inimg">
                        </div>
                        <div class="all_cont">
                            <div class="title">
                                <a href="" class="text-dark text-decoration-none">
                                    <h2> <?php
                                    $text = $row['title'];
                                    $crop = substr($text, 0, 70) . ".........";
                                    echo $crop;
                                    ?>
                                    </h2>
                                </a>
                            </div>
                            <hr>
                            <div class="content">
                                <p>
                                    <?php
                                    $text = $row['content'];
                                    $crop = substr($text, 0, 110) . ".........";
                                    echo $crop;
                                    ?>
                                </p>
                            </div>
                            <div class="tag">
                                <h5>Tags: <?php echo $row['category'] ?></h5>
                            </div>
                            <div class="date">
                                <small><?php echo "~ " . $row['publish_date'] ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="oper float-end">
                        <a href="view.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Read More</a>
                        <?php
                        if ($_SESSION['id'] == true) {
                            ?>
                            <a href="editpost.php?id=<?php echo $row['id'] ?>" class="btn btn-success opr">Edit Post</a>
                            <a href="?del&id=<?php echo $row['id'] ?>" class="btn btn-danger opr" onclick="return del()">Delete
                                Post</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No Data Found For This Category";
        }
        ?>



        <script>
            function del() {
                return confirm("Want to Delet This Data?");
            }
        </script>
        <!-- End of 1 -->
    </div>
</body>

</html>
<?php
if (isset($_GET['del']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $dbtab = "daata";
    $function->deletedata($dbtab, $id);
}
?>