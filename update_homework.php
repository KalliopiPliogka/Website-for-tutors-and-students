<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ενημέρωση</title>
    <link rel="stylesheet" href="stylesss.css">
</head>
<body>
  <?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$servername = "webpagesdb.it.auth.gr:3306";
			$username = "kelly_admin";
			$password = "123456kelly_admin";
			$dbname = "student3961partB";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
				echo "Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error;
				exit();
			}

			if (isset($_POST['id'])) {
				$id = $_POST['id'];
				$assignment_title = $_POST['assignment_title'];
				$assignment_goals = $_POST['assignment_goals'];
				$deliverables = $_POST['deliverables'];
				$delivery_date = $_POST['delivery_date'];

				if ($_FILES['new_file']['size'] > 0) {
					$target_dir = "uploads/";
					$target_file = $target_dir . basename($_FILES["new_file"]["name"]);
					move_uploaded_file($_FILES["new_file"]["tmp_name"], $target_file);

					$new_file_path = $target_file;
				} else {
					$new_file_path = $_POST['file_path'];
				}

				$sql = "UPDATE homework SET 
						assignment_title = '$assignment_title',
						assignment_goals = '$assignment_goals',
						deliverables = '$deliverables',
						delivery_date = '$delivery_date',
						file_path = '$new_file_path'
						WHERE id = $id";

				if ($conn->query($sql) === TRUE) {
					echo "Επιτυχής ενημέρωση εργασίας";
				} else {
					echo "Σφάλμα ενημέρωσης εργασίας: " . $conn->error;
				}
			} else {
				echo "Δεν παρελήφθη το ID για ενημέρωση.";
			}

			$conn->close();
		} else {
			echo "Μη έγκυρο αίτημα";
		}
	?>


<a href="homework.php">Πίσω</a>
</body>
</html>
