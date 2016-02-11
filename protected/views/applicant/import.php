<?php
/* @var $this ApplicantController */
/* @var $model Applicant */
/* @var $form CActiveForm */
?>

	<h1>Import Applicants</h1>

    <br>
    <br>

	<?php 
	    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	    	'id'=>'applicant-import-form',
	        'htmlOptions' => array('enctype' => 'multipart/form-data'),
	    ));
   	?>

   		<?php 
			$this->widget('bootstrap.widgets.TbAlert');

   			if (! empty($result)) {

	    		    if (isset($result['errors'])) print_r($result['errors']);

			    if ((isset($result['skipped'])) && (count($result['skipped']>0))) {
			    	$skipped = '';
			    	foreach ($result['skipped'] as $row)
			    		$skipped .= $row."<br>";

			    	Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_WARNING,
			    		'<strong>The following applicants already exist in the database and were not imported:</strong><br>'.$skipped);
			    }

			    //$this->widget('bootstrap.widgets.TbAlert');
			    Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,
					'<strong>Import complete</strong><br>'.$result['result']);

   				print_r($result);
   			}
   		?>

		<?php echo $form->fileFieldControlGroup($model, 'fileField'); ?>

        <?php echo TbHtml::submitButton('Import', array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>

	<?php $this->endWidget(); ?>

    <br>
    <br>
    
