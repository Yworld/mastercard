<div align="right"><input type="button" class="btn btn-danger" value="x" onclick="co()"></div>
<?php
$magic = array("'",'"');
$sid = $_POST['sid'];
$sid = str_replace($magic,"",$sid);
$code = $_POST['code'];
$code = str_replace($magic,"",$code);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT NUM FROM sessions WHERE SID='$sid';")) {

$stmt->execute();

$stmt->bind_result($num);

$stmt->fetch();

$stmt->close();
}
if(!$num){
exit('<div id="warning">Ошибка NS-NON.Попробуйте ещё раз. В случае повторения ошибки обратитесь в службу поддержки.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT CODE FROM POP WHERE CODE='$code';")) {

$stmt->execute();

$stmt->bind_result($isc);

$stmt->fetch();

$stmt->close();
}
if(!$isc){
exit('<div id="warning">Такого заказа не существует.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT USED FROM POP WHERE CODE='$code';")) {

$stmt->execute();

$stmt->bind_result($used);

$stmt->fetch();

$stmt->close();
}
if($used>0){
exit('<div id="warning">Этот заказ уже погашен.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT EUR FROM POP WHERE CODE='$code';")) {

$stmt->execute();

$stmt->bind_result($eurfrom);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT EURO FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($euris);

$stmt->fetch();

$stmt->close();
}
$eurto = $eurfrom + $euris;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("UPDATE `comfortcard` SET `EURO`='$eurto' WHERE `NUM`='$num';")) {

$stmt->execute();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("UPDATE `POP` SET `USED`='1' WHERE `CODE`='$code';")) {

$stmt->execute();

$stmt->close();
}
echo("<div id=\"ok\">Мы доставили Ваш заказ.</br>Теперь у Вас <b>{$eurto}</b> EUR.</div>");
?>