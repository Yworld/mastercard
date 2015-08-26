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
exit('<div id="warning">Ошибка SP3-NON. Попробуйте ещё раз. Если ошибка повторяется вновь, обратитесь в службу поддержки.</div>');
}
?>

<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT THEME FROM SUPPORT WHERE NUM='$num' ORDER BY ID DESC LIMIT 0,1;")) {

$stmt->execute();

$stmt->bind_result($th);

$stmt->fetch();

$stmt->close();
}
if(!$th){
exit('<div id="warning">Вы не задавали вопросов.</div>');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT ID FROM SUPPORT WHERE NUM='$num' ORDER BY ID DESC LIMIT 0,1;")) {

$stmt->execute();

$stmt->bind_result($qid);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT THEME FROM SUPPORT WHERE NUM='$num' ORDER BY ID DESC LIMIT 1,2;")) {

$stmt->execute();

$stmt->bind_result($th2);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT ID FROM SUPPORT WHERE NUM='$num' ORDER BY ID DESC LIMIT 1,2;")) {

$stmt->execute();

$stmt->bind_result($qid2);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT STATUS FROM SUPPORT WHERE NUM='$num' ORDER BY ID DESC LIMIT 0,1;")) {

$stmt->execute();

$stmt->bind_result($stat);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT STATUS FROM SUPPORT WHERE NUM='$num' ORDER BY ID DESC LIMIT 1,2;")) {

$stmt->execute();

$stmt->bind_result($stat2);

$stmt->fetch();

$stmt->close();
}
echo("<table><tr><td>{$th}</td><td>&nbsp;<input type=\"button\" class=\"btn btn-info\" value=\"{$stat}\" onclick=\"viewq('{$qid}');\"></td></tr>");
if($qid2){
echo("<tr><td>{$th2}</td><td>&nbsp;<input type=\"button\" class=\"btn btn-info\" value=\"{$stat2}\" onclick=\"viewq('{$qid2}');\"></td></tr></table>");
}
?>