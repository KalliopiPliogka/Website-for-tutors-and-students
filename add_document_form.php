<!DOCTYPE html>
<html>
<head>
    <title>Προσθήκη Νέου Εγγράφου</title>
    <link rel="stylesheet" href="add_document1.css"/>
    <link rel="icon" href="html5.png"/>
    <style>
label, input, textarea {
    display: block;
    margin-top: 20px;
    width: 300px;
    box-sizing: border-box;
}
</style>
</head>
<body>
    <h1 style="background-color: burlywood;">Προσθήκη Νέου Εγγράφου</h1>
    <div class="row">
        <div style="width: 30%; height: 300px; float: left;" class="btn-group">
            <button type="button" onclick="location.href='index1.php'">Αρχική Σελίδα</button>
            <button type="button" onclick="location.href='announcement.php'">Ανακοινώσεις</button>
            <button type="button" onclick="location.href='documents.php'">Έγγραφα Μαθήματος</button>
            <button type="button" onclick="location.href='homework.php'">Εργασίες</button>
            <button type="button" onclick="location.href='users.php'">Χρήστες</button>
            <button type="button" onclick="location.href='logout.php'">Αποσύνδεση</button>
        </div>
        <div style="width: 60%; height: 300px; float: left;" class="contents">
            <form id="addDocumentForm" action="process_add_document.php" method="post" enctype="multipart/form-data" onsubmit="submitForm(event)">
				<label for="document_title">Τίτλος Εγγράφου:</label>
				<input type="text" id="document_title" name="document_title" required><br><br>

				<label for="document_description">Περιγραφή Εγγράφου:</label>
				<textarea id="document_description" name="document_description" rows="4" required></textarea><br><br>

				<label for="file_path">Επιλογή Αρχείου:</label>
				<input type="file" id="file_path" name="file_path" accept=".doc, .docx" required><br><br>

				<button type="submit" id="submitBtn" style="background-color: chocolate; color: #fff; padding: 10px; border: none; border-radius: 4px; cursor: pointer;">Υποβολή</button>
			</form>

        </div>
    </div>
	
	<script>
		function submitForm(event) {
			event.preventDefault(); 

			var formData = new FormData(document.getElementById('addDocumentForm'));
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'process_add_document.php', true);

			xhr.onload = function() {
				if (xhr.status == 200) {
					alert("Η εργασία προστέθηκε με επιτυχία!");
					document.getElementById('addDocumentForm').reset(); 
          		    window.location.href = "documents.php";
				} else {
					alert('Σφάλμα κατά την προσθήκη του εγγράφου.');
				}
			};

			xhr.send(formData);
		}
	</script>

</body>
</html>