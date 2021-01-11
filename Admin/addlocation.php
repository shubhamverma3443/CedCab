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
        <div class="container my-5">
            <form method="POST">
                <div class="row">
                    <div class="col-md my-2">
                        <input type="text" name="loc" placeholder="Location" class="form-control" required>
                    </div>
                    <div class="col-md my-2">
                        <input type="number" name="dis" placeholder="Distance from Charbagh" class="form-control" required>
                    </div>
                    <div class="col-md-1 my-2">
                        <input type="submit" name="add" value="Add" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>


        <div class="container" id="div1">
            <form method="POST" id="form">
            </form>
        </div>
        <?php
        $sql = "select * from location";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Distance</th>
                        <th>Availability</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        foreach ($row as $x => $y) {
                            echo '<td>', $y, '</td>';
                        }
                        if ($row['is_available'] == 1) {
                            $i++;
                            if ($i > 1) {
                    ?>
                                <td><button value="<?php echo $row['id']; ?>" name="unav" form="form" class="btn btn-danger">Unavailable</button></td>
                                <td><button value="<?php echo $row['id']; ?>" name="del" form="form" class="btn btn-danger">Delete</button></td>
                            <?php
                                echo '</tr>';
                            }
                        } else {
                            $i++;
                            if ($i > 1) {
                            ?>
                                <td><button value="<?php echo $row['id']; ?>" name="av" form="form" class="btn btn-success">Available</button></td>
                                <td><button value="<?php echo $row['id']; ?>" name="del" form="form" class="btn btn-danger">Delete</button></td>
                <?php
                                echo '</tr>';
                            }
                        }
                    }
                }
                ?>
                </table>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
    if (isset($_POST['del'])) {
        $item = $_POST['del'];
        $sql2 = "delete from location where id='$item'";
        if ($con->query($sql2)) {
            echo "<script>alert('Success');window.location.href='addlocation.php';</script>";
        } else {
            echo "ERROR:", $con->error;
        }
    }
    if (isset($_POST['add'])) {
        $data1 = $_POST['loc'];
        $data2 = $_POST['dis'];
        $sql3 = "insert into location (id,name,distance,is_available) values(NULL, '$data1', '$data2', '1')";
        if ($con->query($sql3)) {
            echo "<script>alert('Success');window.location.href='addlocation.php';</script>";
        } else {
            echo "<script>alert('Add Again')</script>";
        }
    }
    if (isset($_POST['unav'])) {
        $item2 = $_POST['unav'];
        $sql2 = "UPDATE location set is_available='" . 0 . "' WHERE id='" . $item2 . "'";
        if ($con->query($sql2)) {
            echo "<script>alert('Success');window.location.href='addlocation.php';</script>";
        } else {
            echo "ERROR:", $con->error;
        }
    }
    if (isset($_POST['av'])) {
        $item3 = $_POST['av'];
        $sql2 = "UPDATE location set is_available='" . 1 . "' WHERE id='" . $item3 . "'";
        if ($con->query($sql2)) {
            echo "<script>alert('Success');window.location.href='addlocation.php';</script>";
        } else {
            echo "ERROR:", $con->error;
        }
    }
} else {
    die("connection to this database failed due to" . mysqli_connect_error());
}
?>