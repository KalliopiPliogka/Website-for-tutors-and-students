<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Επεξεργασία Ανακοίνωσης</title>
    <link rel="stylesheet" href="edit_announcement1.css"/>
    <link rel="icon" href="html5.png"/>
</head>
<body>
<h1 style="background-color: burlywood;">Επεξεργασία Ανακοίνωσης</h1>

<div class="row">
    <div style="width: 30%; height: 800px; float: left;" class="btn-group">
        <button type="button" onclick="location.href='index1.php'">Αρχική Σελίδα</button>
        <button type="button" onclick="location.href='announcement.php'">Ανακοινώσεις</button>
        <button type="button" onclick="location.href='documents.php'">Έγγραφα Μαθήματος</button>
        <button type="button" onclick="location.href='homework.php'">Εργασίες</button>
        <button type="button" onclick="location.href='users.php'">Χρήστες</button>
        <button type="button" onclick="location.href='logout.php'">Αποσύνδεση</button>
    </div>
    <?php
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        $servername = "webpagesdb.it.auth.gr:3306";
        $username = "kelly_admin";
        $password = "123456kelly_admin";
        $dbname = "student3961partB";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM announcements WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form id="editAnnouncementForm" style="text-align: left;">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="topic">Θέμα:</label>
                <input type="text" id="topic" name="topic" value="<?php echo $row['topic']; ?>" required><br>
                <label for="date">Ημερομηνία:</label>
                <input type="date" id="date" style="margin-top: 20px;  width: 200px;" name="date" value="<?php echo $row['date']; ?>" required><br>
                <label for="content">Κυρίως Κείμενο:</label>
                <textarea id="content" style="margin-top: 20px;width:40%" name="content" rows="4" required><?php echo $row['content']; ?></textarea><br>
                <input type="submit" style="background-color: chocolate;color: #fff; padding: 10px;border: none; border-radius: 4px; cursor: pointer; margin-top: 20px; width: 200px;" value="Αποθήκευση">
            </form>
            <?php
        } else {
            echo "Δεν βρέθηκε ανακοίνωση με αυτό το id.";
        }

        $conn->close();
    } else {
        echo "Μη έγκυρο id ανακοίνωσης.";
    }
    ?>
</div>

<!-- AJAX Script -->
<script>
    document.getElementById('editAnnouncementForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process_edit_announcement.php', true);

        xhr.onload = function() {
            if (xhr.status == 200) {
                alert(xhr.responseText); 
                window.location.href = 'announcement.php';
            } else {
                alert('Σφάλμα κατά την αποθήκευση των αλλαγών.');
            }
        };

        xhr.send(formData);
    });
</script>

</body>
</html>
