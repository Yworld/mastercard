<?php
$magic = array("'",'"');
$reg = $_POST["reg"];
$ip = $_SERVER["REMOTE_ADDR"];
$name = $_POST["name"];
$name = str_replace($magic,"",$name);
$cvc = $_POST["cvc"];
$cvc = str_replace($magic,"",$cvc);
$emaill = $_POST["mail"];
$email = str_replace($magic,"",$email);
if(!$reg){
exit();
}
if(!$name){
exit('<div id="warning">Введите имя!</div>');
}
if(!$email){
exit('<div id="warning">Введите e-mail!</div>');
}
if(!ctype_digit($cvc)){
exit('<div id="warning">CVC должен состоять из 3 цифр!</div>');
} elseif($cvc>999) {
exit('<div id="warning">CVC должен состоять из 3 цифр!</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u659781831_money", "zh10101", "u659781831_money");
if ($stmt = $mysqli->prepare("SELECT ISC FROM comfortcard WHERE IP=$ip;")) {

$stmt->execute();

$stmt->bind_result($isip);

$stmt->fetch();

$stmt->close();
}
if($isip>0){
echo('<div id="warning">Для регистрации второй карты обратитесь в сервисный центр.</div>');
} else {
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u659781831_money", "zh10101", "u659781831_money");
if ($stmt = $mysqli->prepare("INSERT INTO comfortcard(NAME,CVV,EMAIL) VALUES('$name','$email','$cvc');")) {

$stmt->execute();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u659781831_money", "zh10101", "u659781831_money");
if ($stmt = $mysqli->prepare("SELECT NUM IN comfortcard WHERE NAME='$name' ORDER BY NUM DESC LIMIT 1,1;")) {

$stmt->execute();

$stmt->bind_result($number);

$stmt->fetch();

$stmt->close();
}
printf('<div id="ok">Номер Вашего счёта-%s</div>',$number);
}
?>