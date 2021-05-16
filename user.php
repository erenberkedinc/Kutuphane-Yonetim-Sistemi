<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script async src="https://docs.opencv.org/3.4/opencv.js"></script>
<script src='https://unpkg.com/tesseract.js@v2.0.2/dist/tesseract.min.js'></script>
        <title>Kullanıcı Sayfası</title>
</head>
<body>
        <?php
                session_start();
                echo "Kullanıcı Adı:". $_SESSION["username"]. "<br />";
        
        ?>
        <div style="background-color: #3333ff; color: white; padding: 20px;">
        <h2 style="color:black;">Kitap Ara</h2>
        
                <label for="kitapadi"> Kitap Adı:</label><br>
                <input type="text" id="kitapadi" name="kitapadi"><br>
                <label for="isbn">İsbn Numarası:</label><br>
                <input type="text" id="isbn" name="isbn"><br><br>
                <input type="submit" value="Ara" id="kitapara" name="kitapara">
        
        <p>Not: <small>Boş alanlardan birini doldurmanız yeterlidir.</small></p>
        <p>Not: <small>Kitap Durumu:0 ise kitap başka bir kullanıcıdadır, 1 ise kitap alınmaya müsaittir.</small></p>
        <div id="comments">
        </div>
        </div>
        <div style="background-color: #3366ff; color: white; padding: 20px;">
        <h2 style="color:black;">Kitap Al</h2>
        
                <label for="isbn">İsbn Numarası:</label><br>
                <input type="text" id="isbn-al" name="isbn-al"><br><br>
                <input type="submit" value="Al" id="kitapal" name="kitapal">        
        <p>Not: <small>Kullanıcı aynı anda 3 taneden fazla kitap alamaz, aldığı kitapları 1 hafta içinde iade etmelidir.</small></p>
        <div id="comments-al">
        </div>
        </div>
        <div style="background-color: #3399ff; color: white; padding: 20px;">
                <h2 style="color:black;">Kitap İade</h2>
                <input type="hidden" id="mydata" name="mydata">
                <img id="input_image">
                <input type="file" id="file_input">
                <input type="submit" value="Kitabı İade Et" id="iadebuton" name="iadebuton">
        </div>
        <canvas id="output"></canvas>
        
        <script>
        $(document).ready(function(){
                $("#kitapara").click(function(){
                        var kitapadi = $("#kitapadi").val();
                        var isbn=$("#isbn").val();
                        $("#comments").load("kitaplistele.php",{
                                kitapadi:kitapadi,
                                isbn:isbn
                        });//https://www.youtube.com/watch?v=ejN-oAw9vC0
                });

                $("#kitapal").click(function(){
                        var isbn=$("#isbn-al").val();
                        $("#comments-al").load("kitapal.php",{
                                isbn:isbn
                        });//https://www.youtube.com/watch?v=ejN-oAw9vC0
                });
        
        });
        
        </script> 
<script>
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
                        cv.cvtColor(mat,mat,cv.COLOR_RGB2GRAY);
                        cv.imshow('output',mat);
                        deneme();
                        mat.delete();
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
                                $("#iadebuton").click(function(){
                                        $.ajax({
                                        url:'kitapiade.php',
                                        type:'POST',
                                        data:{isbn:isbn},
                                        success:function(data){
                                                console.log(data);
                                        }
                                        });
                                });

                       });
                        //TEXTTEN ISBN VE KİTAP ADINI ÇEK
                        })
                }
                


        </script>
</body>
</html>