<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Σύνδεση</title>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <div class="container">
        <h2>Σύνδεση</h2>
        <?php
			session_start(); // Ξεκινάμε τη συνεδρία
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$servername = "webpagesdb.it.auth.gr:3306";
				$username = "kelly_admin";
				$password = "123456kelly_admin";
				$dbname = "student3961partB";

				$conn = new mysqli($servername, $username, $password, $dbname);

				if ($conn->connect_error) {
					die("Σφάλμα Σύνδεσης: " . $conn->connect_error);
				}

				$email = $_POST["email"];
				$password = $_POST["password"];

				$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
				$result = $conn->query($query);

				if ($result->num_rows > 0) {
					$user = $result->fetch_assoc();

					$_SESSION['user_id'] = $user['id'];
					$_SESSION['role'] = $user['role']; 

					if ($user['role'] == 'Tutor') {
						header("Location: index1.php"); // Σελίδα για Tutor
					} else {
						header("Location: index1.php"); // Σελίδα για Student
					}
					exit();
				} else {
					echo '<p style="color: red;">Άκυρο email ή κωδικός πρόσβασης.</p>';
				}

				$conn->close();
			}
		?>


        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Κωδικός Πρόσβασης:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Σύνδεση</button>
        </form>

        <p>Δεν έχετε λογαριασμό; <a href="index.php">Εγγραφή</a></p>

    </div>

</body>
</html>