# Kutuphane-Yonetim-Sistemi
Program, php ile yazılmış klasik bir kütüphane yönetim sistemi programıdır.

Kütüphane Sistemi Projesinde, Sunucu-istemci mimarisi ve görüntü işleme algoritmaları kullanılarak kütüphane sisteminin uygulanması amaçlanmaktadır.
Program klasik bir kütüphane yönetim sistemi programıdır (web arayüzünde). Kullanıcı anasayfaya giderek kullanıcı girişi yapar. Eğer kullanıcı doğru bilgileri girdiyse, kullanıcının yetkisine (user veya admin) göre bir sayfaya yönlendirilir. Admin için kitap ekleme, zaman atlama, kullanıcıları listeleme gibi özellikleri vardır. Normal bir kullanıcının (userın) ise kitap arama, kitap alma (belirli koşullar kontrol edilerek), kitap iade etme gibi özellikleri vardır.

Öncelikle anasayfanın açılmasıyla bir kullanıcı giriş sayfası açılır. Kullanıcının, kullanıcı adı ve kullanıcı şifresi bilgilerini girmesiyle user veya admin paneline yönlendirilir. Eğer kullanıcı normal bir kullanıcı (user) ise kitap arama, kitap alma, kitap iade etme gibi özellikleri vardır. Eğer kullanıcı admin ise kitap ekleme, zaman atlama ve kullanıcıları listeleme özellikleri vardır.

User, kitabın isbn numarasını veya kitabın ismini girerek kitabı arayabilir. Eğer kullanıcı kitap almak istiyorsa kitabın isbn numarasını girerek kitabı al tuşuna basarak kitabı alabilir (belirli kuralları sağladığı takdirde). Kullanıcı eğer bir kitabı iade etmek istiyorsa kitabın fotoğrafını sisteme yükleyip iade et butonuna basabilir.

Admin, kitap eklemek için kitabın fotoğrafını yüklemelidir. Sistem görüntü işleme kütüphaneleri kullanarak (opencv.js ve tesseract.js ile) resimden ISBN numarasını alır ve veritabanına kayıt işlemini gerçekleştirir. Ayrıca admin atlayacağı gün sayısını sisteme girip zaman atla butonuna basarsa sistemin tarihi o kadar gün ileri almış olur. Admin ayrıca isterse kullanıcıları listele diyerek tüm kullanıcıları listeleyebilir.


