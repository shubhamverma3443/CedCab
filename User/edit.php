<?php
session_start();
$uname = $_SESSION['uname'];
$con = mysqli_connect('localhost', 'root', '', 'cedcab');
if ($con) {
    if (isset($_POST['submit'])) {
        $sql2 = "UPDATE user set name='" . $_POST['name'] . "', mobile='" . $_POST['mobile'] . "', password='" . $_POST['pass'] . "' WHERE email_id='" . $uname . "'";
        $sql3 = "UPDATE login set password='" . $_POST['pass'] . "' WHERE name='$uname'";
        if ($con->query($sql2) && $con->query($sql3)) {
            echo "<script>alert('Success');window.location.href='profile.php';</script>";
        } else {
            echo "ERROR:", $con->error;
        }
    }
    $sql = "select * from user where email_id='$uname'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
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

                    #outer {
                        width: 75%;
                    }

                    #motp,
                    #motpVerify {
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

                        #outer {
                            width: 98%;
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
                            <div class="row my-3">
                                <a href="index.php" class="text-decoration-none text-dark">
                                    <div class="col h5"><i class="fa fa-taxi p-1  text-muted"></i>Book Cab</div>
                                </a>
                            </div>
                            <div class="row my-3">
                                <a href="history.php" class="text-decoration-none text-dark">
                                    <div class="col h5"><i class="fa fa-history p-1 text-muted"></i>History</div>
                                </a>
                            </div>
                            <div class="row my-3 p-1 bg-success shadow rounded">
                                <a href="edit.php" class="text-decoration-none text-light">
                                    <div class="col h5"><i class="fa fa-pencil p-1 text-light"></i>Edit</div>
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
                        <div class="col-md-10 border">
                            <div class="container my-5 p-5 shadow" id="outer">
                                <form method="POST">
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <lable>Name</lable>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-4">
                                            <label>Mobile Number</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" name="mobile" class="form-control" value="<?php echo $row['mobile']; ?>" id="mobile" required>
                                        </div>
                                        <div class="col-2 p-0">
                                            <input type="button" class="btn btn-success" id="mVerify" value="Verify" style="display: none;">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-4 mb-1"></div>
                                        <div class="col-md-6">
                                            <input type="number" name="motp" id="motp" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-1">
                                            <button class="btn btn-success" id="motpVerify" type="button">Verify</button>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <label>Password</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="pass" class="form-control" value="<?php echo $row['password']; ?>" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100" name="submit" id="edt">Update</button>
                                </form>
                            </div>
                        </div>
                        <!-- ---- -->
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            </body>

            </html>
<?php
        }
    }
}
?>
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
    var mno = $('#mobile').val();
    $('#mobile').keyup(function() {
        console.log(mno);
        if ($('#mobile').val() != mno) {
            $('#edt').attr('disabled', true);
            $('#mVerify').css('display', 'block');
        } else {
            $('#edt').attr('disabled', false);
            $('#mVerify').css('display', 'none');
        }
    })
    $('#mVerify').click(function() {
        $.post(
            '../Common/mobile.php', {
                mobile: $('#mobile').val(),
            },
            function(response) {
                $('#mVerify').val(response);
            }
        )
        $('#motp').css('display', 'block');
        $('#motpVerify').css('display', 'block');

    });
    $('#motpVerify').click(function() {
        $.post(
            '../Common/verify.php', {
                mval: $('#motp').val(),
                count: 2
            },
            function(response) {
                if (response == "success") {
                    alert('Mobile OTP Verified');
                    $('#motp').css('display', 'none');
                    $('#motpVerify').css('display', 'none');
                    $('#mVerify').val('Verified');
                    $('#mVerify').prop('disabled', true);
                    $('#edt').attr('disabled', false);
                    //$('#email').attr({ type:"button", value:$('#email').val() });
                } else {
                    alert('Mobile OTP Verification fail..');
                }
            })
    })
</script>