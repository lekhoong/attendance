<?php
include_once("attendancedb.php");

class db extends database {
    public function __construct() {
        $this->dbconnect();
    }

    public function getStudents($date = null, $course = null, $status = null) {
        if ($date && $course && $status) {
            $stmt = $this->conn->prepare("SELECT * FROM `student` WHERE DATE(`time`) = ? AND `course` = ? AND `status` = ?");
            $stmt->bind_param("sss", $date, $course, $status);
        } elseif ($date && $course) {
            $stmt = $this->conn->prepare("SELECT * FROM `student` WHERE DATE(`time`) = ? AND `course` = ?");
            $stmt->bind_param("ss", $date, $course);
        } elseif ($date && $status) {
            $stmt = $this->conn->prepare("SELECT * FROM `student` WHERE DATE(`time`) = ? AND `status` = ?");
            $stmt->bind_param("ss", $date, $status);
        } elseif ($course && $status) {
            $stmt = $this->conn->prepare("SELECT * FROM `student` WHERE `course` = ? AND `status` = ?");
            $stmt->bind_param("ss", $course, $status);
        } elseif ($date) {
            $stmt = $this->conn->prepare("SELECT * FROM `student` WHERE DATE(`time`) = ?");
            $stmt->bind_param("s", $date);
        } elseif ($course) {
            $stmt = $this->conn->prepare("SELECT * FROM `student` WHERE `course` = ?");
            $stmt->bind_param("s", $course);
        } elseif ($status) {
            $stmt = $this->conn->prepare("SELECT * FROM `student` WHERE `status` = ?");
            $stmt->bind_param("s", $status);
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM `student`");
        }
        $stmt->execute();
        return $stmt->get_result();
    }

  public function login($id) {
    
    $qry = $this->conn->prepare("SELECT `student`, `course` FROM `student_list` WHERE `card_number` = ?");
    $qry->bind_param("s", $id);
    $qry->execute();
    $result = $qry->get_result();
    
    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $student_id = $row['student'];
        $cou = $row['course'];

      
        $check_today = $this->conn->prepare("SELECT COUNT(*) as cnt FROM `student` WHERE `student` = ? AND `course` = ? AND DATE(`time`) = CURDATE()");
        $check_today->bind_param("ss", $student_id, $cou);
        $check_today->execute();
        $check_today_result = $check_today->get_result();
        $count_row = $check_today_result->fetch_assoc();
        $count = $count_row['cnt'];

        
        $status = ($count % 2 == 0) ? 'checkin' : 'checkout';

        $in_query = $this->conn->prepare("INSERT INTO `student` (student, course, status) VALUES (?, ?, ?)");
        $in_query->bind_param("sss", $student_id, $cou, $status);
        if ($in_query->execute()) {
            return array("success" => true, "student_name" => $student_id, "time" => date("h:i:s A"), "status" => $status);
        } else {
            return array("success" => false, "message" => "false");
        }
    } else {
        return array("success" => false, "message" => "card number not found");
    }



    }

    public function adminlogin($user, $pwd) {
        $stmt = $this->conn->prepare("SELECT * FROM `user` WHERE `username` = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($pwd === $row['password']) {
                return array("success" => true, "message" => "Login successful");
            } else {
                return array("success" => false, "message" => "Wrong password");
            }
        } else {
            return array("success" => false, "message" => "Wrong username");
        }
    }

    public function addStudent($student, $course, $card_number) {
        $stmt = $this->conn->prepare("INSERT INTO `student_list` (`student`, `course`, `card_number`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $student, $course, $card_number);
    
        if ($stmt->execute()) {
            return array("success" => true, "message" => "Student added successfully.");
        } else {
            return array("success" => false, "message" => "Error adding student.");
        }
    }
}
?>
