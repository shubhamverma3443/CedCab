<?php
session_start();
$name = $_SESSION['uname'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Profile</title>
</head>

<body>
    <?php include 'header.php' ?>
    <div class="container">
    <div class="row">
        <div class="col-md-8">
            <img src="userlogo_50.png" class="img-fluid mx-auto d-block" alt="...">
            <div class="container p-5 shadow ">
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'cedcab');
                if ($con) {
                    $sql = "select * from login where type='admin'";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                ?>
                            <div class="row mb-2">
                                <div class="col-md text-center">
                                    <h2>Name :</h2>
                                </div>
                                <div class="col-md text-center"><?php echo $row['name'] ?></div>
                            </div>
                    <?php
                        }
                    }
                    ?>
            </div>
        </div>
        <div class="col-md">
            <div class="row my-5 text-center justify-content-around">
                <?php
                    $sql2 = "select sum(total_fare) as sum from ride where status='2'";
                    $result = $con->query($sql2);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                ?>
                        <div class="col-10 p-3 shadow">
                            <h1>Total Earning</h1>
                            <h2 class="text-danger"><i class="fa fa-inr p-1" aria-hidden="true"></i><?php echo $row['sum'] ?></h2>
                        </div>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="row my-5 text-center justify-content-around">
                <?php
                    $sql3 = "select count(total_fare) as fare from ride where status='2'";
                    $result = $con->query($sql3);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                ?>
                        <div class="col-10 shadow p-3">
                            <h1>Total Number of rides</h1>
                            <h2 class="text-danger"><?php echo $row['fare'] ?></h2>
                        </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    </div>
<?php
                }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>