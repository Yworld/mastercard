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
exit('<div id="warning">Ошибка SP1-NON. Попробуйте ещё раз. Если ошибка повторяется вновь, обратитесь в службу поддержки.</div>');
}
?>
<div id="sup-window" width="350px;">
<input type="button" class="btn btn-info btn-block" onclick="history();" value="История">
<input type="button" class="btn btn-info btn-block" onclick="support();" value="Задать вопрос">
<input type="button" class="btn btn-info btn-block" onclick="faq();" value="FAQ">
<input type="button" class="btn btn-info btn-block" onclick="vreq();" value="Получить выписку">
<input type="button" class="btn btn-success btn-block" onclick="my();" value="Мои вопросы">
</div>