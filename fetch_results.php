<?php
$conn = new mysqli("localhost", "root", "", "school");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $registration_no = $conn->real_escape_string($_POST['registration_no']);
    $dob = $conn->real_escape_string($_POST['dob']);

    // Fetch student data
    $sql = "SELECT * FROM students WHERE registration_no='$registration_no' AND dob='$dob'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Subject names
        $subjects = [
            "Tamil",
            "English",
            "Mathematics",
            "Science",
            "Social Science"
        ];

        $total_marks = 0; // Initialize total marks
        $status = "Pass";

        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>SSLC Results</title>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css'>
            <style>
                .result-container {
                    margin-top: 50px;
                    animation: fadeIn 1s ease-in-out;
                }
                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
                .status-pass {
                    color: green;
                    font-weight: bold;
                }
                .status-fail {
                    color: red;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class='container result-container'>
                <h2 class='text-center mb-4'>SSLC Result</h2>
                <table class='table table-bordered table-striped text-center'>
                    <thead class='table-dark'>
                        <tr>
                            <th>S.No</th>
                            <th>Subject Name</th>
                            <th>Mark</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>";
        
        for ($i = 1; $i <= count($subjects); $i++) {
            $mark = $row["subject$i"];
            $subject_status = ($mark >= 35) ? "<span class='status-pass'>P</span>" : "<span class='status-fail'>F</span>";

            // Add the mark to the total
            $total_marks += $mark;

            // If any subject is failed, set overall status to Fail
            if ($mark < 35) {
                $status = "<span class='status-fail'>Fail</span>";
            }

            echo "<tr>
                <td>$i</td>
                <td>{$subjects[$i - 1]}</td>
                <td>$mark</td>
                <td>$subject_status</td>
            </tr>";
        }

        // Display total marks and overall status
        echo "</tbody>
                </table>
                <h4 class='text-center mt-4'>Total Marks: <strong>$total_marks / 500</strong></h4>
                <h4 class='text-center mt-2'>Overall Status: $status</h4>
                <div class='text-center mt-4'>
                    <a href='index.html' class='btn btn-primary'>Go Back</a>
                </div>
            </div>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js'></script>
        </body>
        </html>";
    } else {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>No Results Found</title>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css'>
        </head>
        <body>
            <div class='container text-center mt-5'>
                <div class='alert alert-danger'>
                    <h4>No results found! Please check the registration number and date of birth.</h4>
                </div>
                <a href='index.html' class='btn btn-primary'>Go Back</a>
            </div>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js'></script>
        </body>
        </html>";
    }
}

$conn->close();
?>
