<?php
        $isbn = $_POST['isbn'];
        $kitapad = $_POST['kitapad'];
        echo $isbn;
        echo $kitapad;
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kutuphane";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO kitaplar (kitap_isbn, kitap_ad, kitap_durum)
        VALUES ('$isbn', '$kitapad', 1)";

        if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        #https://www.w3schools.com/php/php_mysql_insert.asp
?>