<div align="right"><input type="button" class="btn btn-danger" value="x" onclick="co()"></div>
<?php
$magic = array("'",'"');
$sid = $_POST['sid'];
$sid = str_replace($magic,"",$sid);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT NUM FROM sessions WHERE SID='$sid';")) {

$stmt->execute();

$stmt->bind_result($num);

$stmt->fetch();

$stmt->close();
}
if(!$num){
exit('<div id="warning">Ошибка SP2-NON. Попробуйте ещё раз. Если ошибка повторяется вновь, обратитесь в службу поддержки.</div>');
}
?>
<input type="text" id="theme" class="form-control" placeholder="Тема вопроса">
<textarea class="form-control" id="qi" placeholder="Опишите Ваш вопрос подробнее"></textarea></br>
<input type="button" onclick="sendq(); return false;" class="btn btn-info btn-block" value="Отправить вопрос">