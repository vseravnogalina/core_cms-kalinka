/*Button CLOSE*/
jQuery(function ButtonClose() {
jQuery('a.close').click(function () {
    jQuery(this).parent().fadeOut(700);
    jQuery('#mask').remove('#mask');
    return false;
  });
});


jQuery(function linkOpen() {
jQuery('a.openDialog').click(function () {
    jQuery(this).next().fadeIn(700);
    return false;
  });
});

jQuery(function ButtonOpen() {
jQuery('.secondbutton').click(function () {
    jQuery(this).next().fadeIn(700);
    return false;
  });
});

jQuery(function ButtonOpen() {
jQuery('.show').click(function () {
    jQuery(this).next().fadeIn(700);
    return false;
  });
});
/*Uvelichenie izobragenia*/
jQuery(document).ready(function MaxImage(e) {
  jQuery('div#content img').click(function(event){
event.StopPropagation;   
var indElem=jQuery(this);
var mestoIz=jQuery(this).attr("src");
jQuery('body').append('<div id="mask"></div>'+'<div class="wind"><a class="close">Закрыть</a><img src="'+mestoIz+'"></div>');
    jQuery('#mask').fadeIn(600).css({
      'filter': 'alpha(opacity=90)'
    });
jQuery('a.close').click(function(){
jQuery('.wind').remove('.wind');
jQuery('#mask').remove('#mask');
});
return false;
  });
});
/*Button vverh-vniz*/
jQuery(function OnDown(event){
    event.StopPropagation;
if (jQuery(window).scrollTop()>="250") jQuery("#OnTop").fadeIn("slow");
jQuery(window).scroll(function(){
if (jQuery(window).scrollTop()<="250") jQuery("#OnTop").fadeOut("slow");
else jQuery("#OnTop").fadeIn("slow");
 });
if (jQuery(window).scrollTop()<=jQuery(document).height()-"999") jQuery("#OnBottom").fadeIn("slow");
jQuery(window).scroll(function(){
if (jQuery(window).scrollTop()>=jQuery(document).height()-"999") jQuery("#OnBottom").fadeOut("slow");
else jQuery("#OnBottom").fadeIn("slow");
 });
jQuery("#OnTop").click(function(){jQuery("html,body").animate({scrollTop:0},"slow");});
jQuery("#OnBottom").click(function(){jQuery("html,body").animate({scrollTop:jQuery(document).height()},"slow");});
}); 
