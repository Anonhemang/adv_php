<?php
error_reporting(E_ALL);
// include('conn.php');
class func
{
    public $conn;
    private $limit = 3;
    private $start_from;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->getpagination();
    }

    public function getpagination()
    {
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $this->start_from = ($page - 1) * $this->limit;
    }
    public function pagination()
    {
        $sql = "SELECT COUNT(*) FROM `daata`";
        $result = mysqli_query($this->conn, $sql);
        $total_record = mysqli_fetch_row($result)[0];
        // If there are no records, return an empty string (no pagination)
        if ($total_record == 0) {
            return '';
        }

        $total_pages = ceil($total_record / $this->limit);
        $pagination = '';

        for ($i = 1; $i <= $total_pages; $i++) {
            $class = (isset($_GET["page"]) && $i == $_GET["page"]) ? "active" : "";
            $pagination .= "<a href='?page=$i' class='atag $class'>$i</a>";
        }

        return $pagination;
    }


    public function login($uname, $pass)
    {
        $sql = "SELECT * FROM `login` WHERE uname='$uname' && pass='$pass'";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['uname'] = $row['uname'];
            $_SESSION['id'] = $row['id'];
            header("location:home.php");
            exit();
        } else {
            echo "Something went wrong";
        }
    }

    public function checksession()
    {
        if ($_SESSION['id'] == "") {
            header("location:login.php");
            exit();
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("location:login.php");
        exit();
    }

    public function registernewuser($uname, $pas)
    {
        $sql = "INSERT INTO `login` VALUES('','$uname','$pas')";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            echo "<script>alert('User Registered'); window.location.href='http://localhost/cont/login.php'</script>";
        } else {
            echo "<script>alert('Error')</script>";
        }
    }

    public function addnewcategory($tag)
    {
        $sql = "INSERT INTO `category` VALUES('','$tag')";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            echo "<script>alert('Tag Added'); window.location.href='http://localhost/cont/home.php'</script>";
        } else {
            echo "<script>alert('Error! Tag Not Added')</script>";
        }
    }

    public function fetchcategory()
    {
        $sql = "SELECT * FROM `category` ";
        return $this->executeQuery($sql);
    }

    public function addpost($move, $img, $title, $content, $auth, $tag)
    {
        if ($move) {
            $sql = "INSERT INTO `daata` (`img`, `title`, `content`, `author_id`, `category`) VALUES('$img', '$title', '$content', '$auth', '$tag')";
            $result = mysqli_query($this->conn, $sql);

            if ($result) {
                echo "<script>alert('Data Inserted'); window.location.href='http://localhost/cont/home.php'</script>";
            }
        } else {
            echo "<script>alert('Error! Data Not Inserted')</script>";
        }
    }

    public function fetchdata($id)
    {
        $sql = "SELECT * FROM `daata` WHERE author_id='$id' LIMIT $this->start_from, $this->limit";
        return $this->executeQuery($sql);
    }

    public function fetchdataaccordcategory($category)
    {
        error_reporting(0);
        $sql = "SELECT * FROM `daata` WHERE `category` LIKE '%$category%'";
        return $this->executeQuery($sql);
    }

    public function viewmore($id)
    {
        $sql = "SELECT * FROM `daata` WHERE id='$id'";
        return $this->executeQuery($sql);
    }

    public function fetchalldata()
    {
        $sql = "SELECT * FROM `daata` LIMIT $this->start_from, $this->limit";
        return $this->executeQuery($sql);
    }

    public function fetchalldatacondition($srch, $s_date, $category)
    {
        $sql = "SELECT * FROM `daata` WHERE (title LIKE '%$srch%' OR '%$srch%'='') AND (publish_date='$s_date' OR '$s_date'='') AND (category LIKE '$category%' OR '%$category%'='')";
        return $this->executeQuery($sql);
    }

    private function executeQuery($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        $fetch = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $fetch[] = $row;
            }
        }
        return $fetch;
    }

    public function deletedata($dbtab, $id)
    {
        $sql = "DELETE FROM `$dbtab` WHERE id='$id'";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            echo "<script>alert('Post Deleted Successfully'); window.location.href='http://localhost/cont/home.php'</script>";
        } else {
            echo "<script>alert('Error Deleting Post'); </script>";

        }
    }

    public function editpost($title, $content, $img, $tag, $id)
    {
        if (!empty($img)) {
            $sql = "UPDATE `daata` SET title='$title', content='$content', img='$img', category='$tag' WHERE id='$id'";
            $result = mysqli_query($this->conn, $sql);

            if ($result) {
                echo "<script>alert('Post Updated Successfully'); window.location.href='http://localhost/cont/home.php'</script>";
            } else {
                echo "<script>alert('Error! Post NOT Updated')</script>";
            }
        } else {
            $sql = "UPDATE `daata` SET title='$title', content='$content', category='$tag' WHERE id='$id'";
            $result = mysqli_query($this->conn, $sql);

            if ($result) {
                echo "<script>alert('Post Updated Successfully'); window.location.href='http://localhost/cont/home.php'</script>";
            } else {
                echo "<script>alert('Error! Post NOT Updated')</script>";
            }
        }
    }

    public function search($query, $id)
    {
        $sql = "SELECT * FROM `daata` WHERE title LIKE '%$query%' AND author_id='$id' LIMIT 4";
        return $this->executesearch($sql);
    }

    public function searchforall($query)
    {
        $sql = "SELECT * FROM `daata` WHERE title LIKE '%$query%' LIMIT 5;";
        return $this->executesearch($sql);
    }

    private function executesearch($sql)
    {
        echo "
        <style>
            .searching{
                width: 100%;
                text-decoration: none;                     
                background-color: #fff;
                border: 1px solid lightgrey;
                margin: 0 0%;
                display: grid;
                padding:1%;
                color: black;
            }
            .result{
                position: absolute;
                width:25%;
                box-shadow: 2px 2px 10px 10px rgba(0,0,0,0.3);
                margin: 0 3%;
            }
        </style>";

        $result = mysqli_query($this->conn, $sql);
        $fetch = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $fetch[] = $row;
                echo "<a href='view.php?id=$row[id]' class='searching'>$row[title]</a>";

            }
        } else {
            echo "Found Nothing";
        }
        return $fetch;
    }

    public function sortdateforall($sdate, $edate)
    {
        $sql = "SELECT * FROM `daata` WHERE `publish_date` BETWEEN '$sdate' AND '$edate'";
        return $this->executedate($sql);

    }

    public function sortdate($id, $sdate, $edate)
    {
        $sql = "SELECT * FROM `daata` WHERE author_id='$id' AND `publish_date` BETWEEN '$sdate' AND '$edate'";
        return $this->executedate($sql);
    }

    private function executedate($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        $fetch = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $fetch[] = $row;
            }
        }
        return $fetch;
    }
}