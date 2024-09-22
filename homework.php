<!DOCTYPE html>
<html>
    <head>
        <title>Εργασίες Έγγραφα μαθήματος</title>
        <link rel="stylesheet" href="homework1.css"/>
		<script>
		function deleteHomework(id) {
			if (confirm("Είσαι σίγουρος ότι θέλεις να διαγράψεις αυτή την εργασία;")) {
				var xhr = new XMLHttpRequest();
				xhr.open("GET", "delete_homework.php?id=" + id, true);
				xhr.onload = function() {
					if (xhr.status == 200) {
						alert("Η εργασία διαγράφηκε με επιτυχία.");
						location.reload(); // Ανανέωση σελίδας για να αφαιρεθεί η ανακοίνωση
					} else {
						alert("Σφάλμα κατά τη διαγραφή της εργασίας.");
					}
				};
				xhr.send();
			}
		}
		</script>
    </head>
    <body>
        <h1 style="background-color: burlywood;">Εργασίες Έγγραφα μαθήματος</h1>
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
          	  <a href="add_homework_form.php">Προσθήκη νέας εργασίας</a>
			<?php endif; ?>
            <div style="width: 70%; height: 250px;float: left;" class="contents">
                <?php
                    // Σύνδεση με τη βάση δεδομένων
                    $servername = "webpagesdb.it.auth.gr:3306";
                    $username = "kelly_admin";
                    $password = "123456kelly_admin";
                    $dbname = "student3961partB";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Έλεγχος της σύνδεσης
                    if ($conn->connect_error) {
                        die("Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
                    }

                    // Εκτέλεση ερωτήματος SQL για ανάκτηση εγγραφών
                    $sql = "SELECT * FROM homework";
                    $result = $conn->query($sql);

                    // Εμφάνιση των εγγραφών
                   if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<h2 style="color: chocolate;">' . $row['assignment_title'];

							// Έλεγχος αν ο χρήστης είναι Tutor για να εμφανιστούν τα links διαγραφής και επεξεργασίας
							if ($_SESSION['role'] == 'Tutor') {
								echo "<a href='#' onclick='deleteHomework({$row['id']})' style='font-size: 15px;'>[διαγραφή]</a>";
								echo '<a href="edit_homework_form.php?id=' . $row['id'] . '" style="font-size: 15px;">[επεξεργασία]</a>';
							}

							echo '</h2>';
							echo '<ul style="list-style-type:none; margin-left: 50px;">';
							echo '<li><i>Στόχοι: </i>';
							echo '<ol>';
							$goals = explode("\n", $row['assignment_goals']);  // Χωρίζει τους στόχους σε γραμμές
							foreach ($goals as $goal) {
								echo '<li><i>' . trim($goal) . '</i></li>';
							}
							echo '</ol></li>';
							echo '<li><i>Εκφώνηση:</i>';
							echo '<ul style="list-style-type:none;">';
							echo '<li><i>Κατεβάστε την εκφώνηση της εργασίας από <a href="' . $row['file_path'] . '" download style="text-decoration: underline; color: blue;">εδώ</a></i></li>';
							echo '</ul>';
							echo '<li><i>Παραδοτέα: </i>';
							echo '<ol>';
							$deliverables = explode("\n", $row['deliverables']);  // Χωρίζει τα παραδοτέα σε γραμμές
							foreach ($deliverables as $deliverable) {
								echo '<li><i>' . trim($deliverable) . '</i></li>';
							}
							echo '</ol></li>';
							echo '<li><b><i style="color: red;">Ημερομηνία παράδοσης:</i></b> ' . $row['delivery_date'] . '</li>';
							echo '</ul>';
						}
					} else {
						echo "Δεν υπάρχουν εργασίες.";
					}


                    // Κλείσιμο σύνδεσης
                    $conn->close();
                    ?>
                 
                <a href="#top" style="width: 10px; height: 40px; float: right; margin-top: 150px; margin-right: 200px; text-align: center; text-decoration: none; border:none; color: chocolate">Top</a>
            </div>
        </div>
    </body>
</html>