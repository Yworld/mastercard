<div align="right"><input type="button" class="btn btn-danger" value="x" onclick="co()"></div>
<?php
$magic = array("'",'"');
$sid = $_POST['sid'];
$sid = str_replace($magic,"",$sid);
$name = $_POST['name'];
$name = str_replace($magic,"",$name);
$logo = $_POST['logo'];
$logo = str_replace($magic,"",$logo);
$ip = $_SERVER["REMOTE_ADDR"];
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT NUM FROM sessions WHERE SID='$sid';")) {

$stmt->execute();

$stmt->bind_result($num);

$stmt->fetch();

$stmt->close();
}
if(!$num){
exit('<div id="warning">Ошибка MS-NON. Попробуйте ещё раз. Если ошибка повторилась вновь, обратитесь в поддержку.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT CVV FROM sessions WHERE SID='$sid';")) {

$stmt->execute();

$stmt->bind_result($cvc);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT SERVICES FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($services);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT ISS FROM comfortcard WHERE SERVICE_NAME='$name';")) {

$stmt->execute();

$stmt->bind_result($isss);

$stmt->fetch();

$stmt->close();
}
if($isss==1){
exit('<div id="warning">Такая услуга уже существует..</div>');
}
if($services>2){
exit('<div id="warning">Ошибка MS-TMS. Попробуйте ещё раз. Если ошибка повторилась вновь, обратитесь в поддержку.</div>');
}
echo("<script>console.log('{$name}');</script>");
echo("<script>console.log('{$logo}');</script>");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("INSERT INTO `comfortcard`(`EURO`, `CVV`, `IP`, `SERVICE_NAME`, `ISS`, `MASTER`, `LOGO`) VALUES ('0','$cvc','$ip','$name','1','$num','$logo');")) {

$stmt->execute();

$stmt->close();
}
$newservices = $services + 1;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("UPDATE `comfortcard` SET `SERVICES`='$newservices' WHERE `NUM`='$num'")) {

$stmt->execute();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT NUM FROM comfortcard WHERE SERVICE_NAME='$name';")) {

$stmt->execute();

$stmt->bind_result($newnum);

$stmt->fetch();

$stmt->close();
}
?>
<div id="ok">Услуга успешно создана. <?php
echo("Номер счёта услуги- {$newnum}. ");
?> Используйте CVC2 от Вашего счёта.</div>