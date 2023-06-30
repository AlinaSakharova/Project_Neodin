<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */
/* @var $cities City[] */
/* @var $categories Category[] */

$this->pageTitle=Yii::app()->name . ' - Форма заявки';
 header('Content-Type: text/html; charset=UTF-8',true);

	$cities = CHtml::listData($cities, 'id','name');
	$categories = CHtml::listData($categories, 'id','category_name');
?>


<section class="section-form">
	
<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="container-flash-success">
		<div class="flash-success">
			<h2 class="section-form-descript">Ваша заявка принята. Ожидайте ответ по электронной почте или телефону.</h2>
			<div class="text-flash">	
				<?php echo Yii::app()->user->getFlash('success'); ?>
			</div>
				<br>
				<a class="btn-flash openbtnModal" href="#btnmodal">Экстренная помощь</a>
		</div>
	</div>

<?php else: ?>
	<section class="section-hero-form">
	<div class="hero-container" id="page">
		<div class="row-fluid">
			<div class="span7 offset1">
				<div>
					<h1 class="section-form-heading">Форма заявки</h11>
					<h2 class="section-hero-description">
                            Здесь вы можете заполнить заявку и получить профессиональную поддержку
                    </h2>
					<a class="btncontact" href="#form">Получить помощь</a>
					<a class="btncontactextr openbtnModal" href="#btnmodal">Экстренная помощь</a>
				</div>
			</div>
			<div class="span4">
				<div class="image-form-contact">
					<img src="images/psihology.svg" alt="Изображение главной страницы" class="img-image">
				</div>	
			</div>
		</div>
	</div>
	</section>
	<section class="section-how">
		<div class="container-how">
		<h2 class="heading-how">Выберите действие</h2>
			<div class="textcols">
				<div class="textcols-item">
					<p class="head-of-cols">Подать заявку</p>
					<p class="description-of-cols">
					Выберите <a href="#form" style="color: #72C6DD;">"Подать заявку"</a> для решения текущих проблем, для обсуждения волнующей ситуации.
					<br>
					Психолог свяжется с вами в ближайшее время.
					</p>
				</div>
			
				<div class="textcols-item">
					<p class="head-of-cols">Экстренная помощь</p>
					<p class="description-of-cols">
					Выберите <a  href="#btnmodal" style="color: #E4975F;">"Экстренная помощь"</a>, если вы чувствуете угрозу вышей жизни или жизни другому человеку.
					<br>
					Позвоните по одному из телефонов горячей линии. 
					</p>
				</div>
		</div>
		</div>
	</section>

	<div class="container-form">
	<?php $form=$this->beginWidget('CActiveForm',array(
		'id'=>'request-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
		<div class="about-form">
			<h2 class="section-form-head">Форма заявки</h2>
		</div>
	<h2 class="section-form-descript" id="form">Заполните форму ниже для получения помощи</h2>
	<div class="about-required">
	<p class="note">Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</p>
	</div>
	<!--?php echo $form->errorSummary($model); ?-->
	<div class="container">
		<div class="form" >
			
			<div class="row">
			
				<div class="span2">
					<?php echo $form->labelEx($model,'name'); ?>
		
				</div>
					<?php echo $form->textField($model,'name'); ?>
				<div class="span5 ">
						<?php echo $form->error($model,'name'); ?>
				</div>
			</div>

			<div class="row">
				<div class="span2">
					<?php echo $form->labelEx($model,'old'); ?>
				</div>
					<?php echo $form->textField($model,'old'); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'old'); ?>
				</div>
			</div>
	
			<div class="row">
				<div class="span2">
					<?php echo $form->labelEx($model,'email'); ?>
				</div>
					<?php echo $form->emailField($model,'email'); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'email'); ?>
				</div>
			</div>
	
			<div class="row">
				<div class="span2">
					<?php echo $form->labelEx($model,'phone'); ?>
				</div>
					<?php echo $form->textField($model,'phone'); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'phone'); ?>
				</div>
			</div>

			<div class="row">
				<div class="span2">
					<?php echo $form->labelEx($model,'id_city'); ?>
				</div>
					<?php echo $form->dropDownList($model,'id_city',$cities, array('prompt'=> 'Выберите район или округ')); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'id_city'); ?>
				</div>
			</div>
	
			<div class="row">
				<div class="span2">
					<?php echo $form->labelEx($model,'id_category'); ?>
				</div>
					<?php echo $form->dropDownList($model,'id_category', $categories, array('prompt'=> 'Выберите категорию')); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'id_category'); ?>
				</div>
			</div>
	
	
			<div class="row">
				<div class="span2">
					<?php echo $form->labelEx($model,'info'); ?>
				</div>
					<?php echo $form->textArea($model,'info',array('rows'=>6, 'cols'=>50)); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'info'); ?>
				</div>
			</div>

<?php if(CCaptcha::checkRequirements()): ?>

			<div class="row">
					<?php echo $form->textField($model,'verifyCode'); ?>
				<div class="span2">
					<?php echo $form->labelEx($model,'verifyCode'); ?>
				</div>
				<div class="span9">
				<div class="captcha">
					<?php $this->widget('CCaptcha', array(
					     'buttonLabel' => 'Другой код'
					)); ?>
				</div>
				</div>
				<div class="span5">
				<div class="hint">
					Пожалуйста, введите буквы, которые вы видите на изображении.
				</div>
				</div>
				<div class="span5 ">
					<?php echo $form->error($model,'verifyCode'); ?>
				</div>
			</div>
	<?php endif; ?>

			<div class="row">
				<div class="span12">
					<?php echo CHtml::submitButton('Отправить форму', array('class' => 'btn-form', 'id' => 'btn-send')); ?>
				</div>
			</div>
		</div>
	<? $this->endWidget()?>
	</div><!-- form -->
</div>
	<?php endif; ?>
</section>