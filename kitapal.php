<?php
        session_start();
        #echo "Kullanıcı Adı:". $_SESSION["username"]. "<br />";

        $username=$_SESSION["username"];

        $servername = "localhost";
        $username2 = "root";
        $password = "";
        $dbname = "kutuphane";
        $datenow = date('Y-m-d');
        if($_SESSION["date"]==null){
                $_SESSION["date"]=$datenow;
        }
        #$_SESSION["date"]=$datenow;

        $datelast=$_SESSION["date"];

        // Create connection
        $conn = new mysqli($servername, $username2, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $isbn=$_POST['isbn'];


        $sql = "SELECT  kitap_durum FROM kitaplar WHERE kitap_isbn='$isbn'";
        $result = $conn->query($sql);

        #$sql2= "SELECT  username FROM usersdetail WHERE username='$username'";
        #$result2 = $conn->query($sql);
        $result2 = $conn->query("SELECT COUNT(*) AS Students_count FROM usersdetail where username='$username'")->fetch_array();
        

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if($row["kitap_durum"]=="1"){
                        $sqltarih = "SELECT * FROM usersdetail where username='$username'";
                        $resulttarih = $conn->query($sqltarih);
                        $x=0;
                        if ($resulttarih->num_rows > 0) {
                                
                                //echo "Girdi";
                                // output data of each row
                                while($row2 = $resulttarih->fetch_assoc()) {
                                    //echo "tarih: " . $row2["kitap_tarih"]. "<br>";
                                    #date('Y-m-d', strtotime($row["kitap_tarih"]. ' +7 days')
                                    if(date('Y-m-d', strtotime($row2["kitap_tarih"]. ' +7 days'))<$_SESSION["date"]){
                                          $x=5; 
                                          //echo $x;
                                         // echo "Tarihi geçmiş iade edilmemiş kitabınız var";
                                          //echo "Tarih".$row2["kitap_tarih"];
                                    }
                                    else{
                                            //echo "SŞAKFALSKFAS";
                                    }
                                        
                                }
                        }
                        else{
                                //echo "Girmedi";
                        }

                        if($x==5){
                                echo "Tarihi geçmiş iade edilmemiş kitabınız var";
                        }

                        else{
                        
                         if((int)$result2['Students_count'] <3 && $x==0){
                                // TARİHİ GEÇMİŞ KİTAP VAR MI KONTROLÜ???
                                $sql2 = "UPDATE kitaplar SET kitap_durum='0' WHERE kitap_isbn='$isbn'";
                                $conn->query($sql2);
                                $sql3 = "INSERT INTO usersdetail (username, kitap_isbn, kitap_tarih)
                                        VALUES ('$username', '$isbn', '$datelast')";
                                $conn->query($sql3);
                                echo "Kitabı alabilirsiniz.";
                                 
                         }
                         else{
                                 echo "3 tane kitap almışsınız, yeni kitap almak için en az 1 kitap iade etmeniz gerekiyor.";
                         }
                        }
                        
                }
                else
                        echo "Böyle bir kitap yok veya kitap şuan başka bir kullanıcıda."; 
            }
        } else {
            echo "Böyle bir kitap kütüphanede bulunmamaktadır.";
        }
        $conn->close();
        #https://www.w3schools.com/PHP/php_mysql_select_where.asp
?>

