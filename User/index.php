<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="index.css">
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

        #new {
            display: flex;
            justify-content: center;
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
                <div class="row my-3 p-1 bg-success shadow rounded">
                    <a href="index.php" class="text-decoration-none text-light">
                        <div class="col h5"><i class="fa fa-taxi p-1  text-light"></i>Book Cab</div>
                    </a>
                </div>
                <div class="row my-3">
                    <a href="history.php" class="text-decoration-none text-dark">
                        <div class="col h5"><i class="fa fa-history p-1 text-muted"></i>History</div>
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
            <div class="col-md-10 border p-5 overflow-auto">
                <?php
                session_start();
                $name = $_SESSION['uname'];
                $con = mysqli_connect('localhost', 'root', '', 'cedcab');
                if ($con) {
                    $sql2 = "select user_id from user where email_id='$name'";
                    $result = $con->query($sql2);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $_SESSION['userid'] = $row['user_id'];
                        }
                    }
                ?>
                    <div id="new">
                        <?php include 'bookdata.php'; ?>
                    </div>
                <?php
                } else {
                    header('location: ../Common/home.php');
                } ?>
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
        if ($(window).width() == 767 || $(window).width() < 767) {
            $('#col').slideUp(10);
        } else {
            $('#col').slideDown(10);
        }
    })
    $('#toggle').click(function() {
        $('#col').slideToggle();
    })
</script>