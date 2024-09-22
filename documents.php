<!DOCTYPE html>
<html>
    <head>
        <title>Έγγραφα μαθήματος</title>
        <link rel="stylesheet" href="documents1.css"/>
        <link rel="icon" href="html5.png"/>
		<script>
		function deleteDocument(id) {
			if (confirm("Είσαι σίγουρος ότι θέλεις να διαγράψεις αυτή το έγγραφο;")) {
				var xhr = new XMLHttpRequest();
				xhr.open("GET", "delete_document.php?id=" + id, true);
				xhr.onload = function() {
					if (xhr.status == 200) {
						alert("Tο έγγραφο διαγράφηκε με επιτυχία.");
						location.reload(); 
					} else {
						alert("Σφάλμα κατά τη διαγραφή του εγγράφου.");
					}
				};
				xhr.send();
			}
		}
		</script>
    </head>
    <body>
        <h1 style="background-color: burlywood;">Έγγραφα μαθήματος</h1>
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
          	  <a href="add_document_form.php">Προσθήκη νέου εγγράφου</a>
			<?php endif; ?>
            <div style="width: 60%; height: 60px; float: left;" class="contents">
                <?php
                $servername = "webpagesdb.it.auth.gr:3306";
                $username = "kelly_admin";
                $password = "123456kelly_admin";
                $dbname = "student3961partB";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM documents";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div style="list-style-type:none;  margin-top: 50px; margin-bottom: 20px;">';
                        echo '<h2 style="color: chocolate;">' . $row['document_title'];

                        if ($_SESSION['role'] == 'Tutor') {
                            echo "<a href='#' onclick='deleteDocument({$row['id']})' style='font-size: 15px;'>[διαγραφή]</a>";
							echo '<a href="edit_document_form.php?id=' . $row['id'] . '" style="font-size: 15px;">[επεξεργασία]</a>';
                        }

                        echo '</h2>';
                        echo '<ul style="list-style-type:none; margin-left: 50px; margin-top: 50px;">';
                        echo '<li><i>Περιγραφή:</i> ' . $row['document_description'] . '</li>';
                        echo '<li style="color: blue; text-decoration: underline; margin-top: 50px;">';
                        echo '<a href="' . $row['file_path'] . '" download>Download</a>';
                        echo '</li>';
                        echo '</ul>';
                        echo '</div>';
                    }
                } else {
                    echo "Δεν υπάρχουν έγγραφα.";
                }

                $conn->close();
            ?>
                
                <a href="#top" style="width: 10px; height: 40px; float: right; margin-top: 150px; text-align: center; text-decoration: none; color: chocolate">Top</a>
            </div>  
        </div>
    </body>
</html>
