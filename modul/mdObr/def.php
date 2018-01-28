<?php session_start();header("Content-Type: text/html; charset=utf-8");define ( 'BUGIT', true );
/**@package KALINKA @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2016 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 0.9.2
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
if (file_exists("../../common/mml.php"))
{$prov_cod=rand(1000,9980); $prov_cod_2=rand(1,19);
/* Здесь проверяется существование переменных */
if (isset($_POST['name'])) {$name = $_POST['name'];}
if (isset($_POST['email'])) {$email = $_POST['email'];}
if (isset($_POST['sub'])) {$sub = $_POST['sub'];}
if (isset($_POST['body'])) {$body = $_POST['body'];}
if (file_exists("../../common/mml.php")) include_once "../../common/mml.php";
/* Сюда впишите свою эл. почту */
if(isset($mymail)) $address=$mymail;
if(isset($_POST['contr_cod']) && (md5($_POST['contr_cod'])!=$_POST['prov_summa'])) echo '<font color="red"><b>Неверный проверочный код!';
if (isset($_POST['prov_summa'])){if (md5($_POST['contr_cod'])==$_POST['prov_summa'])
/* А здесь прописывается текст сообщения, \n - перенос строки */
{$mes = "Имя: $name \nE-mail: $email \nТема: $sub \nТекст: $body";
/* А эта функция как раз занимается отправкой письма на указанный вами email */
$send=mail ($address,$sub,$mes,"Content-type:text/plain; charset = utf-8\r\nFrom:$email");
if ($send == 'true'){echo "<br><h4>Сообщение отправлено</h4>";}
else {echo "<br><h4>Сообщение не отправлено</h4>";}
}
}}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8"><META NAME="Robots" CONTENT="NOINDEX,NOFOLLOW"><style>body{background-color:#c4d8f1;}.shapka_obr{margin:0 auto; padding:0; height:120px;background-color:#00607f;border-left:none;padding:0px;border-right:none;border-bottom:5px solid #c4f1ff;}
#page_obr{margin:0 auto;padding:0;background-color:#c4d8f1;height:100%;overflow:hidden;}
#logo_obr{width:250px;height:110px;margin-left:2%; margin-top:1%;float:left;}.n{color:#333;background:#fff;width:360px;padding:5px;border:1px solid #ddd;}</style>
<title>Обратная связь</title>
</head>
<body>
<div class="shapka_obr"><div id="logo_obr"><img src="../../images/kalinalogtp.png"/></div>
<header><h2>ОБРАТНАЯ СВЯЗЬ</h2></header>
</div>
<?php //Запрет доступа
if(empty($_SESSION['costomer'])) die("Пожалуйста, зарегистрируйтесь предварительно на сайте!<br><a href='../../index.php'>Вернуться на сайт</a>"); else { if(empty ($mymail)) echo "Извините, почта временно не работает";else { ?>
<div id="page_obr">   
<div class="n"><h3>Форма обратной связи</h3>
<form name="" action="" method="POST">
<p>Ваше имя:</p><p><input class="input" name="name" type="text" value="<?php echo $_SESSION['nickname'];?>" required /></p>
<p>Эл. почта:</p><p><input class="input" name="email" type="email" value="<?php echo $_SESSION['costomer'];?>" required /></p>
<p>Тема:</p><p><input class="input" name="sub" type="text" required/></p>
<p valign="top">Текст сообщения:</p>
<p><textarea name="body" rows="5"></textarea></p>
<tr><td style="font-family:Verdana;color:#fef0d9;font-size:12px align="center">
<b><? echo $prov_cod ?> + <? echo $prov_cod_2 ?> = </b>
<input type="hidden" name="prov_summa" value="<? echo md5($prov_cod+$prov_cod_2) ?>">
<input type="text" name="contr_cod" maxlength="4" size="4" required>
<p><input value="Отправить" type="submit" /></p>
</form>
</div>
<?php
}}
?>
<p><a href='../../index.php'>Вернуться на сайт</a></p>
</body></html>
