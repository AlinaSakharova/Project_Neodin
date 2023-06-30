<?php
/* @var $this SiteController */
/* @var $model question */
/* @var $form CActiveForm */

//var_export($type);
//exit();
$this->pageTitle=Yii::app()->name . ' - Видеоблог';
 header('Content-Type: text/html; charset=UTF-8',true);

?>

<?php if(Yii::app()->user->hasFlash('video')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('video'); ?>
</div>


<?php endif; ?>
<section class="section-hero-form">
	<div class="hero-container" id="page">
		<div class="row-fluid">
			<div class="span7 offset1">
				<div>
					<h1 class="section-form-heading">Видеоблог</h1>
					<h2 class="section-hero-description-volonteer">
                           Здесь представлены видеозаписи
                    </h2>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section-table">
  <div class="container" id="page">
    <div class="row-fluid">
      <table>
<?php

 if (!empty($all_tags)){
   foreach ($all_tags as $row){
    echo "&emsp;<a href='".Yii::app()->createUrl('video/index',array('id_tag'=>$row['id_tag']))."'>".CHtml::decode($row['tag'])."</a>";
   }
   echo "<hr>";
 }
?>
      </table>
    </div>
  </div>
</section>


<section class="section-table">
  <div class="container" id="page">
    <div class="row-fluid">
      
<?php
//var_export($title);
//exit();
//if ($type[0] == "video"){
  //  echo "ok";
  echo "<br>";
  echo '<div class="dropdown">' ;
  if (!empty($tags_name[0])){
    echo "<hr> <span class='tags_of_search'>Поиск видео по тегу: </span><span class='name_of_tag'>".CHtml::decode($tags_name[0])."</span><br><br>";
    echo "<a href='".Yii::app()->createUrl('video/index')."'>Вернуться ко всем видеозаписям</a><hr>";
  }
  
if (!empty($video)){
    foreach($video as $row){
      echo "<div class='title-video-index'>".CHtml::decode($row['title']);// echo CHTML::decode($row['about']);
      echo "</div>";
      echo "<div class='descriptionBtn'>"; ///вокруг кнопки
      echo "<button class='btnvideo js-open-modal' data-modal='".CHtml::decode(($row['id']))."'>
              Описание видео
           </button>";
      $link = Yii::app()->createUrl('video/view', array('id'=>$row['id']));
      echo "<button class='btnvideo' onclick=\"document.location.href = '$link';\">Просмотр</button>";
      echo "</div>";//вокруг кнопки
      echo "<div class='modalWindow' data-modal='".CHtml::decode(($row['id']))."'>";
      echo  "<svg class='modal__cross js-modal-close' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path d='M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z'/></svg>";
      echo "<p class='modal__title'>".CHtml::decode($row['about'])."</p>";
      echo "<div><a href='".Yii::app()->createUrl('video/view', array('id'=>$row['id']))."'>"."Смотреть видео</a></div>";
      echo "</div>";
      echo "<hr>";
    } 
   
    }
    echo "<div class='overlayWindow js-overlay-modal'></div>";
    echo'</div>'; //dropdown
?>

  </div>
      </div>
</section>
<?php
Yii::app()->clientScript->registerScript("descriptionButton", "
 /* !function(e){'function'!=typeof e.matches&&(e.matches=e.msMatchesSelector||e.mozMatchesSelector||e.webkitMatchesSelector||function(e){for(var t=this,o=(t.document||t.ownerDocument).querySelectorAll(e),n=0;o[n]&&o[n]!==t;)++n;return Boolean(o[n])}),'function'!=typeof e.closest&&(e.closest=function(e){for(var t=this;t&&1===t.nodeType;){if(t.matches(e))return t;t=t.parentNode}return null})}(window.Element.prototype);*/

 
   //document.addEventListener('DOMContentLoaded', function() {
   
   /* Записываем в переменные массив элементов-кнопок и подложку.
      Подложке зададим id, чтобы не влиять на другие элементы с классом overlay*/
   var modalButtons = document.querySelectorAll('.js-open-modal'),
       overlay      = document.querySelector('.js-overlay-modal'),
       closeButtons = document.querySelectorAll('.js-modal-close');
     

   /* Перебираем массив кнопок */
   modalButtons.forEach(function(item){

      /* Назначаем каждой кнопке обработчик клика */
      item.addEventListener('click', function(e) {
       

         /* Предотвращаем стандартное действие элемента. Так как кнопку разные
            люди могут сделать по-разному. Кто-то сделает ссылку, кто-то кнопку.
            Нужно подстраховаться. */
         e.preventDefault();

         /* При каждом клике на кнопку мы будем забирать содержимое атрибута data-modal
            и будем искать модальное окно с таким же атрибутом. */
         var modalId = this.getAttribute('data-modal'),
             modalElem = document.querySelector('.modalWindow[data-modal=\"'+ modalId + '\"]');

         /* После того как нашли нужное модальное окно, добавим классы
            подложке и окну чтобы показать их. */
         modalElem.classList.add('active');
         overlay.classList.add('active');
      }); // end click
    
   }); // end foreach


   closeButtons.forEach(function(item){

      item.addEventListener('click', function(e) {
         var parentModal = this.closest('.modalWindow');

         parentModal.classList.remove('active');
         overlay.classList.remove('active');
      });

   }); // end foreach


    document.body.addEventListener('keyup', function (e) {
        var key = e.keyCode;

        if (key == 27) {

            document.querySelector('.modalWindow.active').classList.remove('active');
            document.querySelector('.overlayWindow').classList.remove('active');
        };
    }, false);


    overlay.addEventListener('click', function() {
        document.querySelector('.modalWindow.active').classList.remove('active');
        this.classList.remove('active');
    });




//}); // end ready
console.log('Ok');

",CClientScript::POS_END);