<?php //header("Content-Type: text/html; charset=utf-8");
if(!defined ('BUGIT')) exit ('Ошибка соединения');
/**@package KALINKA  @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2017 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 1.0.0
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
/*menutitle -Заголовки всех простых статей/ключ - id статьи, простая статья с идентификатором idpart=0/,$menupart - массив имен разделов в зависимости от id раздела/ключ -id раздела/,  menutitlepart-вложенные статьи раздела, ключи -1-id раздела 2-id статьи , промежуточный результат $idpart - массив id разделов в зависимости от id статьи.ключ -id статьи.*/
?>
<li><a href="mysitemap.html">Карта сайта</a></li>
<?php // Выводим все простые
if(isset($menutitle)) { 
 foreach($menutitle as $keys=>$values) {
                  if(isset($menupart))  { 
                   if(!array_search($values,$menupart)==true) { //Статья вне разделов
                              if($keys===$id) { ?>
                              <p>
                                <i>
                                 <?php echo $values; ?>
                                </i>
                               </p> <?php
                 } 
               else
                 {
      ?><li>
           <i>
              <a href="index.php?unit=<?php echo $unit ?>&amp;id=<?php echo $keys;?>" title="<?php echo $values; ?>"><?php echo $values; ?>
              </a>
            </i> 
         </li> <?php
       }
    }
  }
  else {
                              if($keys===$id) { ?>
                              <p>
                                <i>
                                 <?php echo $values; ?>
                                </i>
                               </p> <?php
                 } 
               else
                 {
      ?><li>
           <i>
              <a href="index.php?unit=<?php echo $unit ?>&amp;id=<?php echo $keys;?>" title="<?php echo $values; ?>"><?php echo $values; ?>
              </a>
            </i> 
         </li> <?php
     }
   }
 }
}
     //Отображаем разделы
     if(isset($menupart) && count($menupart>=1))
          foreach($menupart as $key=>$value) { 
              if(isset($menutitlepart[$key]) && count($menutitlepart[$key]>=1)) {      
          ?><br>
           <details>
             <summary> 
              Раздел:<wbr>
                 <?php echo $menupart[$key]; ?>
            </summary><?php
              foreach($menutitlepart[$key] as $k=>$v) { 
                              if($k===$id) { ?>
                              <p>
                                <i>
                                 <?php echo $v; ?>
                                </i>
                               </p> <?php
                 } 
               else {                             
               ?><li>
                  <a href="index.php?unit=<?php echo $unit ?>&amp;id=<?php echo $k;?>" title="<?php echo $v; ?>"><?php echo $v; ?>
                  </a>
                 </li> 
     <?php }
        } ?>
        </details>
        <br>
<?php  }
   } 


