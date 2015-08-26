<?php
$magic = array("'",'"');
$sid = $_POST['sid'];
$sid = str_replace($magic,"",$sid);
$to = $_POST['to'];
$to = str_replace($magic,"",$to);
$sum = $_POST['sum'];
$sum = str_replace($magic,"",$sum);
$cvc = $_POST['cvc'];
$cvc = str_replace($magic,"",$cvc);
$comm = $_POST['comm'];
$comm = str_replace($magic,"",$comm);
$check = $_SERVER["HTTP_REFERER"];
if($check!='http://xn--80aamczj4acek.ml/cabinet.php') {
echo('<meta charset="UTF-8">');
exit('<div style="background: repeat-y #FFDAB9;margin-left: 15px;margin-right: 15px;">Извините, эта страница не предназначена для работы по принципу API.</div>');
}
if(!ctype_digit($sum)) {
exit('<div id="warning">Сумма должна состоять только из цифр!</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT NUM FROM sessions WHERE SID='$sid';")) {

$stmt->execute();

$stmt->bind_result($num);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT CVV FROM sessions WHERE SID='$sid';")) {

$stmt->execute();

$stmt->bind_result($realcvc);

$stmt->fetch();

$stmt->close();
}
if(!$num){
exit('<div id="warning">Ошибка CH-NON1. Попробуйте ещё раз. В случае повторения ошибки обратитесь в службу поддержки.</div>');
}
if($realcvc!=$cvc){
exit('<div id="warning">CVC2 неверен.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT BLOCK FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($block);

$stmt->fetch();

$stmt->close();
}
if($block>0){
exit('<div id="warning">Ошибка CH-YB. Попробуйте ещё раз. В случае повторения ошибки обратитесь в службу поддержки.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT EURO FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($eur);

$stmt->fetch();

$stmt->close();
}
if($eur<$sum){
exit('<div id="warning">Недостаточно средств.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT BLOCK FROM comfortcard WHERE NUM='$to';")) {

$stmt->execute();

$stmt->bind_result($toblock);

$stmt->fetch();

$stmt->close();
}
if($toblock>0){
exit('<div id="warning">Счёт получателя заблокирован.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT ISC FROM comfortcard WHERE NUM='$to';")) {

$stmt->execute();

$stmt->bind_result($isto);

$stmt->fetch();

$stmt->close();
}
if($isto<5){
exit('<div id="warning">Получателя не существует.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT EURO FROM comfortcard WHERE NUM='$to';")) {

$stmt->execute();

$stmt->bind_result($eurto);

$stmt->fetch();

$stmt->close();
}
$eurafterfrom = $eur - $sum;
$eurafterto = $eurto + $sum;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("UPDATE `comfortcard` SET `EURO`='$eurafterfrom' WHERE `NUM`='$num';")) {

$stmt->execute();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("UPDATE `comfortcard` SET `EURO`='$eurafterto' WHERE `NUM`='$to';")) {

$stmt->execute();

$stmt->close();
}
$timestamp = date("r");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT LOGO FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($logo);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("INSERT INTO LOG(NUMFROM,NUMTO,EUR,COMM,DATE,LOGO) VALUES ('$num','$to','$sum','$comm','$timestamp','$logo');")) {

$stmt->execute();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT email FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($email);

$stmt->fetch();

$stmt->close();
}
if($email){
$header = 'From: не-отвечать@xn--80aamczj4acek.ml' . "\r\n" ;
$header.="Subject: Отчёт о трате средств";
$report = "$timestamp\r Счёт #$num\r Получатель #$tol\r Сумма: $sum евро\r Комментарий: $comm";
mail($email, "Отчёт о трате средств", $report, $header);
}
echo('<div id="ok">Перевод успешно завершён.</div>');
?>