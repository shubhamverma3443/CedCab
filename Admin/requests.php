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
        $sql = "select 	customer_user_id,ride_id,ride_date,cab_type,ride_from,ride_to,total_distance,luggage,total_fare from ride where status='1'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>User Id</th>
                        <th>Ride Id</th>
                        <th>Ride Date</th>
                        <th>Cab Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total Distance</th>
                        <th>Luggage</th>
                        <th>Total Fare</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        foreach ($row as $x => $y) {
                            echo '<td>', $y, '</td>';
                        }
                    ?>
                        <td><button value="<?php echo $row['ride_id']; ?>" name="update" form="form" class="btn btn-success">Approve</button></td>
                        <td><button value="<?php echo $row['ride_id']; ?>" name="dele" form="form" class="btn btn-danger">Cancel</button></td>
                    <?php
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
        }
        if (isset($_POST['dele'])) {
            $item = $_POST['dele'];
            $sql2 = "UPDATE ride set status='" . 0 . "' WHERE ride_id='" . $item . "'";
            if ($con->query($sql2)) {
                echo "<script>alert('Success');window.location.href='requests.php';</script>";
            } else {
                echo "ERROR:", $con->error;
            }
        }

        if (isset($_POST['update'])) {
            $item = $_POST['update'];
            $sql2 = "UPDATE ride set status='" . 2 . "' WHERE ride_id='" . $item . "'";
            if ($con->query($sql2)) {
                echo "<script>alert('Success');window.location.href='requests.php';</script>";
            } else {
                echo "ERROR:", $con->error;
            }
        }

    } else {
        die("connection to this database failed due to" . mysqli_connect_error());
    }
?>