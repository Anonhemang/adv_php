<?php
include('conn.php');
require_once 'func.php';
$view = new func($conn);
?>

<?php
include('header.php');
// require_once 'func.php';
// include('conn.php');

$function = new func($conn);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>Blog</title>
    <style>
        .full {
            width: 90%;
            margin: 5% 7%;
            display: flex;
            text-align: justify;

        }

        .lft {
            width: 60%;
        }

        .img {
            width: 100%;
            height: 30%;
        }

        .h1 {
            font-size: 38px;
            font-weight: 600;
        }

        .p {
            margin-top: 2%;
        }

        .quote {
            border-left: 2px solid red;
            padding: 4%;
            margin: 2% 0;
        }

        .quo {
            font-size: x-large;
        }

        .rig {
            width: 45%;
            /* margin: 0 2%; */
            padding: 0 4%;
        }

        hr {
            /* color: red; */
            width: 10%;
            font-weight: 700;
            border-top: 5px solid #e12454;
        }

        .h3 {
            font-size: x-large;
            font-weight: bold;
        }

        .pa {
            color: black;
            opacity: 0.7;
            font-weight: 600;
        }

        .post {
            margin-top: 8%;
            display: grid;
        }

        a {
            text-decoration: none;
            color: black;
            font-size: larger;
            font-weight: 700;
        }

        .cat {
            margin-top: 8%;
            display: grid;
        }

        .tag {
            width: 70%;
            margin-top: 8%;
        }

        .cont {
            width: 80%;
            display: flex;
            flex-wrap: wrap;
            margin: 0;
        }

        .tbu {
            background-color: #ffff;
            border: 0;
            border-radius: 20px;
            padding: 3% 6%;
            margin: 2%;
        }

        .tbu:hover {
            background-color: #223a66;
            color: white;
        }

        .rw {
            width: 50%;
            display: flex;
            justify-content: space-between;
        }

        @media screen and (max-width:800px) {
            .full {
                display: grid;
                text-align: justify;
            }

            .lft,
            .rig {
                width: 85%;
            }

            .rw {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="full">
        <!----------------------------------------------- Left ----------------------------------------------->

        <?php
        include('conn.php');
        $id = $_GET['id'];
        foreach ($view->viewmore($id) as $row) {
            ?>

        <div class="lft">
            <img src="img/<?php echo $row['img'] ?>" alt="blog" class="img"><br><br>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3"
                viewBox="0 0 16 16">
                <path
                    d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z" />
                <path
                    d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
            </svg>
            <?php echo $row['publish_date'] ?>
            <h1 class="h1">
                <?php echo $row['title'] ?>
            </h1>
            <div class="p">
                <p style="font-size:25px;font-weight:500;opacity:0.7">
                    <?php echo $row['content'] ?>
                </p>

                <p style="font-size:15px;font-weight:500;opacity:0.7"></p>
            </div>
            <div class="quote">
                <blockquote class="quo">
                    Tags:
                    <?php echo $row['category'] ?>
                </blockquote>
            </div>
            <div class="pa">
                <p style="font-size:22px;font-weight:500;opacity:0.7">
                </p>
                <p style="font-size:17px;font-weight:500;opacity:0.7"></p>
            </div>
        </div>

        <?php
        }
        ?>
        <!-- -------------------------------------------------------------------------- -->
        <!--------------------------------------------- Right ------------------------------------------------------>


        <div class="rig">

            <div class="search">
                <h3 class="h3">Search Here</h3>
                <hr>
                <input type="text" placeholder="Search" id="search" style="padding:2%; width:70%">
                <div id="result" class="result"></div>

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
            </div>





            <div class="cat">
                <h3 class="h3">Categories</h3>
                <hr>
                <?php
                foreach ($view->fetchcategory() as $cat) {
                    ?>
                    <p><?php echo $cat['category']?></p> <?php } ?>
            </div>

            <div class="time">
                <h3 class="h3">Time Schedule</h3>
                <hr>

                <div class="sche">

                    <div class="rw">
                        <p>Monday - Friday</p>
                        <p>9:00 - 17:00</p>
                    </div>

                    <div class="rw">
                        <p>Saturday</p>
                        <p>9:00 - 16:00</p>
                    </div>

                    <div class="rw">
                        <p>Sunday</p>
                        <p>Closed</p>
                    </div>

                </div>

            </div>

        </div>

    </div>
</body>

</html>