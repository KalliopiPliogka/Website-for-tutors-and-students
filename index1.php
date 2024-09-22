<!DOCTYPE html>
<html>
    <head> 
        <meta charset="UTF-8">
        <title>Αρχική Σελίδα</title>
        <link rel="stylesheet" href="index1.css"/>
        <link rel="icon" href="html5.png"/>
    </head>
    <body>
        <h1 style="background-color: burlywood; ">Αρχική Σελίδα</h1>
  
            <div style="width: 30%; height: 1000px; float: left;" class="btn-group" >
                <button type="button" onclick="location.href='index1.php'">Αρχική Σελίδα</button>
                <button type="button" onclick="location.href='announcement.php'">Ανακοινώσεις</button>
                <button type="button" onclick="location.href='documents.php'">Έγγραφα Μαθήματος</button>
                <button type="button" onclick="location.href='homework.php'">Εργασίες</button>
				<?php session_start(); if ($_SESSION['role'] == 'Tutor'): ?>
              	  <button type="button" onclick="location.href='users.php'">Χρήστες</button>
				<?php endif; ?>
                <button type="button" onclick="location.href='logout.php'">Αποσύνδεση</button>
            </div>
            <div style="width: 70%; height: 1000px;" class="contents">
                <p>Καλώς ήρθατε στον Ιστοχώρο για την Εκμάθηση HTML!
                        Στόχοι του Ιστοχώρου:
                        Ο σκοπός μας είναι να παρέχουμε μια ολοκληρωμένη εμπειρία
                        εκμάθησης HTML, προσφέροντας πλούσιο υλικό και εκπαιδευτικούς 
                        πόρους για αρχάριους και προχωρημένους. Επιδιώκουμε να διευκολύνουμε 
                        την κατανόηση της HTML και να ενισχύσουμε τις δεξιότητες των χρηστών
                        στην ανάπτυξη ιστοσελίδων.  
                        Ιστοσελίδες του Site:  
                        <ol><b>Ανακοινώσεις: </b> <p>Εδώ θα βρείτε τις τελευταίες ανακοινώσεις και ενημερώσεις
                                σχετικά με το περιεχόμενο του ιστοχώρου, νέα μαθήματα, και άλλα ειδήσεις που σας αφορούν.</p></ol>
                        <ol><b>Επικοινωνία: </b><p></p>Στη σελίδα αυτή, μπορείτε να επικοινωνήσετε μαζί μας. Είτε έχετε 
                            ερωτήσεις για το περιεχόμενο, είτε θέλετε να μοιραστείτε τις σκέψεις και τις ιδέες σας, είμαστε εδώ για εσάς.</ol>
                        <ol><b>Έγραφα Μαθήματος: </b><p>Σε αυτή την ενότητα θα βρείτε πλήρη και δομημένα έγραφα μαθήματος HTML. 
                            Από τις βασικές έννοιες μέχρι προχωρημένες τεχνικές, εδώ θα ανακαλύψετε ό,τι χρειάζεται για να κατανοήσετε
                            και να χρησιμοποιήσετε την HTML.</p></ol>
                        <ol><b>Εργασίες: </b><p>Στη σελίδα αυτή θα βρείτε εργασίες που θα σας βοηθήσουν να εφαρμόσετε τις γνώσεις σας.
                            Από απλές ασκήσεις μέχρι προγραμματιστικά έργα, οι εργασίες αποτελούν σημαντικό μέρος της 
                            διαδικασίας εκμάθησης.</p></ol>
                </p>
                  
                <img src="htmlImage.jpg"  width="400" height="200" style="margin-top: 50px;">
            </div>
    </body>
</html>