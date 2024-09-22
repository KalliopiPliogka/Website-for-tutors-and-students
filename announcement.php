<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ανακοινώσεις</title>
        <link rel="stylesheet" href="announcement1.css"/>
        <link rel="icon" href="html5.png"/>
		<script>
		function deleteAnnouncement(id) {
			if (confirm("Είσαι σίγουρος ότι θέλεις να διαγράψεις αυτή την ανακοίνωση;")) {
				var xhr = new XMLHttpRequest();
				xhr.open("GET", "delete_announcement.php?id=" + id, true);
				xhr.onload = function() {
					if (xhr.status == 200) {
						alert("Η ανακοίνωση διαγράφηκε με επιτυχία.");
						location.reload(); 
					} else {
						alert("Σφάλμα κατά τη διαγραφή της ανακοίνωσης.");
					}
				};
				xhr.send();
			}
		}
		</script>

    </head>
    <body>
        <h1 style="background-color: burlywood;">Ανακοινώσεις</h1>
        <div class="row" >
            <div style="width: 30%; height: 300px; float: left;" class="btn-group" >
                <button type="button" onclick="location.href='index1.php'">Αρχική Σελίδα</button>
                <button type="button" onclick="location.href='announcement.php'">Ανακοινώσεις</button>
                <button type="button" onclick="location.href='documents.php'">Έγγραφα Μαθήματος</button>
                <button type="button" onclick="location.href='homework.php'">Εργασίες</button>
				<?php session_start(); if ($_SESSION['role'] == 'Tutor'): ?>
              	  <button type="button" onclick="location.href='users.php'">Χρήστες</button>
				<?php endif; ?>
                <button type="button" onclick="location.href='logout.php'">Αποσύνδεση</button>
            </div>
			<?php if ($_SESSION['role'] == 'Tutor'): ?>
        	    <a href="add_announcement_form.php">Προσθήκη νέας ανακοίνωσης</a>
			<?php endif; ?>
            <div style="width: 70%; height: 60px;float: left;" class="contents">
                <?php
                    $servername = "webpagesdb.it.auth.gr:3306";
                    $username = "kelly_admin";
                    $password = "123456kelly_admin";
                    $dbname = "student3961partB";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    if ($conn->connect_error) {
                        die("Αποτυχία σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
                    }
                    
                    $sql = "SELECT * FROM announcements";
                    $result = $conn->query($sql);
                    
                    if (!$result) {
                        die("Σφάλμα στο ερώτημα: " . $conn->error);
                    }
                    
                    $announcements = array();
                    while($row = $result->fetch_assoc()) {
                        $announcements[] = $row;
                    }
                    
                    $sql_homework = "SELECT * FROM homework";
                    $result_homework = $conn->query($sql_homework);
                    $conn->close();
                    $color = "chocolate"; 
                    $num=0;
                    $text = "Αυτό είναι ένα έντονο κείμενο.";
                    foreach ($announcements as $announcement) {
                        $num = $num + 1;
                        echo "<h2 style='color: $color;'>Ανακοίνωση $num";
                        
                        if ($_SESSION['role'] == 'Tutor') {
                            echo "<a href='#' onclick='deleteAnnouncement({$announcement['id']})' style='font-size: 15px;'>[διαγραφή]</a>";
    						echo "<a href='edit_announcement_form.php?id={$announcement['id']}' style='font-size: 15px;'>[επεξεργασία]</a>";
                        }

                        echo "</h2>";
                        echo "<p><ul><strong> Ημερομηνία:</strong> {$announcement['date']}</ul></p>";
                        echo "<p><ul><strong> Θέμα:</strong>{$announcement['topic']}</ul></p>";
                        echo "<p><ul>{$announcement['content']}</ul></p>";
                    }
                ?>
                <a href="#top" style="width: 10px; height: 40px; float: right; margin-top: 150px; margin-right:200px; text-align: center; text-decoration: none; color: chocolate">Top</a>
            </div>
        </div>
    </body>
</html>