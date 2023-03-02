<?php
          session_start(); //запускаем сессию. Обязательно в начале страницы
          include ("bd.php"); // соединяемся с базой, укажите свой путь, если у вас уже есть соединение
if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
            {
            //если существует логин и пароль в сессиях, то проверяем, действительны ли они
            $login = $_SESSION['login'];
            $password = $_SESSION['password'];
            $result2 = mysqli_query($db, "SELECT `id` FROM `users_1` WHERE `login` = '$login' AND `password` = '$password'"); 
            $myrow2 = mysqli_fetch_array($result2); 
            if (empty($myrow2['id']))
               {
               //если логин или пароль не действителен
                exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
               }
            }
            else {
            //Проверяем, зарегистрирован ли вошедший
            exit("Вход на эту страницу разрешен только зарегистрированным пользователям!"); }
if (isset($_POST['id'])) { $id = $_POST['id'];}  //получаем идентификатор страницы получателя
            if (isset($_POST['text'])) { $text = $_POST['text'];}//получаем текст сообщения 
            if (isset($_POST['poluchatel'])) { $poluchatel = $_POST['poluchatel']; }  //логин получателя 
            $author = $_SESSION['login'];  //логин автора 
            $date = date("Y-m-d");  //дата добавления 
if (empty($author) or empty($text) or empty($poluchatel) or empty($date)) {  //есть ли все необходимые данные? Если нет, то останавливаем
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля"); }
$text = stripslashes($text);  //удаляем обратные слеши
            $text = htmlspecialchars($text);  //преобразование спецсимволов в их HTML эквиваленты
            //заносим в базу сообщение
            $result2 = mysqli_query($db, "INSERT INTO `messages` (`author`, `poluchatel`, `date`, `text`) VALUES ('$author','$poluchatel','$date','$text')");
             
echo "<html><head><meta http-equiv='Refresh' content='5; URL=page.php?id=".$id."'></head><body>Ваше сообщение передано! Вы будете перемещены через 
5 сек. Если не хотите ждать, то <a href='page.php?id=".$id."'>нажмите сюда.</a></body></html>"; //перенаправляем пользователя
            ?>