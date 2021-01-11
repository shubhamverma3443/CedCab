<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(180deg,
                    rgb(21, 115, 71, 1) 40%,
                    rgb(0, 0, 0, 0) 0%);
            background-size: 100% 150%;
            background-repeat: no-repeat;
        }
        @media only screen and (max-width: 600px) {
            #outer {
                width: 90% !important;
                margin: auto !important;
                margin-top: 50px !important;
                /* margin-bottom: 50px !important; */
            }
        }
    </style>
    <title>SignUp</title>
</head>

<body>
    <h1 class="display-4 fw-normal text-light text-center mt-5">Hello, Friend!</h1>
    <p class="fs-4 text-light text-center">Enter your personal details to start journey with us.</p>
    <div class="container w-50 px-5 pb-5 pt-2 my-5 bg-light shadow rounded border" id="outer">
    <a href="home.php" class="text-decoration-none text-dark"><h1 class=" text-center fw-normal my-4"><span class="text-success">C</span>ed<span class="text-success">C</span>ab</h1></a>
        <form method="POST">
            <div class="row mb-2 justify-content-around">
                <div class="col-md-9 p-0">
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail" required>
                </div>
                <div class="col-md-2 p-0">
                    <input type="button" class="btn btn-success" id="eVerify" value="Send OTP">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <input type="number" name="eotp" id="eotp" class="form-control">
                </div>
                <div class="col">
                    <button class="btn btn-success" id="eotpVerify" type="button">Verify</button>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" maxlength="25" required>
                </div>
            </div>

            <div class="row mb-2 justify-content-around">
                <div class="col-md-9 p-0">
                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" required>
                </div>
                <div class="col-md-2 p-0">
                    <input type="button" class="btn btn-success" id="mVerify" value="Send OTP">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md">
                    <input type="number" name="motp" id="motp" class="form-control">
                </div>
                <div class="col-md">
                    <button class="btn btn-success" id="motpVerify" type="button">Verify</button>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md">
                    <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" maxlength="20" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success w-100" name="submit">Register</button>
                </div>
            </div>

        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
<script>
    var verifyC = 0;
    // $('#pname,#sname,#city').keypress(function(evt) {
    //     if (evt.which != 32 && evt.which != 46 && evt.which != 8 && evt.which != 0 && evt.which < 65 || evt.which > 90 && evt.which < 97 || evt.which > 122) {
    //         evt.preventDefault();
    //     }
    // })
    // $('#pname,#sname,#city').on("cut copy paste", function(e) {
    //     e.preventDefault();
    // });
    $(':input[type="submit"]').prop('disabled', true);
    $('#eVerify').prop('disabled', true);
    $('#mVerify').prop('disabled', true);
    $('#eotpVerify').css('display', 'none');
    $('#eotp').css('display', 'none');
    $('#motp').css('display', 'none');
    $('#motpVerify').css('display', 'none');
    $('#email').keyup(function() {
        if ($('#email').val() != '') {
            $('#eVerify').prop('disabled', false);
        } else {
            $('#eVerify').prop('disabled', true);
        }
    })
    $('#eVerify').click(function() {
        $.post(
            'sendmail.php', {
                email: $('#email').val(),
            },
            function(response) {
                $('#eVerify').val(response);
            }
        )
        $('#eotp').css('display', 'block');
        $('#eotpVerify').css('display', 'block');

    });
    $('#eotpVerify').click(function() {
        $.post(
            'verify.php', {
                value: $('#eotp').val(),
                count: 1
            },
            function(response) {
                if (response == "success") {
                    verifyC++;
                    alert('Email Verified');
                    $('#eotp').css('display', 'none');
                    $('#eotpVerify').css('display', 'none');
                    $('#eVerify').val('Verified');
                    $('#eVerify').prop('disabled', true);
                    if (verifyC > 1) {
                        $(':input[type="submit"]').prop('disabled', false);
                    }
                    //$('#email').attr({ type:"button", value:$('#email').val() });
                } else {
                    alert('Email Verification fail..');
                }
            }
        )
    })
    $('#mobile').keyup(function() {
        if ($('#mobile').val() != '') {
            $('#mVerify').prop('disabled', false);
        } else {
            $('#mVerify').prop('disabled', true);
        }
    })
    $('#mVerify').click(function() {
        $.post(
            'mobile.php', {
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
            'verify.php', {
                mval: $('#motp').val(),
                count: 2
            },
            function(response) {
                if (response == "success") {
                    verifyC++;
                    if (verifyC > 1) {
                        $(':input[type="submit"]').prop('disabled', false);
                    }
                    alert('Mobile OTP Verified');
                    $('#motp').css('display', 'none');
                    $('#motpVerify').css('display', 'none');
                    $('#mVerify').val('Verified');
                    $('#mVerify').prop('disabled', true);
                    //$('#email').attr({ type:"button", value:$('#email').val() });
                } else {
                    alert('Mobile OTP Verification fail..');
                }
            }
        )
    })
</script>
<?php
if (isset($_POST['submit'])) {
    $con = mysqli_connect('localhost', 'root', '', 'cedcab');
    $email = $_POST['email'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $password = $_POST['pass'];
    $sql = "INSERT INTO user (user_id, email_id, name, dateofsignup, mobile, status, password, is_admin) VALUES (NULL, '$email', '$name', current_timestamp(), '$mobile', '1', '$password', '0');";
    $sql2 = "INSERT INTO login (id, name, password, type) VALUES (NULL, '$email', '$password', 'user')";
    if ($con->query($sql) && $con->query($sql2)) {
        echo "<script>alert('Success');window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Try Again')</script>";
    }
}

?>