<?php session_start();header("Content-Type: text/html; charset=utf-8");define ( 'BUGIT', true );
/**CMS KALINKA- свободный пакет программ: Вы можете *перераспространять ее и/или изменять ее на условиях Стандартной общественной *лицензии GNU GPL версия 3 в том виде, в каком лицензия *была опубликована Фондом свободного программного *обеспечения CMS KALINKAru распространяется в надежде, что она будет *полезной,но БЕЗ ВСЯКИХ ГАРАНТИЙ, даже без неявной гарантии ТОВАРНОГО ВИДА или ПРИГОДНОСТИ ДЛЯ ОПРЕДЕЛЕННЫХ ЦЕЛЕЙ.Подробнее см. в Стандартной общественной лицензии GNU
/**@package KALINKA @author Родионова Галина Евгеньевна https://unatka.ru * @copyright Copyright © 2013-2016 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 1.0.0
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
	
//Подключение базы
include_once "variables/variac.php";
$mysqli=new mysqli(base64_decode($server),base64_decode($username),base64_decode($parol),base64_decode($datbas));
/* проверка соединения */
if(mysqli_connect_errno()) {
   printf("Соединение не установлено: %s\n", mysqli_connect_error());exit();
} 

if(file_exists("common/top.php")) include_once "common/top.php";
if(isset($unit)) 
   if(file_exists("$unit/top.php")) include_once "$unit/top.php";
 //Дальше вставлен шаблон
if(!isset($osnova)) $osnova="simple";
 ob_start("sanitize_output");

   if(file_exists("template/$osnova/mainfile.php")) 
      include_once "template/$osnova/mainfile.php";

ob_end_flush();
