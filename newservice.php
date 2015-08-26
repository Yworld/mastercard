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
exit('<div id="warning">Ошибка NS-NON.Попробуйте ещё раз. В случае повторения ошибки обратитесь в службу поддержки.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT SERVICES FROM comfortcard WHERE NUM='$num';")) {

$stmt->execute();

$stmt->bind_result($services);

$stmt->fetch();

$stmt->close();
}
if($services>2){
exit('<div id="warning">Вы уже создали 3 услуги.</div>');
}
$remain = 3 - $services;
?>
<center>
<?php
if($remain==1){
echo("<h4>Ещё можно создать <b>{$remain}</b> услугу.</h4>");
} else {
echo("<h4>Ещё можно создать <b>{$remain}</b> услуги.</h4>");
}
?>
</center>
<center>
<div id="param" style="width:250;">
<input type="text" class="form-control" id="n" placeholder="Название услуги">
<input type="text" class="form-control" id="l" placeholder="Ссылка на логотип">
<?php
printf('<input type="hidden" value="%s" id="sid">',$sid);
?>
</br>
<input type="button" class="btn btn-info btn-block" onclick="makeservice();" value="Создать">
</div>
</center>