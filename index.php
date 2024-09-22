<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Εγγραφή</title>
    <link rel="stylesheet" href="stylesss.css">
</head>
<body>

    <div class="container">

        <h2>Εγγραφή</h2>

        <form method="post" action=<?php

            $servername = "webpagesdb.it.auth.gr:3306";
            $username = "kelly_admin";
            $password = "123456kelly_admin";
            $dbname = "student3961partB";

            // Σύνδεση στη βάση δεδομένων
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Έλεγχος σύνδεσης
            if ($conn->connect_error) {
                die("Σφάλμα Σύνδεσης: " . $conn->connect_error);
            }

            // Εάν υποβληθεί η φόρμα
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $role = $_POST["role"];
                // Εισαγωγή στη βάση δεδομένων
                $sql = "INSERT INTO users (first_name, last_name, email, password,role ) VALUES ('$first_name', '$last_name', '$email', '$password','$role')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: login.php");
                    exit();
                } else {
                    echo "Σφάλμα Εγγραφής: " . $conn->error;
                }
            }

            // Κλείσιμο σύνδεσης
            $conn->close();
            ?>>

            <label for="first_name">Όνομα:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Επώνυμο:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Κωδικός Πρόσβασης:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Ρόλος:</label>
            <select id="role" name="role">
                <option value="Tutor">Tutor</option>
                <option value="Student">Student</option>
            </select>

            <button type="submit">Εγγραφή</button>
        </form>

        <p>Έχετε ήδη λογαριασμό; <a href="login.php">Σύνδεση</a></p>

    </div>

</body>
</html>
