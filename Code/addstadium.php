<?php

extract($_POST);

$alertMessage = "";
$msg = "";

if (isset($sbtpic)) {
    foreach ($_FILES["attachfile"]["name"] as $k => $v) {

        if (((($_FILES["attachfile"]["type"][$k] == "image/gif") || ($_FILES["attachfile"]["type"][$k] == "image/jpeg")
                || ($_FILES["attachfile"]["type"][$k] == "image/png") || ($_FILES["attachfile"]["type"][$k] == "image/jpg")
                || ($_FILES["attachfile"]["type"][$k] == "image/pjpeg")) && ($_FILES["attachfile"]["size"][$k] < 1000000))) {

            if ($_FILES["attachfile"]["error"][$k] > 0)
                $msg = "Error code: " . $_FILES["attachfile"]["error"][$k] . ".";
            else {
                $fileinfo = pathinfo($_FILES["attachfile"]["name"][$k]);
                $ftype = $fileinfo['extension'];
            
                $picname = "pic" . time() . uniqid(rand()) . ".$ftype";

               
                move_uploaded_file($_FILES["attachfile"]["tmp_name"][$k], "Pic/$picname");
                

                require('connection.php');
                try {

                    $pitchid = $selected;
                    $stmt = $db->prepare("INSERT INTO grounds VALUES(null, ?, ?, ?, ?, ?)");
                    $stmt->execute([$pitchid, $stdname, $stdprice, $stddesc, $picname]);
                    if ($stmt->rowCount() > 0) {
                        $alertMessage = "<div class='alert alert-success' role='alert'>
                                            <h4 class='alert-heading'>Well done!</h4>
                                            <p>Successfully Inserted</p>
                                        </div>";
                    } else {
                        $alertMessage = "<div class='alert alert-danger' role='alert'>
                                            <h4 class='alert-heading'>Oops!</h4>
                                            <p>Insertion failed</p>
                                        </div>";
                    }

                    $db = null;
                } catch (PDOException $ex) {
                    echo $ex->getMessage();
                }
            }
        } else {
            $fileinfo = pathinfo($_FILES["attachfile"]["name"][$k]);
            $ftype = $fileinfo['extension'];
            echo "Invalid File Type: $ftype <br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php require('header.php'); ?>

    <section>
        <?php echo $alertMessage; ?>
        <form method="post" enctype="multipart/form-data">
            <div class="p-4">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">City</label>
                    <?php
                    require('connection.php');
                    try {
                        $rv = $db->query("SELECT * FROM city");
                        echo "<select class='form-select' name='selected'>";
                        foreach ($rv as $row) {
                            echo "<option value='" . $row[1] . "'>" . $row[1] . "</option>";
                        }
                        echo "</select> <br>";
                        $db = null;
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Stadium Name</label>
                    <input type="text" class="form-control" name="stdname">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Price</label>
                    <input type="number" class="form-control" name="stdprice">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" name="stddesc" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Stadium Picture</label>
                    <input type="file" name="attachfile[]" multiple>
                    <input type="submit" name="sbtpic" value="Upload Ground" style="background-color:lightblue">
                </div>
            </div>
        </form>
    </section>

    <?php require('footer.php'); ?>
</body>

</html>
