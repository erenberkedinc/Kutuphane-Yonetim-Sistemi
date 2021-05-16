<!DOCTYPE html>
<html>
<head>
<script async src="https://docs.opencv.org/3.4/opencv.js"></script>
<script src='https://unpkg.com/tesseract.js@v2.0.2/dist/tesseract.min.js'></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <title>Admin Panel</title>
</head>
<body>
        <div style="background-color: #3333ff; color: white; padding: 20px;">
                <h2 style="color:black;">Kullanıcılar</h2>
                <input type="submit" value="Kullanıcıları Listele" id="users" name="users">
                <div id="comments">
                </div>
        </div>
        <div style="background-color: #3366ff; color: white; padding: 20px;">
                <h2 style="color:black;">Zaman Atla</h2>
                <label for="zamanatla-text">Gün Sayısı:</label>
                <input type="text" id="zamanatla-text" name="zamanatla-text"><br>
                <input type="submit" value="Zaman Atla" id="zamanatla-buton" name="zamanatla-buton">
                
        </div>
        <div style="background-color: #3399ff; color: white; padding: 20px;">
                <h2 style="color:black;">Kitap Ekle</h2>
                <label for="kitapadi">Kitap Adı:</label>
                <input type="text" id="kitapadi" name="kitapadi"><br>
                <input type="hidden" id="mydata" name="mydata
                ">
                <img id="input_image">
                <input type="file" id="file_input">
                <input type="submit" value="Kitabı Ekle" id="eklebuton" name="eklebuton">
        </div>
        <canvas id="output"></canvas>

        
        <script>//KULLANICILARI LİSTELE
                $(document).ready(function(){
                        $("#users").click(function(){
                                $("#comments").load("users.php");
                        });
                });
        </script> 

        <script>//ZAMAN ATLA
                $(document).ready(function(){
                        $("#zamanatla-buton").click(function(){
                                        var atla = $("#zamanatla-text").val();
                                        $.ajax({
                                                url:'zaman.php',
                                                type:'POST',
                                                data:{atla:atla},
                                                success:function(data){
                                                        console.log(data);
                                        }
                                        });
                        });
                });
        </script> 




        
        <script>//OPENCV + TESSERACT, İSBN OKUMA
                let img_input=document.getElementById('input_image');
                let file_input=document.getElementById('file_input');
                var canvas = document.getElementById('output');
                var i=0;


                download_img = function(el) {
                        var image = canvas.toDataURL("image/jpg");
                        el.href = image;
                        i++;
                        //console.log(i);
                        //console.log(el);
                };

                console.log(img_input);
                console.log(file_input);
                file_input.addEventListener('change',(e)=>{
                        img_input.src=URL.createObjectURL(e.target.files[0])
                },false);
                img_input.onload=function(){
                        let mat=cv.imread(img_input);

                        //let dst = new cv.Mat();

                        cv.cvtColor(mat,mat,cv.COLOR_RGB2GRAY);

                        //cv.adaptiveThreshold(mat, dst, 100, cv.ADAPTIVE_THRESH_GAUSSIAN_C, cv.THRESH_BINARY, 3, 2);

                        cv.imshow('output',mat); //threshold gelirse değiştirmeyi unutma
                        deneme();
                        mat.delete();
                        //dst.delete();
                        //DENEDİĞİM DİĞER FONKSİYONLAR SONUCU DAHA DA KÖTÜLEŞTİRDİ ONUN İÇİN RESİM ÜZERİNDE DAHA FAZLA OYNAMA YAPMADIM
                        //https://www.youtube.com/watch?v=uO7k5aBJwk4
                }

                function deneme(){
                        Tesseract.recognize(
                        canvas.toDataURL("image/jpg"),
                        'tur',
                        { logger: m => console.log(m) }
                        ).then(({ data: { text } }) => {
                        var str=text.trim();
                        console.log(text.trim());
                        console.log("------------");
                        console.log(typeof text);
                        var i=str.indexOf("ISBN");
                        console.log(i);
                        console.log("asd:"+text.charAt(i));
                        i++;
                        var isbn='';
                        while((text.charAt(i+4) >= '0' && str.charAt(i+4)  <= '9')|| text.charAt(i+4)=='-'){
                                
                                        isbn +=str.charAt(i+4);
                                        i++;
                                

                        }
                        console.log("CEVAP:"+isbn);
                        //$("#mydata").val(isbn);
                       $(document).ready(function(){
                                $("#eklebuton").click(function(){
                                        var kitapad = $("#kitapadi").val();
                                        $.ajax({
                                        url:'kitapekle.php',
                                        type:'POST',
                                        data:{kitapad:kitapad,isbn:isbn},
                                        success:function(data){
                                                console.log(data);
                                        }
                                        });
                                });
                                //https://stackoverflow.com/questions/1917576/how-do-i-pass-javascript-variables-to-php
                       });
                        //TEXTTEN ISBN VE KİTAP ADINI ÇEK
                        })
                }
                


        </script>
</body>
</html>