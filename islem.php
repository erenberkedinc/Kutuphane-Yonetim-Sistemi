<?php
        $username=$_POST['username'];
        $password=$_POST['password']; //Login.phpden değerleri alıp atadım

        $link=mysqli_connect("localhost","root","");

        $username=stripcslashes($username);
        $password=stripcslashes($password);
        $username=mysqli_real_escape_string($link,$username);
        $password=mysqli_real_escape_string($link,$password);
        if($username !="admin" && $username !=null){
                session_start();
                $_SESSION["username"]=$username;
        }
        //mysql_connect("localhost","root","");
        mysqli_select_db($link,"kutuphane");

        $result=mysqli_query($link,"select * from users where username='$username'and userpass='$password'") or die ("Failed to query database".mysqli_error($link));

        $row=mysqli_fetch_array($result);
        if($row['username']==$username && $row['userpass']==$password){
                if($row['username']=="admin" ){
                        echo "Admin Girisi yapildi";
                        header("location:admin.php");
                        //ADMİN SAYFASINA GEÇ
                }
                else{
                        echo "Kullanıcı girisi yapildi";
                        header("location:user.php");
                        //USER SAYFASINA GEÇ
                }
                        
        }
        else{
                header("location:home.php");
                //echo "Hatalı Giriş yaptınız!";
        }

?>