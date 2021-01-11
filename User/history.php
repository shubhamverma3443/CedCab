<?php
session_start();
$uid = $_SESSION['userid'];
$con = mysqli_connect('localhost', 'root', '', 'cedcab');
if ($con) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <title>Document</title>
        <style>
            #col {
                min-height: 90vh !important;
                font-family: 'Roboto', sans-serif;
            }

            #toggle {
                display: none;
            }

            @media only screen and (max-width: 767px) {
                #toggle {
                    display: block;
                }

                #col {
                    min-height: fit-content !important;
                }

                #lgot {
                    display: none;
                }
            }
        </style>
    </head>

    <body>
        <form id="form" method="POST">
        </form>
        <div class="container-fluid bg-dark">
            <div class="row p-2">
                <div class="col">
                    <h1 class="me-md-auto fw-normal text-light"><span class="text-success">C</span>ed<span class="text-success">C</span>ab</h1>
                </div>
                <div class="col">
                    <a class="btn btn-outline-success float-end" href="logout.php" id="lgot">Logout</a>
                    <h1 class="fa fa-bars navbar-toggler float-end text-light" style="font-size: 25px;" id="toggle"></h1>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 border bg-light" id="col">
                    <div class="row my-3">
                        <div class="col text-success h5"><i class="fa fa-home p-1 text-success"></i>Dashboard</div>
                    </div>
                    <div class="row my-3">
                        <a href="index.php" class="text-decoration-none text-dark">
                            <div class="col h5"><i class="fa fa-taxi p-1  text-muted"></i>Book Cab</div>
                        </a>
                    </div>
                    <div class="row my-3 p-1 bg-success shadow rounded">
                        <a href="history.php" class="text-decoration-none text-light">
                            <div class="col h5"><i class="fa fa-history p-1 text-light"></i>History</div>
                        </a>
                    </div>
                    <div class="row my-3">
                        <a href="edit.php" class="text-decoration-none text-dark">
                            <div class="col h5"><i class="fa fa-pencil p-1 text-muted"></i>Edit</div>
                        </a>
                    </div>
                    <div class="row my-3">
                        <a href="profile.php" class="text-decoration-none text-dark">
                            <div class="col h5"><i class="fa fa-user p-1 text-muted"></i>Profile</div>
                        </a>
                    </div>
                    <div class="row my-3">
                        <a href="logout.php" class="text-decoration-none text-dark">
                            <div class="col h5"><i class="fa fa-sign-out p-1 text-muted"></i></i>Logout</div>
                        </a>
                    </div>
                </div>
                <!-- Main code starts from here -->
                <div class="col-md-10 border overflow-auto">
                        <?php include 'sort.php' ?>
                    <div class="container" id="div1">
                        <form method="POST" id="form">
                        </form>
                    </div>
                    <?php
                    $sql = "select ride_id,ride_date,cab_type,ride_from,ride_to,total_distance,luggage,total_fare,status from ride where customer_user_id='$uid' ORDER BY ride_date  desc ";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                    ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <tr>
                                    <th>SNo.</th>
                                    <th>Ride Id</th>
                                    <th>Ride Date</th>
                                    <th>Cab Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Total Distance(km)</th>
                                    <th>Luggage(kg)</th>
                                    <th>Total Fare(Rs)</th>
                                    <th>Status</th>
                                </tr>
                            <?php
                            $i=1;
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>',$i,'</td>';
                                foreach ($row as $x => $y) {
                                    if($x=='status'){
                                        if($y=='0'){
                                            echo '<td>', 'Cancelled';
                                        }elseif($y=='1'){
                                            echo '<td class="table-light">', 'Pending';
                                            ?>
                                            <button value="<?php echo $row['ride_id']; ?>" class="btn btn-danger float-end" name="cancel" form="form"><i class="fa fa-times" aria-hidden="true"></i></button></td>
                                            <?php
                                        }elseif($y=='2'){
                                            echo '<td>', 'Completed', '</td>';
                                        }
                                    }else{
                                        echo '<td>', $y, '</td>';
                                    }
                                }
                                echo '</tr>';
                                $i++;
                            }
                        }
                            ?>
                            </table>
                        </div>
                </div>
                <!-- ---- -->
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>

    </html>
    <script>
        if ($(window).width() == 767 || $(window).width() < 767) {
        $('#col').slideUp(10);
    }
        $(window).resize(function() {
            if ($(window).width() <= 767) {
                $('#col').slideUp(10);
            } else {
                $('#col').slideDown(1);
            }
        })
        $('#toggle').click(function() {
            $('#col').slideToggle();
        })
    </script>
<?php
if(isset($_POST['cancel'])){
    $data=$_POST['cancel'];
    $sql2 = "UPDATE ride set status='" . 0 . "' WHERE ride_id='$data'";
        if ($con->query($sql2)) {
            echo "<script>alert('Success');window.location.href='history.php';</script>";
        } else {
            echo "ERROR:", $con->error;
        }
}
}
?>