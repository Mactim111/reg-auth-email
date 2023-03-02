<?php
          // вся процедура работает на сессиях. Именно в ней хранятся данные пользователя, пока он находится на сайте. Очень важно запустить их в самом начале    странички!!!
          session_start();
 include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
 if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
            {
            //если существует логин и пароль в сессиях, то проверяем, действительны ли они

            $login = $_SESSION['login'];
            $password = $_SESSION['password'];
            $result2 = mysqli_query($db, "SELECT `id` FROM `users_1` WHERE `login` = '$login' AND password = '$password'"); 
            $myrow2 = mysqli_fetch_array($result2); 
            if (empty($myrow2['id']))
               {
               //если данные пользователя не верны
                exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
               }
            }
            else {
            //Проверяем, зарегистрирован ли вошедший
            exit("Вход на эту страницу разрешен только зарегистрированным пользователям!"); }
            ?>
            <html>
            <head>
            <title>Список пользователей</title>
            </head>
            <body>
            <h2>Список пользователей</h2>
  
 <?php
            //выводим меню
print <<<HERE
            |<a href='page.php?id=$_SESSION[id]'>Моя страница</a>|<a href='index.php'>Главная страница</a>|<a href='all_users.php'>Список пользователей</a>|<a href='exit.php'>Выход</a><br><br>
HERE;
 $result = mysqli_query($db, "SELECT `login`, `id` FROM `users_1` ORDER BY `login`"); //извлекаем логин и идентификатор пользователей 
            $myrow = mysqli_fetch_array($result);
            do
            {
            //выводим их в цикле 
            printf("<a href='page.php?id=%s'>%s</a><br>",$myrow['id'],$myrow['login']);
            }
            while($myrow = mysqli_fetch_array($result));
 ?>
            </body>
            </html>