<?php
include_once("functionattendance.php");

$db = new db();
$date = isset($_POST['date']) ? $_POST['date'] : null;
$course = isset($_POST['course']) ? $_POST['course'] : null;
$status = isset($_POST['status']) ? $_POST['status'] : null;

$qry = $db->getStudents($date, $course, $status);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .table .checkin {
            color: blue;
        }
        .table .checkout {
            color: red;
        }
    </style>
</head>
<body>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="attendance.php">TIME</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="record.php">RECORD</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="register.php">ADD STUDENT</a>
    </li>
    </ul>

    <div class="container" style="margin-top: 50px;">
        <form action="record.php" method="post" class="form-inline">
            <label for="date" class="mr-2">Select Date:</label>
            <input type="date" id="date" name="date" class="form-control mr-2" value="<?= htmlspecialchars($date, ENT_QUOTES, 'UTF-8') ?>">
            
            <label for="status" class="mr-2">Select Status:</label>
            <select id="status" name="status" class="form-control mr-2">
                <option value="" <?= $status == "" ? "selected" : "" ?>>All</option>
                <option value="checkin" <?= $status == "checkin" ? "selected" : "" ?>>Checkin</option>
                <option value="checkout" <?= $status == "checkout" ? "selected" : "" ?>>Checkout</option>
            </select>
            
            <label for="course" class="mr-2">Select Course:</label>
            <select id="course" name="course" class="form-control mr-2">
                <option value="" <?= $course == "" ? "selected" : "" ?>>All</option>
                <option value="programing" <?= $course == "programing" ? "selected" : "" ?>>Programming</option>
                <option value="science" <?= $course == "science" ? "selected" : "" ?>>Science</option>
                <option value="math" <?= $course == "math" ? "selected" : "" ?>>Math</option>
            </select>
            

            <input type="submit" class="btn btn-primary" value="Filter">
        </form>

        <table class="table table-striped mt-3">
            <tr>
                <th>STUDENT</th>
                <th>COURSE</th>
                <th>TIME</th>
                <th>STATUS</th>
            </tr>
            <?php while($row = $qry->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['student'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['course'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['time'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="<?= htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
