<div align="right"><input type="button" class="btn btn-danger" value="x" onclick="co()"></div>
<?php
$magic = array("'",'"');
$sid = $_POST['sid'];
$sid = str_replace($magic,"",$sid);
$id = $_POST['q'];
$id = str_replace($magic,"",$id);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT NUM FROM sessions WHERE SID='$sid';")) {

$stmt->execute();

$stmt->bind_result($num);

$stmt->fetch();

$stmt->close();
}
if(!$num){
exit('<div id="warning">Ошибка Q-NON. Попробуйте ещё раз. Если ошибка повторяется вновь, обратитесь в службу поддержки.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT NUM FROM SUPPORT WHERE ID='$id';")) {

$stmt->execute();

$stmt->bind_result($realnum);

$stmt->fetch();

$stmt->close();
}
if($num!=$realnum){
exit('<div id="warning">Ошибка Q-ANN. Попробуйте ещё раз. Если ошибка повторяется вновь, обратитесь в службу поддержки.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT THEME FROM SUPPORT WHERE ID='$id';")) {

$stmt->execute();

$stmt->bind_result($theme);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT QUEST FROM SUPPORT WHERE ID='$id';")) {

$stmt->execute();

$stmt->bind_result($q);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT STATUS FROM SUPPORT WHERE ID='$id';")) {

$stmt->execute();

$stmt->bind_result($status);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT ANS FROM SUPPORT WHERE ID='$id';")) {

$stmt->execute();

$stmt->bind_result($ans);

$stmt->fetch();

$stmt->close();
}
echo("<div id=\"ok\">ID вопроса-{$id}</div>");
echo("{$q}");
echo('</br><div align="right"><i>—Вы</i></div>');
if($status!='Ответ есть'){
} else {
echo("{$ans}");
echo('</br><div align="right"><i>—Агент поддержки</i></div>');
}
?>