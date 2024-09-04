<?php
include('header.php');
error_reporting(0);
require_once 'func.php';
include('conn.php');

$function = new func($conn);
if ($_SESSION['id'] == 1) {

    $function->checksession();

$name = $_SESSION['uname'];
$id = $_SESSION['id'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Categories</title>
</head>

<body>
    <div class="cat">
        <?php
        if ($_SESSION['id'] == true) {
            ?>
            <a href="addcategory.php" class="btn btn-success mt-3 mb-3 float-end me-3">Add New Category</a>
        <?php } ?>
        <table class="table  table-striped" border="2">
            <tr>
                <th class="p-3 ps-5 fs-3">Category</th>
                <th class="p-3 ps-5 fs-3">View Posts</th>
                <?php
                if ($_SESSION['id'] == true) {
                    ?>
                    <th class="p-3 ps-5 fs-3">Delete</th>
                    <?php
                } else {
                    echo "";
                }
                ?>
            </tr>
            <?php

            foreach ($function->fetchcategory() as $row) {
                $_SESSION['category'] = $row['category'];
                ?>
                <tr>
                    <td class="p-3 ps-5 fs-3"><?php echo $row['category'] ?></td>
                    <td class="p-3 ps-5 fs-3"><a href="category.php?category=<?php echo $row['category'] ?><?php error_reporting(0)?>"><i
                                class="bi bi-box-arrow-up-right"></i></a></td>
                    <?php
                    if ($_SESSION['id'] == true) { ?>
                        <td class="p-3 pe-1"><a href="?del&id=<?php echo $row['id'] ?>" onclick="return del()"
                                class="btn btn-danger">Delete</a></td>
                    <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
        </table>
        <script>
            function del() {
                return confirm("Want to Delet This Category?");
            }
        </script>
    </div>
</body>

</html>

<?php
if (isset($_GET['del']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $dbtab = "category";
    $function->deletedata($dbtab, $id);
}

?>