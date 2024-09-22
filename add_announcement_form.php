<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Προσθήκη Νέας Ανακοίνωσης</title>
    <link rel="stylesheet" href="add_homework1.css"/>
    <link rel="icon" href="html5.png"/>
</head>
<body>
    <h1 style="background-color: burlywood;">Προσθήκη Νέας Ανακοίνωσης</h1>
    <div class="row">
        <div style="width: 30%; height: 300px; float: left;" class="btn-group">
            <button type="button" onclick="location.href='index1.php'">Αρχική Σελίδα</button>
            <button type="button" onclick="location.href='announcement.php'">Ανακοινώσεις</button>
            <button type="button" onclick="location.href='documents.php'">Έγγραφα Μαθήματος</button>
            <button type="button" onclick="location.href='homework.php'">Εργασίες</button>
            <button type="button" onclick="location.href='users.php'">Χρήστες</button>
            <button type="button" onclick="location.href='logout.php'">Αποσύνδεση</button>
        </div>
        
        <div style="width: 70%; height: 60px;float: left;" class="contents">
            <form id="announcementForm" style="text-align: left;">
                <label for="date">Ημερομηνία:</label>
                <input type="date" id="date" name="date" required><br>

                <label for="topic">Θέμα:</label>
                <input type="text" style="margin-top: 20px;" id="topic" name="topic" required><br>

                <label for="content">Κυρίως Κείμενο:</label>
                <textarea id="content" style="margin-top: 20px;" name="content" required></textarea><br>

                <input type="submit" style="background-color: chocolate;color: #fff; padding: 10px;border: none; border-radius: 4px; cursor: pointer; margin-top: 20px; width: 300px;" value="Προσθήκη Ανακοίνωσης">
            </form>
        </div>
    </div>

    <!-- AJAX Script -->
    <script>
        document.getElementById('announcementForm').addEventListener('submit', function(event) {
            event.preventDefault(); 

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'process_anouncement.php', true);

           xhr.onload = function() {
				if (xhr.status == 200) {
					alert("Η ανακοίνωση προστέθηκε με επιτυχία");
          		    window.location.href = "announcement.php";
				} else {
					alert('Σφάλμα κατά την προσθήκη του εγγράφου.');
				}
			};
    		 xhr.send(formData);
        });
    </script>
</body>
</html>
