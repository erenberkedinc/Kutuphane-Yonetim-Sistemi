<?php
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

        $kitapadi=$_POST['kitapadi'];
        $isbn=$_POST['isbn'];

        if($kitapadi==null && $isbn !=null){
            $sql = "SELECT kitap_ad, kitap_isbn, kitap_durum FROM kitaplar WHERE kitap_isbn='$isbn'";
        }
        else if($isbn==null && $kitapadi!=null){
            $sql = "SELECT kitap_ad, kitap_isbn, kitap_durum FROM kitaplar WHERE kitap_ad='$kitapadi'";
        }
        else{
            echo "Hatalı Giriş";
        }
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "Kitap Adı: " . $row["kitap_ad"]. " - Kitap ISBN: " . $row["kitap_isbn"]. "- Kitap Durumu: " . $row["kitap_durum"]. "<br>";
            }
        } else {
            echo "Böyle bir kitap kütüphanede bulunmamaktadır.";
        }
        $conn->close();
        #https://www.w3schools.com/PHP/php_mysql_select_where.asp
?>

