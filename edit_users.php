<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επεξεργασία Μαθητή</title>
    <link rel="stylesheet" href="edit_users.css"/> 
    <link rel="icon" href="html5.png"/>
    <script>
        function updateStudent(event) {
            event.preventDefault();

            const formData = new FormData(event.target);

            fetch('update_student.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message); 
					window.location.href = 'users.php';
                } else {
                    alert('Σφάλμα: ' + data.message); 
                }
            })
            .catch(error => {
                alert('Σφάλμα συστήματος: ' + error);
            });
        }
    </script>
</head>
<body>
    <h2 style="background-color: burlywood;">Επεξεργασία Μαθητή</h2>
    <div class="row">
        <div style="width: 30%; height: 800px; float: left; margin: top 50px;" class="btn-group">
            <button type="button" onclick="location.href='index1.php'">Αρχική Σελίδα</button>
            <button type="button" onclick="location.href='announcement.php'">Ανακοινώσεις</button>
            <button type="button" onclick="location.href='documents.php'">Έγγραφα Μαθήματος</button>
            <button type="button" onclick="location.href='homework.php'">Εργασίες</button>
            <button type="button" onclick="location.href='users.php'">Χρήστες</button>
            <button type="button" onclick="location.href='logout.php'">Αποσύνδεση</button>
        </div>
        <?php
        // Σύνδεση με τη βάση δεδομένων
        $servername = "webpagesdb.it.auth.gr:3306";
        $username = "kelly_admin";
        $password = "123456kelly_admin";
        $dbname = "student3961partB";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Έλεγχος αν υπάρχει παράμετρος id στο URL
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $student_id = $_GET['id'];

            // Ερώτημα SQL για ανάκτηση των στοιχείων του μαθητή με βάση το id
            $sql = "SELECT * FROM users WHERE id = $student_id";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                ?>
                <form onsubmit="updateStudent(event)">
                    <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                    <label for="first_name">Όνομα:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>

                    <label for="last_name">Επώνυμο:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>

                    <label for="password">Κωδικός Πρόσβασης:</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit" style="background-color: chocolate;color: #fff; padding: 10px; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px; width: 200px;">Αποθήκευση Αλλαγών</button>
                </form>
                <?php
            } else {
                echo "Δεν βρέθηκε μαθητής με αυτό το ID.";
            }
        } else {
            echo "Δεν παρέχεται έγκυρο ID.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
