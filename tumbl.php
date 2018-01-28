<?php header("Content-Type: text/html; charset=utf-8");
/**@package KALINKA @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2016 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 0.9.2
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
if(isset($_POST['tumb']))
$tumb=htmlspecialchars(strip_tags(trim($_POST['tumb'])));
if (file_exists("install/"))
{if(empty($tumb)) die("Доступ закрыт");
else
{if (file_exists("install/style.css")) unlink("install/style.css");clearstatcache();
if (file_exists("install/strelka.png")) unlink("install/strelka.png");clearstatcache();
if (file_exists("install/finish1.php")) unlink("install/finish1.php");clearstatcache();
if (file_exists("install/index.php"))
if(unlink("install/index.php")) rmdir("install/");clearstatcache();
header ("Location:office/");}
}
?>
