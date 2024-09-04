<?php
// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'pagination');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get the total number of records from our table "students".
$total_pages = $mysqli->query('SELECT * FROM students')->num_rows;

// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 5;

// Calculate the page to get the results we need from our table.
$calc_page = ($page - 1) * $num_results_on_page;

// Query to get the results.
$query = "SELECT * FROM students ORDER BY name LIMIT $calc_page, $num_results_on_page";

$result = $mysqli->query($query);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP & MySQL Pagination</title>
        <meta charset="utf-8">
        <style>
            html {
                font-family: Tahoma, Geneva, sans-serif;
                padding: 20px;
                background-color: #F8F9F9;
            }
            table {
                border-collapse: collapse;
                width: 500px;
            }
            td, th {
                padding: 10px;
            }
            th {
                background-color: #54585d;
                color: #ffffff;
                font-weight: bold;
                font-size: 13px;
                border: 1px solid #54585d;
            }
            td {
                color: #636363;
                border: 1px solid #dddfe1;
            }
            tr {
                background-color: #f9fafb;
            }
            tr:nth-child(odd) {
                background-color: #ffffff;
            }
            .pagination {
                list-style-type: none;
                padding: 10px 0;
                display: inline-flex;
                justify-content: space-between;
                box-sizing: border-box;
            }
            .pagination li {
                box-sizing: border-box;
                padding-right: 10px;
            }
            .pagination li a {
                box-sizing: border-box;
                background-color: #e2e6e6;
                padding: 8px;
                text-decoration: none;
                font-size: 12px;
                font-weight: bold;
                color: #616872;
                border-radius: 4px;
            }
            .pagination li a:hover {
                background-color: #d4dada;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <th>Name</th>
                <th>College</th>
                <th>Score</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['college']; ?></td>
                <td><?php echo $row['score']; ?></td>
            </tr>
            <?php } ?>
        </table>
        <ul class="pagination">
            <?php
            // Calculate the total number of pages
            $total_pages = ceil($total_pages / $num_results_on_page);

            // Create pagination links
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo "<li><a href='#' class='active'>$i</a></li>";
                } else {
                    echo "<li><a href='?page=$i'>$i</a></li>";
                }
            }
            ?>
        </ul>
    </body>
</html>