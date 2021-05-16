<?php
        $isbn = $_POST['isbn'];
        echo $isbn;
 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kutuphane";

        try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                
                $sql = "DELETE FROM usersdetail WHERE kitap_isbn='$isbn'";
            
                $conn->exec($sql);

                //if ile kullanıcının üstünde mi diye kontrol??
                $sql2 = "UPDATE kitaplar SET kitap_durum='1' WHERE kitap_isbn='$isbn'";
                $conn->query($sql2);
                echo "Record deleted successfully";
        }
        catch(PDOException $e)
        {
                echo $sql . "<br>" . $e->getMessage();
        }
        #$conn2 = new mysqli($servername, $username2, $password, $dbname);
        #$sql2 = "UPDATE kitaplar SET kitap_durum='1' WHERE kitap_isbn='$isbn'";
        #$conn2->query($sql2);
            
        $conn = null;
        #https://www.w3schools.com/php/php_mysql_delete.asp
?>