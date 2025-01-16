<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Marks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Enter Student Marks</h1>
    <form action="insert_marks.php" method="POST">
        <div class="mb-3">
            <label for="registration_no" class="form-label">Registration Number</label>
            <input type="text" class="form-control" id="registration_no" name="registration_no" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Student Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="subject1" class="form-label">Subject 1 Marks</label>
            <input type="number" class="form-control" id="subject1" name="subject1" required>
        </div>
        <div class="mb-3">
            <label for="subject2" class="form-label">Subject 2 Marks</label>
            <input type="number" class="form-control" id="subject2" name="subject2" required>
        </div>
        <div class="mb-3">
            <label for="subject3" class="form-label">Subject 3 Marks</label>
            <input type="number" class="form-control" id="subject3" name="subject3" required>
        </div>
        <div class="mb-3">
            <label for="subject4" class="form-label">Subject 4 Marks</label>
            <input type="number" class="form-control" id="subject4" name="subject4" required>
        </div>
        <div class="mb-3">
            <label for="subject5" class="form-label">Subject 5 Marks</label>
            <input type="number" class="form-control" id="subject5" name="subject5" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit Marks</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "school");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $registration_no = $conn->real_escape_string($_POST['registration_no']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $name = $conn->real_escape_string($_POST['name']);
    $subject1 = (int)$_POST['subject1'];
    $subject2 = (int)$_POST['subject2'];
    $subject3 = (int)$_POST['subject3'];
    $subject4 = (int)$_POST['subject4'];
    $subject5 = (int)$_POST['subject5'];

    $sql = "INSERT INTO students (registration_no, dob, name, subject1, subject2, subject3, subject4, subject5) 
            VALUES ('$registration_no', '$dob', '$name', $subject1, $subject2, $subject3, $subject4, $subject5)";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Marks inserted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
