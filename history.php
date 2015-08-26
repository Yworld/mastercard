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
exit('<div id="warning">Ошибка HS-NON1. Если она повторяется вновь, обратитесь в поддержку.</div>');
}
?>
<center>
<div class="btn-group" role="toolbar" aria-label="Card options">
<input type="button" class="btn btn-info disabled" value="От Вас">
<input type="button" class="btn btn-info" onclick="hto();" value="К Вам">
</center>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT LOGO FROM LOG WHERE NUMFROM='$num' ORDER BY OPERATION_ID DESC LIMIT 0,1 ;")) {

$stmt->execute();

$stmt->bind_result($lastlogo);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT NUMTO FROM LOG WHERE NUMFROM='$num' ORDER BY OPERATION_ID DESC LIMIT 0,1 ;")) {

$stmt->execute();

$stmt->bind_result($numto);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT EUR FROM LOG WHERE NUMFROM='$num' ORDER BY OPERATION_ID DESC LIMIT 0,1 ;")) {

$stmt->execute();

$stmt->bind_result($eur);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT COMM FROM LOG WHERE NUMFROM='$num' ORDER BY OPERATION_ID DESC LIMIT 0,1 ;")) {

$stmt->execute();

$stmt->bind_result($comment);

$stmt->fetch();

$stmt->close();
}
if(!$numto){
echo('Операций не было.');
} else {
$last = '<tr><td><img src="' .$lastlogo. '" width="50px"></td><td> #' .$numto. '</td><td>&nbsp;'  .$eur. '</td><td>&nbsp;EUR </td><td>&nbsp;' . $comment. '</td></td>';
echo('<table>');
echo($last);
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT LOGO FROM LOG WHERE NUMFROM='$num' ORDER BY OPERATION_ID DESC LIMIT 1,2 ;")) {

$stmt->execute();

$stmt->bind_result($lastlogo);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT NUMTO FROM LOG WHERE NUMFROM='$num' ORDER BY OPERATION_ID DESC LIMIT 1,2 ;")) {

$stmt->execute();

$stmt->bind_result($numto);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT EUR FROM LOG WHERE NUMFROM='$num' ORDER BY OPERATION_ID DESC LIMIT 1,2 ;")) {

$stmt->execute();

$stmt->bind_result($eur);

$stmt->fetch();

$stmt->close();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("mysql.hostinger.ru", "u621395238_money", "zh10101", "u621395238_money");
if ($stmt = $mysqli->prepare("SELECT COMM FROM LOG WHERE NUMFROM='$num' ORDER BY OPERATION_ID DESC LIMIT 1,2 ;")) {

$stmt->execute();

$stmt->bind_result($comment);

$stmt->fetch();

$stmt->close();
}
if(!$numto){
echo('</table>');
} else {
$last = '<tr><td><img src="' .$lastlogo. '" width="50px"></td><td>#' .$numto. '</td><td>&nbsp;'  .$eur. '</td><td>&nbsp;EUR </td><td>&nbsp;' . $comment. '</td></tr></table>';
echo($last);
}
?>