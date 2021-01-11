
<div class="bg-light px-5 p-5 pt-0 mx-auto my-5 pull-left rounded border shadow" id="outer">
    <img src="logo.png" class="img-fluid mx-auto d-block" alt="CedCab" style="height: 100px; width: 100px;">
    <form id="form">
        <div class="input-group input-group-sm mb-3" id="inner">
            <label class="input-group-text">PICKUP</label>
            <select name="currentL" id="currentL" class="form-control">
                <option value="">--Current location--</option>
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'cedcab');
                if ($con) {
                    $sql = "select name from location where is_available='1'";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                ?>
                            <option value=<?php echo $row['name'] ?>><?php echo $row['name'] ?></option>
                    <?php
                        }
                    }
                    ?>
            </select>
        </div>
        <div class="input-group input-group-sm my-3">
            <label class="input-group-text">DROP</label>
            <select name="dropL" id="dropL" class="form-control">
                <option value="">--Drop location--</option>
                <?php
                    $sql = "select name from location where is_available='1'";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                ?>
                        <option value=<?php echo $row['name'] ?>><?php echo $row['name'] ?></option>
            <?php
                        }
                    }
                }
            ?>
            </select>
        </div>
        <div class="input-group input-group-sm mb-3">
            <lable class="input-group-text">CAB TYPE</lable>
            <select name="cabType" id="cabType" class="form-control">
                <option value="">--CAB type--</option>
                <option value="CedMicro">CedMicro</option>
                <option value="CedMini">CedMini</option>
                <option value="CedRoyal">CedRoyal</option>
                <option value="CedSUV">CedSUV</option>
            </select>
        </div>
        <div class="input-group input-group-sm mb-3">
            <label class="input-group-text">Luggage</label>
            <input type="number" name="luggage" id="luggage" max="50" min="0" step="0.0001" class="form-control" placeholder="Enter weight in kg" />
        </div>
        <center><input type="submit" value="Calculate Fare" id="calc" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"></center>
    </form>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Fare Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 id="disp" class="my-2 modal-title fs-2 fw-normal">Luggage weight must not greater than 50kg
                </h1>
                <span id="warn">(Luggage should not greater than 50Kg)</span>
            </div>
            <div class="modal-footer">
                <a href="../User/book.php" class="text-decoration-none"><button type="button" class="btn btn-outline-success" id="book">Book Now</button></a>
                <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('#currentL').change(function() {
        $('#dropL option').prop('disabled', false);
        $('#dropL option[value="' + $("#currentL").val() + '"]').prop('disabled', 'disabled');
    })
    $('#dropL').change(function() {
        $('#currentL option').prop('disabled', false);
        $('#currentL option[value="' + $("#dropL").val() + '"]').prop('disabled', 'disabled');
    })
    $('#cabType').change(function() {
        $('#luggage').val('');
        $('#luggage').prop('disabled', false);
        $('#luggage').attr("placeholder", "Please enter luggage weight");
        if ($('#cabType').val() == "CedMicro") {
            $('#luggage').prop('disabled', 'disabled');
            $('#luggage').attr("placeholder", "CedMicro don't have option for luggage");
        }
    })
    $('#luggage').keypress(function(evt) {
        if ($('#luggage').val().length > 5) {
            $('#luggage').val($('#luggage').val().slice(0, 6));
        }
        if (evt.which != 46 && evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57) {
            evt.preventDefault();
        }
        if ($("#cabType").val() == "") {
            $("#disp").html('Please enter cab type!');
            $("#warn").css('display', 'none');
        } else {
            $("#disp").html('Please enter luggage values properly!');
            $('#book').css('display','none')
            $("#warn").css('display', 'block');
        }
    })
    $('#luggage').on("paste", function(evt) {
        evt.preventDefault();
    })
    $("#form").submit(function(e) {
        e.preventDefault();
        $("#warn").css('display', 'none');
        if ($("#currentL").val() == "" || $("#dropL").val() == "" || $("#cabType").val() == "") {
            if ($("#currentL").val() == "") {
                $("#disp").html('Please enter current location!');
                $('#book').css('display','none')
            } else if ($("#dropL").val() == "") {
                $("#disp").html('Please enter drop location!');
                $('#book').css('display','none')
            } else if ($("#cabType").val() == "") {
                $("#disp").html('Please enter cab type!');
                $('#book').css('display','none')
            }
        } else {
            $('#book').css('display','block')
            $.post(
                "../User/data.php", {
                    currentL: $("#currentL").val(),
                    dropL: $("#dropL").val(),
                    cabType: $("#cabType").val(),
                    luggage: $("#luggage").val(),
                    count: "1"
                },
                function(data) {
                    $("#disp").html(data);
                }
            );
        }
    });
</script>