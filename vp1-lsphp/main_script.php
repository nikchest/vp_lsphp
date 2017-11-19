<?php
require_once 'connection.php'; // подключаем скрипт коннекта к БД
 
// подключаемся к серверу
if(!$connect_db) die("Ошибка доступа к базе данных. Приносим свои извинения");
print("Подключение выполнено успешно");

//заголовок для отправки письма
$header = array(
                "MIME-Version: 1.0",
                "Content-Type: text/html;charset=utf-8"
                ); 

// определяем переменый для значений из полей формы
$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$phone = trim($_POST["phone"]);
$street = trim($_POST["street"]);
$home = trim($_POST["home"]);
$part = trim($_POST["part"]);
$appt = trim($_POST["appt"]);
$floor = trim($_POST["floor"]);
$comment = trim($_POST["comment"]);
$need_change = trim($_POST["need_change"]);
$payment = trim($_POST["payment"]);
$callback = trim($_POST["callback"]);

/*Фаза 1. Регистрация или “авторизация” пользователя.
Регистрация происходит по полю email, в эту же таблицу записывается имя и телефон. В случае если пользователь уже заказывал 
- происходит “авторизация”. Никаких паролей нет!
*/
if (isset($name) && isset($email) && isset($phone)) {
    
    //сначала проверяем юзера на новизну
    $query_check_email = "SELECT * FROM users WHERE email = '$email'";
    $result_check_login = mysqli_query($connect_db, $query_check_email) or die("Ошибка " . mysqli_error($connect_db));
    $result_check_login_num = mysqli_num_rows($result_check_login);
    
    if($result_check_login_num == 0) { //если юзер новый, то добавляем его в базу юзеров
 
        //добавляем в бд
        $query_insert_users = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')";
        $result_insert_users = mysqli_query($connect_db, $query_insert_users) or die("Ошибка " . mysqli_error($connect_db));
        
        if ($result_insert_users) {
            echo "<br>Данные нового юзера успешно добавлены в таблицу";

        } else {
            echo "<br>Произошла ошибка добавления юзера";
            mysqli_free_result($result_insert_users);
        }

 
    } else { //если юзер уже есть, то не добавляем его в базу
        echo "<br>Пользователь с таким email существует! "; 
        
    }

	/*Фаза 2. Оформление заказа.
	Записывается в отдельную таблицу с указанием идентификатора пользователя, адреса и деталей для доставок.*/

	/*
    $query_get_current_email = "SELECT id FROM users WHERE email = '$email'"; //выбираем id емайл, который уже есть в базе
	$result_get_current_email = mysqli_query($connect_db, $query_get_current_email) or die("Ошибка " . mysqli_error($connect_db));
	$user_id = mysqli_fetch_assoc($result_get_current_email);
	echo ' id этого клиента ' . $user_id['id'];
	*/

	//добавляем заказ со связкой id юзера и по его email из таблицы users 	
	$query_insert_orders = "INSERT INTO orders 
                            (user_id, street, home, part, appt, floor, comment, need_change, payment, callback) 
                        VALUES 
                            ((SELECT id FROM users WHERE email = '$email'), '$street', '$home', '$part', '$appt', '$floor', '$comment', '$need_change', '$payment', '$callback')"; 


	$result_insert_orders = mysqli_query($connect_db, $query_insert_orders) or die("Ошибка " . mysqli_error($connect_db));
    
    $last_order_id = mysqli_insert_id($connect_db);
    echo ' id этого заказа ' . $last_order_id;

	if ($result_insert_orders) {
            echo "<br>Данные нового заказа успешно добавлены в таблицу";
    } else {
        echo "<br>Произошла ошибка добавления юзера";
        mysqli_free_result($result_insert_users);
    }

    /*
    Фаза 3. Письмо или запись в файл 
    После записи данных в БД высылается письмо с контактами. Заголовок - заказ №{id}, где id - это уникальный номер записи заказа. Под заголовком: “Ваш заказ будет доставлен по адресу”. Адрес содержит данные из БД или формы. Содержимое заказа всегда одинаковое - DarkBeefBurger за 500 рублей, 1 шт, нигде в базе не хранится, только высылается в письме. Внизу, под заказом идет дополнительная строка - “Спасибо - это ваш первый заказ” или “Спасибо! Это уже 555 заказ”, где 555 - это кол-во разов, сколько пользователь заказал. Письмо высылается функцией mail или записывается с помощью функции file_put_contents в отдельную папку с временем отправки. Красивая верстка не требуется, достаточно разделения строк.
	*/


    //отправка почты
    
	$recepient = "nikchest@yandex.ru";
	$sitename = "BURGERS.RU";



	//узнаем количество заказов данным юзером
	$query_count_orders = "SELECT orders.id as orders_id FROM orders LEFT JOIN users ON orders.user_id = users.id WHERE users.email = '$email'";
    $result_count_orders = mysqli_query($connect_db, $query_count_orders) or die("Ошибка " . mysqli_error($connect_db));
    $result_count_orders_num = mysqli_num_rows($result_count_orders);
    echo ' Количество заказов у этого юзера  ' . $result_count_orders_num;

    
    $pagetitle = "Ваш заказ с сайта \"$sitename\"";
	$message = "Заказ № $last_order_id <br> Ваш заказ будет доставлен по адресу: <br> Улица: $street,<br> Дом: $home,<br> Корпус: $part,<br> Кв: $appt,<br> Этаж: $floor.<br> Товар: DarkBeefBurger за 500 рублей, 1 шт <br> Спасибо - это ваш $result_count_orders_num заказ";
	mail($recepient, $pagetitle, $message, implode("\r\n", $header));

	//запись в файл
	$orders_for_file = array(
    						'Заказ №' => $last_order_id,
							'Имя' => $name,
							'Телефон' => $phone,
							'Email' => $email,
							'Улица' => $street,
							'Дом' => $home,
							'Корпус' => $part,
							'Квартира' => $appt,
							'Этаж' => $floor,
							'Коммент' => $comment,
							'Сдача' => $need_change,
							'Оплата картой' => $payment,
							'Перезвонить' => $callback,
							'Содержимое заказа' => 'DarkBeefBurger за 500 рублей, 1 шт',
							'Подвал' => 'Спасибо! Это уже ' . $result_count_orders_num . ' заказ',
							'Время отправки' => date('d.m.Y h:i'),
							);

    /*$out='';
	foreach ($orders_for_file as $key=>$val){
        if(isset($_POST[$key])){
            $out .= $orders_for_file[$val] . ': ' . $_POST[$key] . "\n\r";
        }
    }*/

    //Преобразуйте его в JSON.
    $jsonString = json_encode($orders_for_file);
    //Сохраните как output.json
    file_put_contents('./orders/output.json', $jsonString);
    //Откройте файл output.json
    $jsonPath = './orders/output.json';
    $jsonFile = file_get_contents($jsonPath);
    $jsonArray = json_decode($jsonFile, true);
    echo '<pre>';
    print_r($jsonArray);

}



// закрываем подключение
mysqli_close($connect_db);
?>