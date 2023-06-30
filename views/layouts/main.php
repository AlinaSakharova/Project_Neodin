<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="ru">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"-->
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<?php Yii::app()->bootstrap->register(); ?>
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/article.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/organization.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/contact.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/book.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/video.css">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<header class="header">
	<div class="header-container">
		<div class="row-fluid">
			<div class="header__inner">
				<div class="span1">
					<a href="/index.php" class="logo">
							<img src="images/logo.svg" alt="" class="logo-img">
					</a>
				</div>
				<div class="span8 offset1" >
					<div class="mainmenu" id="myTopnav">
						<?php $this->widget('zii.widgets.CMenu', array(
							'encodeLabel'=>false,
							'hideEmptyItems'=>false,
							'items'=>array(
								array('label'=>'<span id="icon"><i class="fa fa-bars">&nbsp;</i></span>', 'url'=>'#'),
								array('label'=>'Форма заявки',   'url'=>array('/site/contact')),
								//array('label'=>'О проекте',      'url'=>array('/site/page', 'view'=>'about')),
								array('label'=>'Организации', 'url' => array('/organization/organization')),
								array('label'=>'Волонтерство',   'url'=>array('/site/volunteer')),
								array('label'=>'Психологическая помощь',   'url'=>array('/article/index')),
								array('label'=>'Видеоблог',   'url'=>array('/video/index')),
								array('label'=>'Книжная полка',   'url'=>array('/book/index')),
								/*array('label'=>'Личный кабинет', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),*/
							/*	array('label'=>'Регистрация', 'url'=>array('/users/registration','visible'=>Yii::app()->user->isGuest)),*/
							    array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),

							),
						)); ?>
					</div>
				</div>
				
				<div class="span2">
					<a href="#btnmodal" class="button openbtnModal">
							Позвонить
					</a>
				</div>
			</div>
		</div>	
	</div>
</header>

<?php if(isset($this->breadcrumbs)):?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->
<?php endif?>
<?php echo $content; ?> 

<div class="clear"></div>

<footer class="section-footer">
	<div class="container" id="page">
		<ul class="footer_ul">
					<div class="menufooter" >
						
							
								
							
									<li><a href="<?php echo Yii::app()->createUrl('users/registration');?>">Регистрация</a></li>
								
									<li><a href="<?php echo Yii::app()->createUrl('site/login');?>">Личный кабинет</a></li>
									<li><a href="<?php echo Yii::app()->createUrl('organization/organization');?>">Организации</a></li>
								
									<li><a href="<?php echo Yii::app()->createUrl('site/page&view=about');?>">Контакты</a></li>
							
						
						
						
					</div>
		</ul>
	</div>
</footer>

<div id="btnmodal" class="btnmodal">
     <div>
    	<p class="description">
		   1. Детский телефон доверия
		</p>
	    <p class="descriptTel"><a href="tel:+83517355161">
		   8(800)-200-01-22 
		   </a>
		</p>
	    <p class="description">
		   2. Телефон доверия для взрослых 
		</p>
	    <p class="descriptTel"><a href="tel:+83517355161">
		   8(351)-735-51-61 
		   </a>
		</p>  
	   <a href="#close" title="Закрыть"></a>
    </div>        
</div>
<?php
Yii::app()->clientScript->registerScript("search", "$('#btnmodal').click(function(){
	let header = $('.header');
    let hederHeight = header.height(); // вычисляем высоту шапки
     
    $(window).scroll(function() {
      if($(this).scrollTop() > 1) {
       header.addClass('header_fixed');
       $('body').css({
          'paddingTop': hederHeight+'px' // делаем отступ у body, равный высоте шапки
       });
      } else {
       header.removeClass('header_fixed');
       $('body').css({
        'paddingTop': 0 // удаляю отступ у body, равный высоте шапки
       })
      }
      if($(this).scrollTop() > 300) {
        header.css({
          'padding': '5px 0',
          'background': '#fffff',
          'transition': '.3s'
        });
    } else {
        header.css({
          'padding': '15px 0',
          'background': '#ffffff',
          'transition': '.3s'
        });
    }
    });
});
");
?>

<?php
Yii::app()->clientScript->registerScript("navButton", "$('#icon').click(function(){
    //alert('OK');
	var x = document.getElementById('myTopnav');
    if (x.className === 'mainmenu') {
        x.className += ' responsive';
    } else {
        x.className = 'mainmenu';
    }
})
");
?>






</body>
</html>




