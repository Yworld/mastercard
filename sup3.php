<div align="right"><input type="button" class="btn btn-danger" value="x" onclick="co()"></div>
<?php
$magic = array("'",'"');
$sid = $_POST['sid'];
$sid = str_replace($magic,"",$sid);
$theme = $_POST['theme'];
$theme = str_replace($magic,"",$theme);
$q = $_POST['q'];
$q = str_replace($magic,"",$q);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT NUM FROM sessions WHERE SID='$sid';")) {

$stmt->execute();

$stmt->bind_result($num);

$stmt->fetch();

$stmt->close();
}
if(!$num){
exit('<div id="warning">Ошибка SP3-NON. Попробуйте ещё раз. Если ошибка повторяется вновь, обратитесь в службу поддержки.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT SUPB FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($isb);

$stmt->fetch();

$stmt->close();
}
if($isb==1){
exit('<div id="warning">Вам запрещено задавать вопросы.</div>');
}
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("INSERT INTO `SUPPORT`(`NUM`,`THEME`,`QUEST`,`STATUS`) VALUES ('$num','$theme','$q','Нет ответа');")) {

$stmt->execute();
$stmt->close();
}
exit('<div id="ok">Вопрос задан.</div>');
?>