<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/Exception.php';
  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';

  $mail = new PHPMailer(true);

  // Записываем в переменные поля форм по атрибуту name

  $userName = $_POST['user-name'];
  $userEmail = $_POST['user-mail'];
  $userPhone = $_POST['user-phone'];
  $userTelegram = $_POST['user-telegram'];
  $userCompany = $_POST['user-company'];
  $userComment = $_POST['user-comment'];
  $userSubscriptionTerms = $_POST['subscription-terms'];

  try {
    //Server settings
    $mail->SMTPDebug  = SMTP::DEBUG_SERVER;
    $mail->CharSet    = "utf-8";
    $mail->isSMTP();
    $mail->Host       = 'smtp.yandex.ru';                       //SMTP сервер, зависит от почты отправки
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mail@yandex.ru';                  //SMTP имя пользователя (почта с которой отправляем письмо)
    $mail->Password   = 'zciwngzkbpkibacc';                     //SMTP password (для яндех и мэйл ру генерируем по ссылке в инструкции, для gmail это пороль от почты)
    $mail->SMTPSecure = 'ssl';                                  //Шифрование
    $mail->Port       = 465;                                    //Порт

    //Recipients
    $mail->setFrom('mail@yandex.ru');                       //Откуда отправляем
    $mail->addAddress('g.khlopkov@bk.ru');                 //Куда отправляем    

    //Content
    $mail->isHTML(true);                                         //Письмо в формате HTML для использования тегов
    $mail->Subject = "Заявка с сайта rustore.ru";               //Тема письмы
    $mail->Body = "<div><p style='font-size: 20px;'>Данные с сайта RuStore - Форма для ваших контактов</p><p>Имя: $userName</p><p>Почта: $userEmail</p><p>Телефон: $userPhone</p><p>Ник в Telegram: $userTelegram</p><p>Компания: $userCompany</p><p>Комментарий: $userComment</p><p>Согласие: $userSubscriptionTerms</p></div>";

    $mail->send();
    echo 'Письмо отправлено!';
  } catch (Exception $e) {
    echo "Письмо не отправлено!. Ошибка отправки: {$mail->ErrorInfo}";
  }
?>
