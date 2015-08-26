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
exit('<div id="warning">Ошибка C2C-NON. Попробуйте ещё раз. Если ошибка повторяется вновь, обратитесь в службу поддержки.</div>');
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
exit();
}
?>
<center>
<div id="transfer" style="width:250;">
<input type="text" class="form-control" id="to" placeholder="Получатель">
<input type="text" class="form-control" id="sum" placeholder="Сумма">
<input type="password" class="form-control" id="cvc" placeholder="CVC2">
<input type="text" class="form-control" id="comm" placeholder="Комментарий">
<?php
printf('<input type="hidden" value="%s" id="sid">',$sid);
?>
</br>
<input type="button" class="btn btn-info btn-block" onclick="c2c();" value="Перевести">
</div>
</center>