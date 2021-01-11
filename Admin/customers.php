<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'cedcab');
if ($con) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <title>Document</title>
        <style>
        </style>
    </head>

    <body>
        <?php include 'header.php' ?>
        <div class="container" id="div1">
            <form method="POST" id="form">
            </form>
        </div>
        <?php
        $sql = "select user_id,email_id,name,dateofsignup,mobile from user where status='0'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>UserId</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Date of SignUp</th>
                        <th>Mobile</th>
                        <th></th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        foreach ($row as $x => $y) {
                            echo '<td>', $y, '</td>';
                        }
                    ?>
                        <td><button value="<?php echo $row['user_id']; ?>" name="unblock" form="form" class="btn btn-success">Unblock</button></td>
                <?php
                        echo '</tr>';
                    }
                }
                ?>
                </table>
            </div>
            <?php
            $sql = "select user_id,email_id,name,dateofsignup,mobile from user where status='1'";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>UserId</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Date of SignUp</th>
                            <th>Mobile</th>
                            <th></th>
                        </tr>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            foreach ($row as $x => $y) {
                                echo '<td>', $y, '</td>';
                            }
                        ?>
                            <td><button value="<?php echo $row['user_id']; ?>" name="block" form="form" class="btn btn-danger">Block</button></td>
                    <?php
                            echo '</tr>';
                        }
                    }
                    ?>
                    </table>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
    if (isset($_POST['block'])) {
        $item = $_POST['block'];
        $sql2 = "UPDATE user set status='" . 0 . "' WHERE user_id='" . $item . "'";
        if ($con->query($sql2)) {
            echo "<script>alert('Success');window.location.href='customers.php';</script>";
        } else {
            echo "ERROR:", $con->error;
        }
    }

    if (isset($_POST['unblock'])) {
        $item = $_POST['unblock'];
        $sql2 = "UPDATE user set status='" . 1 . "' WHERE user_id='" . $item . "'";
        if ($con->query($sql2)) {
            echo "<script>alert('Success');window.location.href='customers.php';</script>";
        } else {
            echo "ERROR:", $con->error;
        }
    }
} else {
    die("connection to this database failed due to" . mysqli_connect_error());
}
?>