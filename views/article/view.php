<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */
/* @var $cities City[] */
/* @var $categories CategoryReq[] */

$this->pageTitle=Yii::app()->name . ' - Просмотр статьи';
 header('Content-Type: text/html; charset=UTF-8',true);


//$content = CHtml::listData($content, 'content');
//$categories = CHtml::listData($categories, 'id','category_name');
?>
<section class="container">
    <div class="row-fluid">
        <div class="view">
<?php
   
   
   // echo "<br>";   
   //echo "<td>".CHTML::encode($row->id_author)."</td>";  

   echo "<section class='title'>".CHtml::decode($article['title'])."</section>";

   echo "<section class='content'>".CHtml::decode($article['content'])."</section>";
   echo "<div class='row-fluid'>";
   echo "<div class='span6'>";
   echo "<div class='name-author'>";
   echo "<p class='lastName'>Автор:"."&emsp;".CHtml::decode($article['lastName'])."&ensp;".CHtml::decode($article['firstName'])."&ensp;".CHtml::decode($article['middleName']);

   echo"</div>";
   echo"</div>";
   echo "<div class='span6'>";
   echo "<div class='date'>";
   echo "<p>Дата публикации:"."&emsp;".CHtml::decode($article['dates_temp']);
   echo"</div>";
   echo"</div>";
   echo"</div>";
   echo "<div class='tags'>";
   foreach($tags as $row){
    echo "&emsp;<a href='".Yii::app()->createUrl('article/index',array('id_tag'=>$row['id_tag']))."'>".CHtml::decode($row['tag'])."</a>";
   
}
   echo '<p><input type="button" onclick="history.back();" class="btnback" value="Назад"/></p>';
   echo"</div>";
   //var_dump($tags);
  // exit();
  
?>
        </div>
    <div>
</section>
