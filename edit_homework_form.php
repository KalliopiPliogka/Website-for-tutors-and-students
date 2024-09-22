<!DOCTYPE html>
<html>
<head>
    <title>Επεξεργασία Εργασίας</title>
    <link rel="stylesheet" href="edit_homework1.css" />
</head>
<body>
<h2 style="background-color: burlywood; text-align: center; height: 40px">Επεξεργασία Εργασίας</h2>
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
    $servername = "webpagesdb.it.auth.gr:3306";
    $username = "kelly_admin";
    $password = "123456kelly_admin";
    $dbname = "student3961partB";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM homework WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <form id="editHomeworkForm" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <label for="new_file">Νέο Αρχείο:</label>
                <input type="file" name="new_file"><br>

                <label for="assignment_title">Τίτλος Εργασίας:</label>
                <input type="text" name="assignment_title" value="<?php echo $row['assignment_title']; ?>" required><br>

                <label for="assignment_goals">Στόχοι Εργασίας:</label>
                <textarea name="assignment_goals" required><?php echo $row['assignment_goals']; ?></textarea><br>

                <label for="deliverables">Παραδοτέα:</label>
                <textarea name="deliverables" required><?php echo $row['deliverables']; ?></textarea><br>

                <label for="delivery_date">Ημερομηνία Παράδοσης:</label>
                <input type="date" id="delivery_date" style="margin-top: 20px;  width: 200px;" name="delivery_date" value="<?php echo $row['delivery_date']; ?>"><br>

                <input type="hidden" name="file_path" value="<?php echo $row['file_path']; ?>">

                <input type="submit" style="width: 20%; background-color: chocolate; color: #fff; padding: 10px; border: none; border-radius: 4px; cursor: pointer;" value="Ενημέρωση Εργασίας">
            </form>
    <?php
        } else {
            echo "Δεν βρέθηκε η εργασία με ID: $id";
        }
    } else {
        echo "Δεν παρέχεται ID εργασίας για επεξεργασία.";
    }

    $conn->close();
    ?>
</div>

<script>
    document.getElementById('editHomeworkForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_homework.php', true);

        xhr.onload = function() {
            if (xhr.status == 200) {
                alert("Η εργασία ενημερώθηκε επιτυχώς");
                window.location.href = 'homework.php';
            } else {
                alert('Σφάλμα κατά την ενημέρωση της εργασίας.');
            }
        };

        xhr.send(formData);
    });
</script>

</body>
</html>
