<?php header("Content-Type: text/html; charset=utf-8");if(!defined ('BUGIT')) exit ('Ошибка соединения');
/**@package  KALINKA  @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2017 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 1.0.0
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
//Если узлы отсутствуют - подключаем узел Блог
if(isset($_GET['unit'])) $unit=addslashes(strip_tags(trim($_GET['unit'])));
else {$unit="book";} 
if(isset($_GET['id'])) $id=intval($_GET['id']); 
else $id=1;
//Включение служебных файлов: текущее меню, текущий шаблон
if(file_exists("variables/menusd.php")) include_once "variables/menusd.php";
/*if(file_exists("variables/vartempl.php")) {
    if(file_get_contents("variables/vartempl.php")) 
       include_once "variables/vartempl.php";
}*/

$today=date("Y-m-d");//Дата опубликования или изменения 
//Информация - узлы
$arrforblock=array("book"=>"Блог","book1"=>"Блог1","book2"=>"Блог2","book3"=>"Блог3","book4"=>"Блог4","freeware"=>"Скачивания","shop"=>"Магазин","payware"=>"Платные продукты");
//Если узлы отсутствуют - подключаем узел Блог
if(isset($_GET['unit'])) $unit=addslashes(strip_tags(trim($_GET['unit'])));
else {$unit="book";} 
if(isset($_GET['id'])) $id=intval($_GET['id']); 
else $id=1;
//Перенаправление на скачивание свободных продуктов
if(isset($_GET['freeload'])) $freeload=addslashes(strip_tags(trim($_GET['freeload'])));
if(isset($unit) && isset($_GET[$unit])) $kat=addslashes(strip_tags(trim($_GET[$unit])));//Случай отображения ряда страниц на одной вкладке
//Вход!!!!!!!!
if(isset($_POST['enter'])) $enter=htmlspecialchars(trim($_POST['enter']));
if(isset($enter)) {
    //Согласие
     if(isset($_POST['agry'])) $agry=htmlspecialchars(strip_tags(trim($_POST['agry'])));
    //Электронная почта покупателя
     if(isset($_POST['eml'])) $eml=htmlspecialchars(strip_tags(trim($_POST['eml'])));
    //Группа пользователя
      if(isset($_POST['groupcostomer'])) $groupcostomer=intval($_POST['groupcostomer']);
    //Имя 
      if(isset($_POST['nickname'])) $nickname=htmlspecialchars(strip_tags(trim($_POST['nickname'])));
      if(isset($_POST['ip'])) $ip=htmlspecialchars(strip_tags(trim($_POST['ip']))); $ip=str_replace(".","",$ip);
          if(isset($eml)) $emal= $mysqli->real_escape_string($eml);
          if(isset($nickname)) $namekd= $mysqli->real_escape_string($nickname);
          if(isset($groupcostomer)) $groupkd= $mysqli->real_escape_string($groupcostomer);
//if(isset($regsub)) {
   $err=array();
   if(!isset($agry)) $err[] = "Простите, мы не можем зарегистрировать Вас без Вашего согласия.";
   if(!preg_match("/^[a-zA-Zа-яА-Я0-9-_\.]{1,11}+(\s){0,2}+[a-zA-Zа-яА-Я-_\.]{0,14}+$/u", $nickname)) $err[] = "Имя не может содержать менее 2 символов";
   if(!preg_match("/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/i", $eml)) $err[] = "Некорректный адрес электронной почты";
$mistake=count($err);
//Если нет ошибок, 
if($mistake === 0) {
  $mysqli->query("SET NAMES 'utf8'");
  if(isset($emal))
    $res = $mysqli->query("SELECT * FROM costomers WHERE email='$emal'");
      $row =$res->fetch_assoc();
//Если данные есть в базе, присваиваем сессию
  if(isset($row['email']) && isset($row['name'])) {
    if($row['name']===$namekd && $row['email']===$emal) {
         if(isset($row['groupcost']) && $row['groupcost']>3) {
         $emrk=$eml;
         $_SESSION['costomer']=$emrk;
         $nmrk=$nickname;
         $_SESSION['nickname']=$nmrk;
         $_SESSION['groupcostomer']=$groupkd;
if(isset($res)) $res->close();
       } 
     else die("Администраторы здесь не регистрируются!");
    }
  else die("Такой пользователь уже существует!");
 }
//Если данных нет, вносим их в базу и присваиваем сессию
else {
   $mysqli->query("SET NAMES 'utf8'");
    $query ="INSERT INTO costomers(groupcost,email,name,ip) VALUES('".$groupcostomer."','".$emal."','".$namekd."','".$ip."')";
    $result=$mysqli->query($query);
//Если данные успешно занесены в таблицу
      if($result===TRUE) {
          $emrk=$eml;
          $_SESSION['costomer']=$emrk;
          $nmrk=$nickname;
          $_SESSION['nickname']=$nmrk;//И
         $_SESSION['groupcostomer']=$groupkd;
        }
    }
  }	
//Если не так, то выводим ошибку
  else { 
     echo "<b>При регистрации произошли следующие ошибки:</b><br>";
       foreach($err as $error) echo $error."<br>";
   }
}
//Domain
$heading="cms-kalinka v 1.0.0";
//Logotype
$logotype="logotype.png";
//Вызов массива модулей
if(file_exists("common/modulen.txt")) {
   $ct="common/modulen.txt";
     $fon=fopen($ct, "r");
       $immod=unserialize(fread($fon, filesize($ct)));
         if(!is_array ($immod)) {// если что-то прошло не так, инициализировать  массив
             $immod=array("modcreg"=>array("pos"=>6,"russ"=>"Модуль входа",'dopcon'=>0),"mdObr"=>array("pos"=>0,"russ"=>"Обратная связь",'dopcon'=>16));
    }
 fflush($fon);
 fclose($fon);
}
//Определяем позицию модулей
if(isset($immod)) {
   foreach($immod as $key=>$val)
      $posone[$key]=$immod[$key]['pos'];
         $pos=array_flip($posone);
}
//шаблоны. Массив 
if(!file_exists("common/templates.txt") && !isset($imtempl)) {
    $imtempl=array("simple"=>array("join"=>1));
       touch("common/templates.txt");
        $firstm=serialize($imtempl);
         $paq = fopen( "common/templates.txt", "w") or die( "Такой позиции не существует");
          fputs( $paq, "$firstm");
          fflush($paq);
          fclose( $paq);        
      @header("Location: ".$_SERVER['HTTP_REFERER']);
    }
  else {
     if(file_exists("common/templates.txt")) {
        $ct="common/templates.txt";
        $fon=fopen($ct, "r");
        $imtempl=unserialize(fread($fon, filesize($ct)));
                             if(!is_array ($imtempl)) {
// если что-то прошло не так, инициализировать  массив 
                  $imtempl=array("simple"=>array("join"=>1));
         }
        fflush($fon);
        fclose($fon);clearstatcache();
     }
 } 
