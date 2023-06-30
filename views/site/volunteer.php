<?php
/* @var $this SiteController */
/* @var $model Volunteer */
/* @var $form CActiveForm */
/* @var $cities City[] */
/* @var $categories GroupVolunteer[] */

$this->pageTitle=Yii::app()->name . ' - Волонтерство';
 header('Content-Type: text/html; charset=UTF-8',true);

$cities = CHtml::listData($cities, 'id','name');
//$categories = CHtml::listData($categories, 'id','group_name', 'short_name');
//var_export($categories);
//exit();
?>

<section class="section-form">

<?php if(Yii::app()->user->hasFlash('success')): ?>
	<div class="container-flash-success">
		<div class="flash-success">	
			<h2 class="section-form-descript">Спасибо, что решили стать волонтером. Ваша помощь очень важна для нас.</h2>
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
				<div>
					<h1 class="section-form-heading">Стать волонтером</h11>
					<h2 class="section-hero-description-volonteer">
                            Данная форма предназначена для регистрации в качестве волонтера
                    </h2>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="container-form">
	<?php $form=$this->beginWidget('CActiveForm',array(
		'id'=>'volunteer-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
)); ?>
		<div class="about-form">
			<h2 class="section-form-head">Заполните форму ниже, чтобы зарегистрироваться в качестве волонтера</h2>
		</div>
		
		<div class="about-required">
			<p class="note">Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</p>
		</div>
    
	<?php echo $form->errorSummary($model); ?>
	<div class="container">
		<div class="form">
			<div class="row">
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
					<?php echo $form->labelEx($model,'phone'); ?>
				</div>
					<?php echo $form->textField($model,'phone'); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'phone'); ?>
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
					<?php echo $form->labelEx($model,'id_city'); ?>
				</div>
					<?php echo $form->dropDownList($model,'id_city',$cities, array('prompt'=> 'Выберите район или округ')); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'id_city'); ?>
				</div>
			</div>
			<div class="row">
				<div class="span2">
					<?php echo $form->labelEx($model,'utility'); ?>
				</div>
					<?php echo $form->textField($model,'utility'); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'utility'); ?>
				</div>
			</div>
			<div class="row">
				<div class="span2">
					<?php echo $form->labelEx($model,'isActive'); ?>
				</div>
				<div  id="activity">
					<?php echo $form->radioButtonList($model,'isActive',  
						array(1 => 'Да', 
							  0 => 'Нет'),
						array('separator' => " " )); ?>
				</div>
				<div class="span5 ">
					<?php echo $form->error($model,'isActive'); ?>
				</div>
			</div>
		
<div class="row">
	<div class="span2">
		<label>Выберите категории:</label>
	</div>
	
	</div>
	
	<div id="checkgroup">	
	<?php
	foreach ($categories as $row){	
	  echo "<div class='row'>";    	
	  echo "<div class='offset1 span4'>"; 
			echo "<label class='labelcheckbox' for = '".$row['short_name']."'>".$row['group_name']."</label>"; 
		echo "</div>";             
		echo "<div class='span7'>"; 
			echo "<input type='checkbox' style='max-width:20px; margin:0;' class='cat_volunteer checkbox2' id='Volunteer_id_group_".$row['id']."' name='".$row['short_name']."'>";
		echo "</div>";
	
	  echo "</div>";
	}
		/*<div class="row">
			<div class="span2">
				<?php echo $form->labelEx($model,'other'); ?>
			</div>
			<div class="span2">
			<?php echo $form->checkBox(
					$model,
					'other',
					array('class'=>'cat_volunteer',
							'id' => 'Volunteer_id_group_6',
							'style'=>'display: inline;
								margin-top: 7px;
								width: 20px;
								height: 20px;
								margin-left: 0px;'
					)
				); ?>
			</div>
			<div class="span5">
				<?php echo $form->error($model,'other'); ?>
			</div>
			
		</div>
	*/
?>
	
	</div>


<div class="row" id="field-other" style="display:none">
	<div class="span2">
		<?php echo $form->labelEx($model,'other'); ?>
	</div>
	
	<?php echo $form->textField($model,'other', array('id'=>'Volunteer_other')); ?>
	<div class="span5">
		<?php echo $form->error($model,'other'); ?>
	</div>
</div>
			
			<div class="row">
				<div class="span2">
					<?php echo $form->labelEx($model,'site'); ?>
				</div>
					<?php echo $form->textField($model,'site'); ?>
				<div class="span5 ">
					<?php echo $form->error($model,'site'); ?>
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
		<?php echo CHtml::submitButton('Стать волонтером', array('class' => 'btn-form-volunteer', 'id' => 'btn-send')); ?>
	</div>
	</div>
			</div> <!--row-->
<? $this->endWidget()?>
		</div><!-- form -->
	</div><!--container-->
</div><!--container-form-->
<?php endif; ?>
</section>

<?php
$str = "Volunteer_id_group_".strval(count($categories)); //id последнего элемента
//$str = "Volunteer_id_group_6";
Yii::app()->clientScript->registerScript("disabledLastEl", "
   
   $('#$str').attr('disabled', 'disabled');
   $('#$str').attr('readonly', 'readonly');

");

Yii::app()->clientScript->registerScript("volunteer", "$('.cat_volunteer').click(function(e)
 {
	e = e || window.event;
  	var src = e.target || e.srcElement;
	//alert('OK'+ src.checked + ' ' + '$str');
	var lastEl = document.getElementById('$str');
	
	var flag = false;
	$('.cat_volunteer').each(function() {
		//alert('checked='+ this.checked);
  		if (this.checked == true && this.id != lastEl.id) {
  			flag = true;
		};
	});
	//alert('flag'+flag);
	
	//if (src.id != lastEl.id){
		if(flag == true){
			$('#$str').removeAttr('disabled');
			$('#$str').removeAttr('readonly');
		}
		else
		{
			$('#$str').prop('checked', false);
			$('#$str').attr('disabled', 'disabled');
   			$('#$str').attr('readonly', 'readonly');
		}
//	}
	var fld_otr = document.getElementById('field-other');
	var volunteer_oth = document.getElementById('Volunteer_other');
	if(lastEl.checked == true){
		fld_otr.style.removeProperty('display');
		volunteer_oth.disabled = false;
		volunteer_oth.readonly = false;
	}
	else{
		fld_otr.style.display = 'none';
		volunteer_oth.disabled = true;
		volunteer_oth.readonly = true;
	}
	
 })
");
?>

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