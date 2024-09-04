<?php
include('header.php');
include('conn.php');
require_once 'func.php';
error_reporting(0);
$function = new func($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

        .pagi,
        .pa {
            margin: 10%;
            padding-bottom: 2% !important;
            display: inline;
            width: 100%;
        }

        .atag {
            justify-content: center;
            color: white;
            margin: 0 2% 5% 2%;
            padding: 1%;
            text-decoration: none;
            border-radius: 100%;
            background-color: black;
        }

        .active {
            background-color: #4CAF50;
        }

        .frm {
            margin: 2% 4%;
            /* width: 100%; */
        }
    </style>
</head>

<body>
    <div class="topp">

        <!-- Search code -->

        <?php
        if (isset($_POST['searchsub'])) {
            $srch = $_POST['srch'];
            $s_date = $_POST['s_date'];
            $category = '';
            if (isset($_POST['tag']) && !empty($_POST['tag'])) {
                $category = implode(' , ', $_POST['tag']);
            }
            $data = $function->fetchalldatacondition($srch, $s_date, $category);
        } else {
            $data = $function->fetchalldata();
        }
        ?>
        <div class="sa">
            <div class="frm">
                <form method="POST">
                    <input type="text" name="srch" placeholder="Search.." id="search"
                        class="ms-5 mb-3 pe-5 ps-3 pt-1 pb-1" value="<?php $_POST['srch'] ?>">
                    <div id="result" class="result"></div>
                    <input type="date" name="s_date" class="me-2">


                    <?php
                    $selected_tags = isset($_POST['tag']) ? $_POST['tag'] : [];
                    foreach ($function->fetchcategory() as $cat) {
                        $check = in_array($cat['category'], $selected_tags) ? 'checked' : '';
                        ?>
                        <input type="checkbox" name="tag[]" value="<?php echo $cat['category'] ?>" <?php echo $check; ?>
                            class="ms-5">
                        <?php
                        echo $cat['category'] ?>
                        <?php
                    }
                    ?>
                    <input type="submit" name="searchsub" class="float-end btn btn-warning">
                </form>
            </div>
        </div>

        <script>
            // $(document).ready(function () {
            //     $('#search').keyup(function () {
            //         var query = $(this).val();
            //         if (query !== '') {
            //             $.ajax({
            //                 url: 'search.php',
            //                 method: 'POST',
            //                 data: { query: query },
            //                 success: function (data) {
            //                     $('#result').html(data);
            //                 }
            //             })
            //         } else {
            //             $('#result').html('');
            //         }
            //     })
            // })
        </script>
        <!-- Search end -->
    </div>

    <div class="all">
        <!-- Box 1 -->
        <?php
        foreach ($data as $row) {
            ?>
            <div class="box">
                <div class="upr">
                    <div class="imbo">
                        <img src="img/<?php echo $row['img'] ?>" alt="" class="inimg">
                    </div>
                    <div class="all_cont">
                        <div class="title">
                            <h2> <?php
                            $text = $row['title'];
                            $crop = substr($text, 0, 70) . ".........";
                            echo $crop;
                            ?>
                            </h2>

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
                </div>
            </div>
            <?php
        }
        ?>
        <!-- End of 1 -->
    </div>
    <div class="pagi">
        <p class="pa">
            <?php

            if (!empty($data)) {
                echo $function->pagination();
            }
            ?>
        </p>
    </div>
</body>

</html>