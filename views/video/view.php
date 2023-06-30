<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */
/* @var $cities City[] */
/* @var $categories CategoryReq[] */

$this->pageTitle=Yii::app()->name . ' - Просмотр видео';
 header('Content-Type: text/html; charset=UTF-8',true);
?>
<section class="container">
    <div class="row-fluid">
        <div class="view">
<?php
   
   
   // echo "<br>";   
   //echo "<td>".CHTML::encode($row->id_author)."</td>";  

   echo "<section class='title'>".CHtml::decode($material['title'])."</section>";
   echo "<div class='video'>".CHtml::decode($material['site'])."</div>";
   echo "<div class='description'>".CHtml::decode($material['about'])."</div>";
   echo "<div class='row-fluid'>";
   echo "<div class='span6'>";
   echo "<div class='name-author'>";
   echo "<p class='lastName'>Автор:"."&emsp;".CHtml::decode($material['lastName'])."&ensp;".CHtml::decode($material['firstName'])."&ensp;".CHtml::decode($material['middleName']);

   echo"</div>";
   echo"</div>";

   echo "<div class='span6'>";
   echo "<div class='date'>";
   echo "<p class='lastName'>Дата публикации:"."&emsp;".CHtml::decode($material['date']);
   echo"</div>";
   echo"</div>";
   echo"</div>";
   foreach($tags as $row){
        echo "&emsp;<a href='".Yii::app()->createUrl('video/index',array('id_tag'=>$row['id_tag']))."'>".CHtml::decode($row['tag'])."</a>";
       
   }
   echo '<p><input type="button" onclick="history.back();" class="btnback" value="Назад"/></p>';
   //var_dump($tags);
  // exit();
   
?>
        </div>
    <div>
</section>
