<?php session_start();
//if(!defined ('BUGIT')) exit ('Ошибка соединения');
/**@package KALINKA @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2017 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 1.0.0
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
if($_SESSION['valt']) unset($_SESSION['valt']);
if($_SESSION['costomer']) unset($_SESSION['costomer']);
if ($_SESSION['nickname']) unset($_SESSION['nickname']);
if ($_SESSION['groupcostomer']) unset($_SESSION['groupcostomer']);
// Наконец, разрушить сессию.
session_destroy();
//Переадресовываем на главную
header ("Location: index.php");
?>
