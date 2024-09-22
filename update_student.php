<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "webpagesdb.it.auth.gr:3306";
    $username = "kelly_admin";
    $password = "123456kelly_admin";
    $dbname = "student3961partB";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
    }

    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password' WHERE id = $student_id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Ο μαθητής ενημερώθηκε με επιτυχία."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Σφάλμα κατά την ενημέρωση του μαθητή: " . $conn->error]);
    }

    $conn->close();
}
?>
