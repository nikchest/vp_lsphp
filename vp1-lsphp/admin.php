<!DOCTYPE html>
<html>
<head>
    <title>Админка BURGERS.RU</title>
</head>
<body>
<h1>Админка BURGERS.RU</h1>
<?php
require_once 'connection.php'; // подключаем скрипт коннекта к БД
 
// подключаемся к серверу
if(!$connect_db) die("Ошибка доступа к базе данных. Приносим свои извинения");
print("Подключение выполнено успешно");

 
//Предусмотреть простейшую административную панель. В админ-панели выводится:


//1. список всех зарегистрированных пользователей.
echo '<br><br><h2>Cписок всех зарегистрированных пользователей</h2><br>';

//выводим таблицу users
$query_users = 'SELECT * FROM users';
$result_users = mysqli_query($connect_db, $query_users) or die('Ошибка ' . mysqli_error($connect_db));

if($result_users) {
    
    $rows = mysqli_num_rows($result_users); // количество полученных строк
     
    echo '<table>
                <tr>
                    <th>Id</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Телефон</th>
                </tr>
           ';

    for ($i = 0 ; $i < $rows ; ++$i) { //цикл по всем строкам таблицы users
        $row = mysqli_fetch_row($result_users); //Получение строки результирующей таблицы в виде массива
        echo '<tr>';
            for ($j = 0 ; $j < 4 ; ++$j) echo '<td>' . $row[$j] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
     
    // очищаем результат
    mysqli_free_result($result_show);
}

//2. список всех заказов.
echo '<br><br><h2>Cписок всех заказов</h2><br>';

//выводим таблицу users
$query_orders = 'SELECT * FROM orders';
$result_orders = mysqli_query($connect_db, $query_orders) or die('Ошибка ' . mysqli_error($connect_db));

if($result_orders) {
    
    $rows = mysqli_num_rows($result_orders); // количество полученных строк
     
    echo '<table>
                <tr>
                    <th>Id</th>
                    <th>ID Клиента</th>
                    <th>Улица</th>
                    <th>Дом</th>
                    <th>Корпус</th>
                    <th>Квартира</th>
                    <th>Этаж</th>
                    <th>Комментарий</th>
                    <th>Сдача</th>
                    <th>Оплата</th>
                    <th>Перезвонить</th>
                </tr>
           ';

    for ($i = 0 ; $i < $rows ; ++$i) { //цикл по всем строкам таблицы users
        $row = mysqli_fetch_row($result_orders); //Получение строки результирующей таблицы в виде массива
        echo '<tr>';
            for ($j = 0 ; $j < 11 ; ++$j) echo '<td>' . $row[$j] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
     
    // очищаем результат
    mysqli_free_result($result_show);
}


mysqli_close($link);


?>

</body>
</html>

