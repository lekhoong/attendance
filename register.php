<?php 
include_once('functionattendance.php');

$qry = new db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student = $_POST['student'];
    $course = $_POST['course'];
    $card_number = $_POST['card_number'];
    $db_qry = $qry->addStudent($student, $course, $card_number);
    $message = $db_qry['message'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Add Student</h1>
                    </div>
                    <div class="card-body">
                        <?php if (isset($message)): ?>
                            <div class="alert alert-info"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <form action="register.php" method="post">
                            <div class="form-group">
                                <label for="student">Student Name</label>
                                <input type="text" class="form-control" name="student" required placeholder="Student Name">
                            </div>
                            <div class="form-group">
                                <label for="course">Course</label>
                                <select name="course" class="form-control" required>
                                    <option value="programming">Programming</option>
                                    <option value="science">Science</option>
                                    <option value="math">Math</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="card_number">Card Number</label>
                                <input type="text" class="form-control" name="card_number" required placeholder="Card Number">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Add Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
