<?php
/* @var $this SiteController */
/* @var $model question */
/* @var $form CActiveForm */


$this->pageTitle=Yii::app()->name . ' - Статьи';
 header('Content-Type: text/html; charset=UTF-8',true);
?>

<?php if(Yii::app()->user->hasFlash('article')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('article'); ?>
</div>

<?php endif; ?>

<section class="section-hero-form">
	<div class="hero-container" id="page">
		<div class="row-fluid">
			<div class="span7 offset1">
				<div>
					<h1 class="section-form-heading-psy">Психологическая<br>помощь</h1>
					<h2 class="section-hero-description">
                           Здесь представлены способы решения различных проблем по категориям
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
//var_export($all_tags);
//exit();
 if (!empty($all_tags)){
   foreach ($all_tags as $row){
    echo "&emsp;<a href='".Yii::app()->createUrl('article/index',array('id_tag'=>$row['id_tag']))."'>".CHtml::decode($row['tag'])."</a>";
   }
   //echo "<hr>";
 }
?>
      </table>
    </div>
  </div>
</section>
<section class="section-table">
  <div class="container" id="page">
    <div class="row-fluid">
      <table>
    <?php 
    // echo '<pre>';
   //   var_dump($categories);
    //   echo '</pre>';
   // var_dump($categories_title);
   //  exit;

        echo "<br>";
  echo '<div class="dropdown">' ;
        if (!empty($tags_name[0])){
          echo "<hr> <span class='tags_of_search'>Поиск статей по тегу: </span><span class='name_of_tag'>".CHtml::decode($tags_name[0])."</span><br><br>";
          echo "<a href='".Yii::app()->createUrl('article/index')."'>Вернуться ко всем статьям</a><hr>";
        }
        //var_export($categories_title);
        //exit();
        if (!empty($categories_title)){
            foreach($categories_title as $row){
            // echo '<button class="btn"> Button </button>';
            
                echo '<div class="accordion-group">';
                  echo '<i class="fa fa-caret-down"></i>';

                  echo CHtml::decode($row['category_name']);

                echo '</div>'; //accordion group
              echo '<div class="panel">';
              if ($row['d_id'] != NULL){
                echo "<a href='".Yii::app()->createUrl('article/view', array('id'=>$row['id']))."'>".CHtml::decode($row['category_name'])."</a>";
              }
              else {
                 // echo CHtml::decode($row['category_name']);
               }
                  if (!empty($categories)){
                  foreach($categories as $article_name){
                    // var_export($row['id']);
                    // var_export($article_name['id_parent']);
                  
                    if ($row['id'] == $article_name['id_parent'])
                    {
                          echo '<div class="accordion-group">';
                          echo '<i class="fa fa-caret-down"></i>';

                              echo CHtml::decode($article_name['category_name']);

                          echo '</div>'; //accodrion-group внутренний
                          echo '<div class="panel">';
                          if ($article_name['d_id'] != NULL) {
                            echo "<a href='".Yii::app()->createUrl('article/view',array('id'=>$article_name['d_id']))."'>".CHTML::decode($article_name['category_name'])."</a>";
                        }
                        else {
                           // echo CHtml::decode($article_name['category_name']);
                        }
                        echo "<ul>";
                          echo "</ul>";
                          echo '</div>'; //panel
                    }
                  
                  }
                }   
                   //echo '</div>';
              echo '</div>'; //panel
                
            }; 
      }
  echo'</div>'; //dropdown
    ?>
        
  </table>
  </div>
      </div>
</section>
<?php
Yii::app()->clientScript->registerScript("accordion-group", "
  var acc = document.getElementsByClassName('accordion-group');
  var i;
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener('click', function() {
        /* Toggle between adding and removing the 'active' class,
        to highlight the button that controls the panel */
        this.classList.toggle('active');
        
        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === 'block') {
            panel.style.display = 'none';
        } else {
            panel.style.display = 'block';
        }
    });
    
}
");
?>
<?php
Yii::app()->clientScript->registerScript("accordion", "
  var acc = document.getElementsByClassName('accordion');
  var i;
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener('click', function() {
        /* Toggle between adding and removing the 'active' class,
        to highlight the button that controls the panel */
        this.classList.toggle('active');
        
        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === 'block') {
            panel.style.display = 'none';
        } else {
            panel.style.display = 'block';
        }
    });
    
}
");
?>
