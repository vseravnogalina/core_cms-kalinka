<?php  //if(!defined('BUGIT')) exit ('Ошибка соединения'); 
define ( 'BUGIT', true );
/**@package KALINKA  @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2017 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 1.0.0
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
//Подключение базы
include_once "../variables/variac.php";
$mysqli=new mysqli(base64_decode($server),base64_decode($username),base64_decode($parol),base64_decode($datbas));
/* проверка соединения */
if(mysqli_connect_errno()) {
   printf("Соединение не установлено: %s\n", mysqli_connect_error());exit();
} 
if(isset($_GET['page'])) $page=addslashes(strip_tags(trim($_GET['page'])));
if(isset($_GET['id'])) $id=intval($_GET['id']); 
else $id=1;
//Domain
$heading="cms-kalinka v 1.0.0";
//Logotype
$logotype="logotype.png";
//*****Работа с БД*********
//Переменные имен таблиц БД
if(isset($page)) {
      $maintable=$page;
      $parttable="part".$page;
//Проверка записей в таблице 
$mysqli->query("SET NAMES 'utf8'");
if(isset($maintable)) {
   if($articfirst=$mysqli->query("SELECT id FROM $maintable")) {
       $num=$articfirst->num_rows; 
       if(isset($num) && $num>0) $idartic="YES";
    } 
   else {$idartic="No";}
if($articfirst) $articfirst->close();
}

//Отображение заголовков, текстов
$mysqli->query("SET NAMES 'utf8'");
if(isset($maintable)) {
         if(isset($id)) {
   if($selarticle=$mysqli->prepare("SELECT title, content,author,dat,keywords,annotation,idpart FROM $maintable WHERE id=? ORDER BY list ")) {
$selarticle->bind_param('i',$id); 
$selarticle->execute(); 
$selarticle->bind_result($titleart,$contentart,$authorart,$datart,$keywordar,$annotar,$partar); 
   while($selarticle->fetch()) {
$titlear[$id]=$titleart;
$contentar[$id]=$contentart;
$authorar[$id]=$authorart;
$datar[$id]=$datart;
$keywords[$id]=$keywordar;
$annotat[$id]=$annotar;
$partr[$id]=$partar;
        } 
if(isset($selarticle)) $selarticle->close();
     }
   }
 }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="robots" content="noindex,nofollow">
<style>.shapka_obr{margin:0 auto; padding:0; height:120px;background-color:#00607f;border-left:none;padding:0px;border-right:none;border-bottom:5px solid #c4f1ff;}
#page_obr{margin:0 auto;padding:0;background-color:#c4d8f1;height:100%;overflow:hidden;}
#logo_obr{width:6em;height:6em;margin-left:2%; margin-top:1%;float:left;}#page_obr div{padding:1.5em; text-align:left;}</style>
<title>Правила</title>
</head>
<body>
<div class="shapka_obr"><div id="logo_obr"><?php echo '<img src="../images/'.$logotype.'" alt="картинка" width="" height="" />'; ?></div>
<header><?php if($heading) echo "<h2>$heading</h2>"; ?></header>
</div>
<a href="../index.php">Вернуться</a>
<div id="page_obr"><div>
<?php    if(isset($titlear[$id]) && isset($contentar[$id]) && isset($authorar[$id]) && isset($datar[$id])) {
     echo "<h1> $titlear[$id]</h1>";
      echo  $contentar[$id];
      echo "<address>";echo $authorar[$id]."</address>";
      echo "<time>".$datar[$id]."</time>";
         }
else echo "Вы заблудились? Сочувствую...";

?></div>
</div><div id="footer"><!-- ПОДВАЛ-->
<br>Сайт работает на CMS KALINKA. Автор CMS KALINKA Copyright © 2013- 2017 Родионова Галина Евгеньевна. Все права защищены.<br>
</div><!--end foter-->
</body></html>
