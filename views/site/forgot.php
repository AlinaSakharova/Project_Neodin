<?php
$this->pageTitle=Yii::app()->name . ' - Сброс пароля';

?>
<?php if(Yii::app()->user->hasFlash('forgot')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('forgot'); ?>
</div>

<?php else: ?>
<section class="section-hero-form">
		<div class="container" id="page">
			<div class="row-fluid">
			<div class="form">

            <?php $form=$this->beginWidget('CActiveForm', array(
	                                        'id'=>'forgot-form',
                                              'enableClientValidation'=>true,
	                                        'clientOptions'=>array(
		                                    'validateOnSubmit'=>true,
	                                            ),
                                            )); ?>
    <h2 class="section-hero-description-volonteer">Введите адрес электронной почты, чтобы восстановить пароль</h2>
	<div class="span9">
    
           <label> Электронная почта:</label><input name="Forgot[mail]" id="ContactForm_email" type="email">
	</div>
    <div class="span3">
	
		<?php echo CHtml::submitButton('Сбросить',array('class' => 'btn-form-forgot', 'id' => 'btn-send')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
			</div>
		</div>
	</section>



<?php endif; ?>
