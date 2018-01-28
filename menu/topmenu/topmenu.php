<?php if(!defined ('BUGIT')) exit ("Ошибка соединения");
/**@package  KALINKA  @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2016 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 0.9.2
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
if(file_exists("mainbook.php"))	{
echo "<div class='firstline'><p class='p3'>";if(isset($unit) && $unit==="book") echo "Блог";else echo "<a href='index.php?unit=book'>Блог</a>"; echo "</p></div>";}
if(file_exists("mainbook1.php"))	{
echo "<div class='firstline'><p class='p3'>";if(isset($unit) && $unit==="book1") echo "Блог1";else  echo "<a href='index.php?unit=book1'>Блог1</a>"; echo "</p></div>";}
if(file_exists("mainfreeware.php"))	
{ echo "<div class='firstline'><p class='p3'>";if(isset($unit) && $unit==="freeware") echo "Скачивания";else  echo "<a href='index.php?unit=freeware'>Скачивания</a>"; echo "</p></div>";
}
if(file_exists("mainpayware.php"))	
{ echo "<div class='firstline'><p class='p3'>";if(isset($unit) && $unit==="payware") echo "Консультации";else  echo "<a href='index.php?unit=payware'>Консультации</a>"; echo "</p></div>";
}
if(file_exists("mainshop.php"))	
{echo "<div class='firstline'><p class='p3'>";if(isset($unit) && $unit==="shop") echo "Магазин";else  echo "<a href='index.php?unit=shop'>Магазин</a>"; echo "</p></div>";}
