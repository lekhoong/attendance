<?php
include_once('functionattendance.php');

$qry = new db();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $db_qry = $qry->login($id);
    if ($db_qry['success']) {
        $message = "<div class='alert success'>Success! Welcome " . $db_qry['student_name'] . " (" . $db_qry['status'] . ")</div>";
    } else {
        

    
        $message = "<div class='alert fail'>Failed! " . $db_qry['message'] . "</div>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
    <style>
        .alert {
            padding: 20px;
            margin-bottom: 15px;
        }
        .alert.success {background-color: #4CAF50;}
        .alert.fail {background-color: #f44336;}
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .closebtn:hover {color: black;}
    </style>
</head>
<body>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="attendance.php" id="time">TIME</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="login.php">RECORD</a>
        </li>
    </ul>
    <?php echo $message; ?>

    <form action="attendance.php" method="post" style="padding-top: 100px; font-size: 30px;">
        <div align="center">
            <input type="text" 
                   onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 13' 
                   name="id" 
                   autofocus 
                   required 
                   style="font-size: 60px;" 
                   autocomplete="off">
            <input type="submit" 
                   name="submit" 
                   value="Submit" 
                   style="font-size: 60px;">
        </div>
        <h1 id="timer" style="font-size: 150px; text-align: center; margin: 50px 0;"></h1>
    </form>

    <script>
        setInterval(function() {
            var currentTime = new Date();
            var options = {
                timeZone: 'Asia/Kuala_Lumpur',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            var currentTimeString = new Intl.DateTimeFormat('en-US', options).format(currentTime);
            document.getElementById("timer").innerHTML = currentTimeString;
        }, 1000);

        var closeButtons = document.getElementsByClassName("closebtn");
        for (var i = 0; i < closeButtons.length; i++) {
            closeButtons[i].onclick = function() {
                var div = this.parentElement;
                div.style.opacity = "0";
                setTimeout(function() { div.style.display = "none"; }, 600);
            }
        }

        const myTimeout = setTimeout(timeout, 4000);
        function timeout() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.remove();
            });
        }

        document.querySelectorAll(".nav-link").forEach(function(navItem) {
            navItem.classList.remove("active");
        });
        document.getElementById("time").classList.add("active");
    </script>
</body>
</html>
