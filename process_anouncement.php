<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ανέβασμα</title>
    <link rel="stylesheet" href="stylesss.css">
</head>
<body>
        <?php
		$servername = "webpagesdb.it.auth.gr:3306";
		$username = "kelly_admin";
		$password = "123456kelly_admin";
		$dbname = "student3961partB";

		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			echo "Αποτυχία σύνδεσης στη βάση δεδομένων: " . $conn->connect_error;
			exit();
		}

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$date = $_POST["date"];
			$topic = $_POST["topic"];
			$content = $_POST["content"];

			$sql = "INSERT INTO announcements (date, topic, content) VALUES ('$date', '$topic', '$content')";

			if ($conn->query($sql) === TRUE) {
				echo "Η ανακοίνωση προστέθηκε με επιτυχία.";
			} else {
				echo "Σφάλμα κατά την προσθήκη της ανακοίνωσης: " . $conn->error;
			}
		}

		$conn->close();
		?>

</body>
</html>