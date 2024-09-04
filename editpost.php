<?php
include('header.php');
require_once 'func.php';
include('conn.php');
$function = new func($conn);

$function->checksession();
// session_start();
$name = $_SESSION['uname'];
$id = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

    <style>
        .all {
            margin: 0 10%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .box {
            padding: 1%;
            border: 1px solid gray;
            border-radius: 10px;
            width: 90%;
            /* margin-top: 1% !important; */
            margin: auto;

        }

        .inimg {
            width: 100%;
            margin: auto;
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
    <center><a href="addcategory.php" class="btn btn-success mt-2 mb-2">Add New Tag</a></center>
    <div class="all">
        <!-- Box 1 -->
        <?php
        $id = $_GET['id'];
        foreach ($function->viewmore($id) as $row) {

            ?>
            <form method="post" enctype="multipart/form-data">
                <div class="box">
                    <div class="upr">
                        <div class="imbo">
                            <img src="img/<?php echo $row['img'] ?>" alt="" class="inimg">
                            <input type="file" name="img" id="" value="<?php echo $row['img'] ?>">(Upload New Image To
                            Update)
                        </div>
                        <div class="all_cont">

                            <div class="title">

                                <h2><textarea name="title" id="" cols="40" rows="2"><?php echo $row['title'] ?></textarea>
                                </h2>

                            </div>
                            <hr>
                            <div class="content">
                                <p><textarea name="content" id="editor" cols="20" rows="2"
                                        placeholder="Content Comes Here"><?php echo $row['content'] ?></textarea>
                                </p>
                            </div>
                            

                            <div class="tag">
                                <h5>Tags:</h5>
                                <?php
                                $existing = explode(' , ', $row['category']);
                                foreach ($function->fetchcategory() as $cat) {
                                    $check = in_array($cat['category'], $existing) ? 'checked' : '';

                                    ?>
                                    <input type="checkbox" name="tag[]" value="<?php echo $cat['category'] ?>" <?php echo $check; ?> id=""><?php echo $cat['category'] ?>
                                    <?php
                                }
                                ?>
                            </div>


                            <div class="date">
                                <small>~ Todays Date Will Be Printed Here</small>
                            </div>
                            <div class="oper float-end mt-5">
                                <a class="btn btn-primary">Read More</a>
                                <a class="btn btn-success opr">Edit Post</a>
                                <a class="btn btn-danger opr">Delete Post</a>
                            </div>
                        </div>
                    </div>



                </div>
                <center><input type="submit" value="Edit Post" name="addpost" class="btn btn-success mt-2 mb-3 btn-lg">
                </center>
            </form>

            <?php
        }
        ?>

        <!-- End of 1 -->
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>


    </div>


</body>

</html>

<?php
if (isset($_POST['addpost'])) {
    $id = $_GET['id'];
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $folder = "img/" . $img;
    $move = move_uploaded_file($tmp, $folder);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $auth = $_SESSION['id'];
    $tag = implode(' , ', $_POST['tag']);
    $function->editpost($title, $content, $img, $tag, $id);
}
?>