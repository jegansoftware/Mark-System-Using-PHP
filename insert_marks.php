<?php
$conn = new mysqli("localhost", "root", "", "school");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $registration_no = $conn->real_escape_string($_POST['registration_no']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $name = $conn->real_escape_string($_POST['name']);
    $subject1 = $conn->real_escape_string($_POST['subject1']);
    $subject2 = $conn->real_escape_string($_POST['subject2']);
    $subject3 = $conn->real_escape_string($_POST['subject3']);
    $subject4 = $conn->real_escape_string($_POST['subject4']);
    $subject5 = $conn->real_escape_string($_POST['subject5']);

    $sql = "INSERT INTO students (registration_no, dob, name, subject1, subject2, subject3, subject4, subject5) 
            VALUES ('$registration_no', '$dob', '$name', '$subject1', '$subject2', '$subject3', '$subject4', '$subject5')";

    if ($conn->query($sql) === TRUE) {
        $message = "Student marks inserted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch all student records
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Marks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .message {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Enter Student Marks</h2>

        <!-- Display Success or Error Messages -->
        <?php if (isset($message)) : ?>
            <div class="alert alert-info message">
                <?= $message; ?>
            </div>
        <?php endif; ?>

        <!-- Student Marks Form -->
        <form action="insert_marks.php" method="POST" class="mb-4">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="registration_no" class="form-label">Registration Number</label>
                    <input type="text" class="form-control" id="registration_no" name="registration_no" required>
                </div>
                <div class="col-md-4">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="col-md-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="subject1" class="form-label">Tamil</label>
                    <input type="number" class="form-control" id="subject1" name="subject1" required>
                </div>
                <div class="col-md-2">
                    <label for="subject2" class="form-label">English</label>
                    <input type="number" class="form-control" id="subject2" name="subject2" required>
                </div>
                <div class="col-md-2">
                    <label for="subject3" class="form-label">Mathematics</label>
                    <input type="number" class="form-control" id="subject3" name="subject3" required>
                </div>
                <div class="col-md-2">
                    <label for="subject4" class="form-label">Science</label>
                    <input type="number" class="form-control" id="subject4" name="subject4" required>
                </div>
                <div class="col-md-2">
                    <label for="subject5" class="form-label">Social Science</label>
                    <input type="number" class="form-control" id="subject5" name="subject5" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit Marks</button>
        </form>

        <!-- Student Marks Table -->
        <h3 class="text-center mb-4">All Students</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>S.No</th>
                    <th>Registration No</th>
                    <th>Name</th>
                    <th>Tamil</th>
                    <th>English</th>
                    <th>Mathematics</th>
                    <th>Science</th>
                    <th>Social Science</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr class="text-center">
                            <td><?= $i++; ?></td>
                            <td><?= $row['registration_no']; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['subject1']; ?></td>
                            <td><?= $row['subject2']; ?></td>
                            <td><?= $row['subject3']; ?></td>
                            <td><?= $row['subject4']; ?></td>
                            <td><?= $row['subject5']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
