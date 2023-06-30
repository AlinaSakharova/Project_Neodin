<?php
/* @var $this SiteController */
/* @var $model question */
/* @var $form CActiveForm */


$this->pageTitle=Yii::app()->name . ' - Организации';
 header('Content-Type: text/html; charset=UTF-8',true);

?>

<?php if(Yii::app()->user->hasFlash('organization')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('organization'); ?>
</div>


<?php endif; ?>
<section class="section-hero-form">
	<div class="hero-container" id="page">
		<div class="row-fluid">
			<div class="span7 offset1">
				<div>
					<h1 class="section-form-heading">Организации</h1>
					<h2 class="section-hero-description-volonteer">
                           Список организаций, сообществ, НКО, оказывающих психологическую и юридическую помощь
                    </h2>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="organization-section">
    <div class="container">
        <div class="tab">
            <button class="tablinks active" onclick="openCity(event, 'psy')">Психологическая помощь</button>
            <button class="tablinks" onclick="openCity(event, 'leg')">Юридическая помощь</button>
        </div>
        <div id="psy" class="tabcontent" style="display:block;">
            <table cellpadding="5" width="100%">
            <?php 
            //var_export($psy_org);
            //exit();
                foreach ($psy_org as $row): ?>
                <tr>
                    <td class="name-of-organization">
                    <?php echo CHtml::decode($row['name']) ?>
                     </td>
                 </tr>
                 <?php if ($row['info']): ?> 
                 <tr>
                    <td class="table-organization">
                    <?php echo CHtml::decode($row['info']) ?>
                     </td>
                 </tr>
                 <?php endif; ?>
                 <?php if ($row['address']): ?> 
                <tr>
                    <td class="table-organization">
                    <?php echo CHtml::decode($row['address'])?>
                    </td>
                </tr>
                <?php endif; ?>
                
                <?php if ($row['phone']): ?> 
                <tr>
                    <td class="table-organization">
                    <?php echo CHtml::decode($row['phone'])?>
                    </td>
                </tr>
                <?php endif; ?>
                
                <?php if ($row['mail']): ?> 
                <tr>
                    <td class="table-organization">
                    <?php echo CHtml::decode($row['mail'])?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if ($row['site']): ?> 
                <tr>
                    <td class="table-organization">
                    <?php echo CHtml::decode($row['site'])?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach;
             ?>
             </table>
        </div>
        <div id="leg" class="tabcontent">
            <table cellpadding="5" width="100%">
        <?php 
                foreach ($leg_org as $row): ?>
                <tr>
                    <td class="name-of-organization">
                    <?php echo CHtml::decode($row['name']) ?>
                     </td>
                 </tr>
                 <?php if ($row['info']): ?> 
                 <tr>
                    <td class="table-organization">
                    <?php echo CHtml::decode($row['info']) ?>
                     </td>
                 </tr>
                 <?php endif; ?>
                 <?php if ($row['address']): ?> 
                <tr>
                    <td class="table-organization">
                    <?php echo CHtml::decode($row['address'])?>
                    </td>
                </tr>
                <?php endif; ?>
                
                <?php if ($row['phone']): ?> 
                <tr>
                    <td class="table-organization">
                    <?php echo CHtml::decode($row['phone'])?>
                    </td>
                </tr>
                <?php endif; ?>
                
                <?php if ($row['mail']): ?> 
                <tr>
                    <td class="table-organization">
                    <?php echo CHtml::decode($row['mail'])?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if ($row['site']): ?> 
                <tr>
                    <td class="table-organization">
                    <?php echo CHtml::decode($row['site'])?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach;
             ?>
             </table>
        </div>
    </div>
</section>
<?php
Yii::app()->clientScript->registerScript("openCity", "
        function openCity(evt, cityName) {
            // Declare all variables
            //var i, tabcontent, tablinks;
        
            // Get all elements with class='tabcontent' and hide them
            tabcontent = document.getElementsByClassName ('tabcontent');
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = 'none';
            }
        
            // Get all elements with class='tablinks' and remove the class 'active'
            tablinks = document.getElementsByClassName('tablinks');
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(' active', '');
            }
        
            // Show the current tab, and add an 'active' class to the button that opened the tab
            document.getElementById(cityName).style.display = 'block';
            evt.currentTarget.className += ' active';
        
        }
",CClientScript::POS_BEGIN);
?>