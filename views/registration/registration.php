<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */
/* @var $cities City[] */
/* @var $positions SpecPosition[] */

$this->pageTitle=Yii::app()->name . ' - Форма регистрации';
 header('Content-Type: text/html; charset=UTF-8',true);


$cities = CHtml::listData($cities, 'id','name');
$positions = CHtml::listData($positions, 'id','namePosition');
?>

<section class="section-form">
<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="container-flash-success">
		<div class="flash-success">
			<h2 class="section-form-descript">Ваша заявка на регистрацию принята. Чтобы проверить ваши данные, требуется время. Пожалуйста, ожидайте.</h2>
			<div class="text-flash">	
				<?php echo Yii::app()->user->getFlash('success'); ?>
			</div>
		</div>
	</div>

<?php else: ?>
	<section class="section-hero-form">
		<div class="hero-container" id="page">
			<div class="row-fluid">
				<div class="span7 offset1">
				<h1 class="section-form-heading">Форма регистрации</h11>
					<h2 class="section-hero-description">
                            Здесь вы можете заполнить форму регистрации, чтобы получить доступ к форуму и материалам
                    </h2>
				</div>
			
				<div class="span4">
					<div class="image-form-contact">
						<img src="images/psihology.svg" alt="Изображение главной страницы" class="img-image">
					</div>	
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
	<h2 class="section-form-descript" id="form">Заполните форму ниже, чтобы стать специалистом.</h2>
	<div class="about-required">
		<p class="note">Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</p>
	</div>
	<div class="container">
	<!--?php echo $form->errorSummary($model); ?-->
		<div class="form" >
			<div class="row">
				<div class="span2">
					<?php echo $form->labelEx($model,'firstName'); ?>
				</div>
					<?php echo $form->textField($model,'firstName'); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'firstName'); ?>
				</div>
			</div>

			<div class="row">
				<div class="span2">
					<?php echo $form->labelEx($model,'mail'); ?>
				</div>
					<?php echo $form->emailField($model,'mail'); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'mail'); ?>
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
					<?php echo $form->labelEx($model,'id_position'); ?>
				</div>
					<?php echo $form->dropDownList($model,'id_position', $positions, array('prompt'=> 'Выберите специализацию')); ?>
				<div class="span5 ">	
					<?php echo $form->error($model,'id_position'); ?>
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
					<?php echo $form->labelEx($model,'password'); ?>
				</div>
					<?php echo $form->passwordField($model,'password', array('id'=>'validpass')); ?>
					
				<div class="span5 ">
					<?php echo $form->error($model,'password'); ?>
				</div>
			</div>
			<div class="row">
				<div class="span2">
				<label>Подтвердите пароль</label>
				</div>
					<input  type='password' class="edinfopass" required="required" id='password2'>
				<div class="span5 ">
					
				</div>
			</div>

<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model,'verifyCode'); ?>
		</div>
			<?php echo $form->textField($model,'verifyCode'); ?>
		
		<div class="span9">
			<div class="captcha">
				<?php $this->widget('CCaptcha', array(
				     'buttonLabel' => 'Другой код'
				)); ?>
			</div>
		</div>
		<div class="span9">
			<small class="hint">
				Пожалуйста, введите буквы, которые вы видите на изображении.
			</small>
		</div>
		<div class="span5 ">
			<?php echo $form->error($model,'verifyCode'); ?>
		</div>
	</div>
	<?php endif; ?>

	<div class="row">
		<div class="span12">
		<?php echo CHtml::submitButton('Зарегистрироваться', array('class' => 'btn-form', 'id' =>'btn-send')); ?>
			</div>
		</div>
	</div>
</div>

<? $this->endWidget()?>
</div><!-- container-form -->

<?php endif; ?>
</section>
<?php
Yii::app()->clientScript->registerScript("forgot", "
    //alert('OK');
	validpass.onblur = function (input){
        if (document.getElementById('validpass').value != document.getElementById('password2').value) {
            //this.setCustomValidity('Пароли должны совпадать.');
			$('#btn-send').attr('disabled', 'disabled');
			
        } else {
            // input is valid -- reset the error message
            //input.setCustomValidity('');
			$('#btn-send').removeAttr('disabled');
        }
    }
	password2.onblur = function (input){
        if (document.getElementById('validpass').value != document.getElementById('password2').value) {
            //this.setCustomValidity('Пароли должны совпадать.');
			$('#btn-send').attr('disabled', 'disabled');
			
        } else {
            // input is valid -- reset the error message
            //input.setCustomValidity('');
			$('#btn-send').removeAttr('disabled');
        }
    }
	

");
?>