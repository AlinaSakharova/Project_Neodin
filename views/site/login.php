<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Личный кабинет специалиста';
?>
<section class="section-hero-form">
	<div class="hero-container" id="page">
		<div class="row-fluid">
			<div class="span7 offset1">
				<div>
					<h1 class="section-form-heading">Личный кабинет</h11>
					<h2 class="section-hero-description-volonteer">
					Личный кабинет предназначен для работников сервиса
                    </h2>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="container-form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
	<div class="about-required">
		<p class="note"> Поля, отмеченные <span class="required">*</span>, обязательны для заполнения.</p>
	</div>
	<div class="container">	
		<div class="form">
			<div class="row">
				<div class="row">
					<div class="span2 offset3">
						<?php echo $form->labelEx($model,'username'); ?>
					</div>
					<div class="span2">
						<?php echo $form->textField($model,'username', array('style'=>'width:350px; float:left;')); ?>
					</div>
					<div class="span5">
						<?php echo $form->error($model,'username',array('style'=>'margin-left: -200px; margin-top:45px;')); ?>
					</div>
				</div>

				<div class="row">
					<div class="span2 offset3">
						<?php echo $form->labelEx($model,'password'); ?>
					</div>
					<div class="span2">
						<?php echo $form->passwordField($model,'password', array('style'=>'width:350px; float:left;')); ?>
						</div>
						<div class="span5 ">
						<?php echo $form->error($model,'password',array('style'=>'margin-left: -200px; margin-top:45px;')); ?>
					</div>
					<p class="hint">
				<!--	//	Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.-->
					</p>
				</div>
                <div class="row forgot-password">
					<div class="offset5 span7">
					<?php
				       echo "<a class='forgot-password' href='".Yii::app()->createUrl('site/forgot')."'>Забыли пароль?</a>";
					?>
					</div>
				</div>
				<div class="row rememberMe">
				<div class="span2 offset3">
						<?php echo $form->label($model,'rememberMe', array('style'=>'
						margin-top: 7px;
						font-weight: bold;
						font-size: 0.9em;
						margin-left:2px;
						color: #94AAAF;
						margin-left: 0px;
						text-align: left;')); ?>
					</div>
				<div class="span2">
					<div id="rememberme">
						<?php echo $form->checkBox($model,'rememberMe', array('style'=>'	
						display: inline;
						margin-top: 7px;
						width: 20px;
    					height: 20px;
						margin-left: 0px;')); ?>
					</div>
				</div>
					
					<div class="span5 ">
						<?php echo $form->error($model,'rememberMe'); ?>
					</div>
				</div>

				<div class="row">
					<div class="span12">
						<?php echo CHtml::submitButton('Войти', array('class' => 'btn-form', 'id' => 'btn-send')); ?>
					</div>
				</div>

<?php $this->endWidget(); ?>
			</div><!--row-->
		</div><!--form-->
	</div><!--container-->
</div><!-- container-form -->
