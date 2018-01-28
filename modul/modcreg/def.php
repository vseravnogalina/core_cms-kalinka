<?php if (!defined('BUGIT')) exit ('Ошибка соединения');
/**@package KALINKA @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2016 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 0.9.2
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
?>
<!--noindex-->
<META HTTP-EQUIV="Cache-control" CONTENT="NO-CACHE, must-revalidate">
<?php
$time=date(":d:m:y");
$timetek=date("H:d:m:y");
if(isset($unit)) if($unit==='shop') {
  if(preg_match("/^(2)+([2-4]{1})+($time)$/i",$timetek)) {
    die("Мы закрыты на технический перерыв. Приносим извинения за причиненные неудобства.");
}
if(file_exists("basket/shopbasket")) {
  if(file_exists("shop/yes.txt") && !isset($shet)) {
   die("Магазин временно не работает. Приносим извинения за причиненные неудобства.");
      }
    }
  }
//if(isset($unit)) {
    if(!isset($_SESSION['nickname'])) {
?>
  <!--Форма входа-->
      <a id="linkancor" class="openDialog">Форма входа</a>
        <dialog>
          <a class="close">Закрыть</a>
          <form  method="POST">
            <fieldset>
               <legend><mark><i>Форма входа</i></mark></legend>
               <input type="hidden" name="groupcostomer" value="4"/>
            <p><input type="text" name="nickname" value="" placeholder="Ваше имя:" required /></p>
            <p><input type="email" name="eml" value="" placeholder="E-mail:" required /></p>
            <p><input type="checkbox" name="agry" value="1" checked />Я согласен(на) на обработку моих персональных данных
              <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR'] ?>" >
             <p><input type="submit" name="enter"  class="button"  value="Войти!" /></p>
           </fieldset>
         </form> 
      </dialog>
<?php
  }
//}
?><!--/noindex-->
