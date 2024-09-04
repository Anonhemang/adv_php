<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="text" name="" id="search">
    <div id="result"></div>


    <script>
        $(document).ready(function () {
            $('#search').keyup(function () {
                var query = $(this).val();
                if (query !== '') {
                    $.ajax({
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

</body>

</html>

<?php
include('conn.php');
if (isset($_POST['query'])) {
    $query = $_POST['query'];
    session_start();
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `daata` WHERE title LIKE '%$query%' AND author_id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<a href='view.php?id=$row[id]' class='searching'>$row[title]</a>";

        }
    }
}