if(isset($imtempl)) 
  foreach($imtempl as $k=>$v) 
    if(isset($imtempl[$k]["join"]))  
      if($imtempl[$k]["join"]===1) $osnova=$k;
      else $osnova="simple";
 
if(file_exists("template/$osnova/newkey.php")) { 
   include_once "template/$osnova/newkey.php";
      if(isset($keytempl)) $fortemplate=explode(",",$keytempl); 
if(isset($fortemplate) && $fortemplate[0]==="plat") {// Для платных шаблонов проверка
    if($fortemplate[1]!=="ac22f5e1e233b67b656b703942b5b43e77402fe2")
          $osnova="simple";
    } 
}
//*****Работа с БД*********
//Переменные имен таблиц БД
if(isset($unit) && $unit!=="freeload" && $unit!=="common") {
      $maintable=$unit;
      $parttable="part".$unit;
                  if($unit!=="common")
                           $feedbacktable="feedback".$unit;
                   if($unit==="payware" || $unit==="shop")
                           $accountingtable="accounting".$unit;
//Проверка записей в таблице Статьи
$mysqli->query("SET NAMES 'utf8'");
if(isset($maintable)) {
   if($articfirst=$mysqli->query("SELECT id FROM $maintable")) {
       $num=$articfirst->num_rows; 
       if(isset($num) && $num>0) $idartic="YES";
    } 
   else {$idartic="No";}
if($articfirst) $articfirst->close();
}
// проверка на наличие разделов********************
if($partfirst=$mysqli->query("SELECT id FROM $parttable")) {
  $num=$partfirst->num_rows; 
    if(isset($num) && $num>0) $idfirst="YES";
} 
else {$idfirst="No";}
if($partfirst) $partfirst->close();

    if(isset($feedbacktable))
      if($feedfirst=$mysqli->query("SELECT id FROM $feedbacktable")) {
        $num=$feedfirst->num_rows; 
          if(isset($num) && $num>0) $feed="YES";
          } 
        else $feed="No";
     if(isset($feedfirst)) $feedfirst->close();
//feedbacktable
if(isset($feedbacktable)) {
$mysqli->query("SET NAMES 'utf8'");
$insertfeed=$mysqli->prepare("INSERT INTO $feedbacktable (comment,namecostomer,email,idarticle,namearticle,dat,moder) VALUES (?,?,?,?,?,?,?)");
$insertfeed->bind_param('sssissi',$feedcomment,$feedcostomer,$feedemail,$feedarticle,$feednamearticle,$feeddt,$feedmoder);
}
if(isset($feed) && $feed==="YES") {
//Изменение данных
$mysqli->query("SET NAMES 'utf8'");
$upallfeed=$mysqli->prepare("UPDATE $feedbacktable SET comment=?,dat=?,moder=? WHERE id=?");
$upallfeed->bind_param('ssii',$upfeedcomment,$upfeeddt,$upfeedmoder,$uptotid);
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
$mysqli->query("SET NAMES 'utf8'");
if(isset($feedbacktable)) {$idarticle=$id;
      if($commentfeed=$mysqli->prepare("SELECT id,comment,namecostomer,namearticle,dat FROM $feedbacktable WHERE idarticle=? AND moder=1")) {
         $commentfeed->bind_param('i',$idarticle); 
         $commentfeed->execute(); 
         $commentfeed->bind_result($commid,$comm,$feedname,$feednmarticle,$feeddtart); 
                       while($commentfeed->fetch()) {
                               $commentary[$commid]=$comm;
                               $withcostomer[$commid]=$feedname;
                               $withnamearticle[$commid]=$feednmarticle;
                               $withidat[$commid]=$feeddtart;
                                 } 
                           if(isset($commentfeed)) $commentfeed->close();
       }
    }
//}
//Все статьи выборка idpart***********************************
$mysqli->query("SET NAMES 'utf8'");
if(isset($maintable)) if(isset($idartic) && $idartic==="YES") {
if($selmainmenu=$mysqli->prepare("SELECT id,idpart FROM $maintable ORDER BY list ")) {
  $selmainmenu->execute(); 
  $selmainmenu->bind_result($idmain, $idpartmain); 
    while($selmainmenu->fetch()) {
      $idpart[$idmain]=$idpartmain;
        } 
   if(isset($selmainmenu)) $selmainmenu->close();
    }
}
//Простые статьи выборка заголовков**************************
$mysqli->query("SET NAMES 'utf8'");
if(isset($maintable)) if(isset($idartic) && $idartic==="YES") {
 if($selkeymenu=$mysqli->prepare("SELECT id,title FROM $maintable WHERE idpart=0  ORDER BY list ")) {
   $selkeymenu->execute(); 
   $selkeymenu->bind_result($idkey,$titlekey); 
     while($selkeymenu->fetch()) {
       $menutitle[$idkey]=$titlekey;
     } 
  if(isset($selkeymenu)) $selkeymenu->close();
  }
}
//Выборка данных разделов*********************************
$mysqli->query("SET NAMES 'utf8'");
if(isset($idfirst) && $idfirst==="YES") {
  if($res=$mysqli->query("SELECT * FROM $parttable ORDER BY list")) 
        while($menupt=$res->fetch_assoc()) {
         if(isset($menupt["id"])) 
         $forcontent=$menupt["id"];
         $menupart[$forcontent]=$menupt["title"];
         $listpart[$forcontent]=$menupt["list"];
  }
if(isset($res)) $res->close();if(isset($forcontent)) unset($forcontent);
}
//Если  номер раздела имеется выводим контент вложенных в раздел статей
  if(isset($idpart))
       foreach($idpart as $keypart=>$valpart) { 
                  $mysqli->query("SET NAMES 'utf8'");
if(isset($maintable)) if(isset($idartic) && $idartic==="YES") {
   if($selmenupart=$mysqli->prepare("SELECT id,title FROM $maintable WHERE idpart='$valpart' ORDER BY list")) {
     $selmenupart->execute(); 
     $selmenupart->bind_result($idpt,$titlekeypt); 
       while($selmenupart->fetch()) {
        $menutitlepart[$valpart][$idpt]=$titlekeypt;
         } 
    if(isset($selmenupart)) $selmenupart->close();
      }
    }
  }
if(isset($id) && isset($idpart)) $numberpart=$idpart[$id];
} //end unit
//Выборка common 
$mysqli->query("SET NAMES 'utf8'");
  if($rescomm=$mysqli->query("SELECT * FROM partcommon WHERE title='main' ORDER BY list"))      
        while($menup=$rescomm->fetch_assoc()) {
         if(isset($menup["id"])) 
         $forcomm=$menup["id"];
         $varcom=$forcomm;
         $menucommon[$forcomm]=$menup["title"];
         $listcommon[$forcomm]=$menup["list"];
  }
if(isset($rescomm)) $rescomm->close();if(isset($forcomm)) unset($forcomm);
   if($sel=$mysqli->prepare("SELECT id,title FROM common WHERE idpart='$varcom' ORDER BY list")) {
     $sel->execute(); 
     $sel->bind_result($idcm,$titlecm); 
       while($sel->fetch()) {
        $menutit[$idcm]=$titlecm;
         } 
    if(isset($sel)) $sel->close();
      }
function sanitize_output($buffer) {
    /*preg_match_all('/_[a-zA-Z\-]+:\s.+;|[a-zA-Z\-]+:\s_[a-zA-Z].+;/',
    $buffer, $matches, PREG_PATTERN_ORDER);

$prefixes = array("-o-", "-moz-", "-ms-", "-webkit-", "");
foreach ($matches[0] as $property) {
    $act="";
    foreach ($prefixes as $prefix) {
        $act=preg_replace("_", $prefix, $property);
    }
    $buffer=preg_replace($property, $act, $buffer);*/
//}
    
    $search = array(
        '/(\n)+/s',  // убираем перевод строки
        '/(\r)+/s',  // убираем 
        '/(\t)+/s',  // убираем табуляцию
        '/\>[^\S ]+/s',  // вырезаем после тегов все отступы, кроме пробелов
        '/[^\S ]+\</s',  // вырезаем перед тегами все отступы, кроме пробелов
        '/(\s)+/s',       // заменяем несколько пробелов одним
        '|\/\*.*?\*\/|s',    //comment([\s\S]*?)
        '|\<\!--.*?\--\>|s',    //comment([\s\S]*?)


    );

    $replace = array(
        '',
        '',
        '',
        '>',
        '<',
        '\\1',
        '',
        '',           

    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}

?>
