<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Προσθήκη Χρήστη</title>
    <link rel="stylesheet" href="add_users1.css"/>
    <link rel="icon" href="html5.png"/>
    <style>
        label, input, textarea {
            display: block;
            margin-top: 10px;
            width: 300px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h1 style="background-color: burlywood;">Προσθήκη Χρήστη</h1>
    <div class="row">
        <div style="width: 30%; height: 300px; float: left;" class="btn-group">
            <button type="button" onclick="location.href='index1.php'">Αρχική Σελίδα</button>
            <button type="button" onclick="location.href='announcement.php'">Ανακοινώσεις</button>
            <button type="button" onclick="location.href='documents.php'">Έγγραφα Μαθήματος</button>
            <button type="button" onclick="location.href='homework.php'">Εργασίες</button>
            <button type="button" onclick="location.href='users.php'">Χρήστες</button>
            <button type="button" onclick="location.href='logout.php'">Αποσύνδεση</button>
        </div>
        
        <div style="width: 70%; float: left;" class="contents">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $servername = "webpagesdb.it.auth.gr:3306";
                $username = "kelly_admin";
                $password = "123456kelly_admin";
                $dbname = "student3961partB";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $username = $_POST['email'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $insert_sql = "INSERT INTO users (first_name, last_name, email, password, role) VALUES ('$first_name', '$last_name', '$username', '$password', '$role')";

                if ($conn->query($insert_sql) === TRUE) {
                    echo "Ο χρήστης προστέθηκε με επιτυχία.";
                } else {
                    echo "Σφάλμα κατά την προσθήκη χρήστη: " . $conn->error;
                }

                $conn->close();
            }
            ?>

            <form id="addUserForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="submitForm(event)">
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
					<option value="Student">Student</option>
				</select>

				<button type="submit" style="float:left; margin-top: 30px; background-color: chocolate; color: #fff; padding: 10px; border: none; border-radius: 4px; cursor: pointer;">Προσθήκη Χρήστη</button>
			</form>

        </div>
    </div>
	
	<script>
function submitForm(event) {
    event.preventDefault();

    var formData = new FormData(document.getElementById('addUserForm'));
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?php echo $_SERVER['PHP_SELF']; ?>', true);

		xhr.onload = function() {
				if (xhr.status == 200) {
					alert("Ο χρήστης προστέθηκε με επιτυχία");
					document.getElementById('addUserForm').reset(); 
          		    window.location.href = "users.php";
				} else {
					alert('Σφάλμα κατά την προσθήκη του εγγράφου.');
				}
			};
    
    xhr.send(formData);
}
</script>

</body>
</html>