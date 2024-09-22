<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Διαγραφή</title>
    <link rel="stylesheet" href="stylesss.css">
</head>
<body>
   <?php
		$servername = "webpagesdb.it.auth.gr:3306";
		$username = "kelly_admin";
		$password = "123456kelly_admin";
		$dbname = "student3961partB";
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Έλεγχος σύνδεσης
		if ($conn->connect_error) {
			die("Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
		}

		if (isset($_GET['id']) && is_numeric($_GET['id'])) {
			$id = $_GET['id'];

			$sql = "DELETE FROM announcements WHERE id = $id";

			if ($conn->query($sql) === TRUE) {
				echo "success"; 
			} else {
				echo "error"; 
			}
		} else {
			echo "invalid"; 
		}

		$conn->close();
		?>

<a href="announcement.php">Πίσω</a>
</body>
</html>