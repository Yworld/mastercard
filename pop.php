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
exit('<div id="warning">Ошибка AJ-NON.Попробуйте ещё раз. В случае повторения ошибки обратитесь в службу поддержки.</div>');
}
?>
<h4>Пожалуйста, введите номер заказа:</h4></br>
<input type="text" id="code" class="form-control" placeholder="Номер заказа"></br>
<input type="submit" class="btn btn-success btn-block" onclick="pf();" value="Пополнить счёт">