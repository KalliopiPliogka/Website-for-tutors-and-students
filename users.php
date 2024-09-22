<!DOCTYPE html>
<html>
    <head> 
        <meta charset="UTF-8">
        <title>Μαθητές</title>
        <link rel="stylesheet" href="users1.css"/>
        <link rel="icon" href="html5.png"/>
		<script>
		function deleteUser(id) {
			if (confirm("Είσαι σίγουρος ότι θέλεις να διαγράψεις αυτόν τον χρήστη;")) {
				var xhr = new XMLHttpRequest();
				xhr.open("GET", "delete_users.php?id=" + id, true);
				xhr.onload = function() {
					if (xhr.status == 200) {
						alert("Ο χρήστης διαγράφηκε με επιτυχία.");
						location.reload();
					} else {
						alert("Σφάλμα κατά τη διαγραφή του χρήστη.");
					}
				};
				xhr.send();
			}
		}
		</script>
    </head>
    <body>
                <h1 style="background-color: burlywood; ">Μαθητές</h1>
                <div class="row" >
            <div style="width: 30%; height: 300px; float: left;" class="btn-group" >
                <button type="button" onclick="location.href='index1.php'">Αρχική Σελίδα</button>
                <button type="button" onclick="location.href='announcement.php'">Ανακοινώσεις</button>
                <button type="button" onclick="location.href='documents.php'">Έγγραφα Μαθήματος</button>
                <button type="button" onclick="location.href='homework.php'">Εργασίες</button>
                <button type="button" onclick="location.href='users.php'">Χρήστες</button>
                <button type="button" onclick="location.href='logout.php'">Αποσύνδεση</button>
            </div>

            <a href="add_users_form.php">Προσθήκη νέων μαθητών</a>
            <?php
                    $servername = "webpagesdb.it.auth.gr:3306";
                    $username = "kelly_admin";
                    $password = "123456kelly_admin";
                    $dbname = "student3961partB";
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM users WHERE role = 'Student'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        
                        echo "<h2>Λίστα Μαθητών</h2>";
                        echo "<ul>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<li style='font-size: 20px;'>{$row['first_name']} {$row['last_name']} <a href='#' onclick='deleteUser({$row['id']})' style='font-size: 15px;'>[διαγραφή]</a><a href='edit_users.php?id={$row['id']}'style='font-size: 15px;'>[επεξεργασία]</a></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "Δεν υπάρχουν μαθητές.";
                    }

                    $conn->close();
                    ?>
            </div>
    </body>
</html>