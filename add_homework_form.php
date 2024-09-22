<!DOCTYPE html>
<html>
<head>
    <title>Προσθήκη Εργασίας</title>
    <link rel="stylesheet" href="add_homework1.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1 style="background-color: burlywood;">Προσθήκη Εργασίας</h1>
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
            <form id="addHomeworkForm" enctype="multipart/form-data">
                <label for="assignment_title">Τίτλος Εργασίας:</label>
                <input type="text" name="assignment_title" style="margin-top: 20px; width: 300px;" id="assignment_title" required><br>

                <label for="assignment_goals">Στόχοι Εργασίας:</label>
                <textarea name="assignment_goals" id="assignment_goals" style="margin-top: 20px; width: 300px;" rows="4" required></textarea><br>

                <label for="assignment_instructions">Εκφώνηση Εργασίας:</label>
                <textarea name="assignment_instructions" id="assignment_instructions" style="margin-top: 20px; width: 300px;" rows="4" required></textarea><br>

                <label for="file_path">Αρχείο Εργασίας:</label>
                <input type="file" name="file_path" id="file_path" style="margin-top: 20px; width: 300px;" accept=".doc, .docx"><br>

                <label for="deliverables">Παραδοτέα:</label>
                <textarea id="deliverables" name="deliverables" style="margin-top: 20px; width: 300px;" rows="4" required></textarea><br>

                <label for="delivery_date">Ημερομηνία Παράδοσης:</label>
                <input type="date" name="delivery_date" id="delivery_date" style="margin-top: 20px; width: 300px;" required><br>

                <input type="submit" style="background-color: chocolate; color: #fff; padding: 10px; border: none; border-radius: 4px; cursor: pointer;" value="Υποβολή">
            </form>
        </div>
    </div>

    <script>
    document.getElementById("addHomeworkForm").onsubmit = function(event) {
        event.preventDefault(); 

        var formData = new FormData(document.getElementById("addHomeworkForm")); 

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_add_homework.php", true); 

        xhr.onload = function() {
            if (xhr.status == 200) {
                alert("Η εργασία προστέθηκε με επιτυχία!");
                 window.location.href = "homework.php";
    			exit();
            } else {
                alert("Σφάλμα κατά την προσθήκη της εργασίας.");
            }
        };

        xhr.send(formData); 
    };
    </script>

</body>
</html>
