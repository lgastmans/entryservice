<?php
/* @var $this ApplicantController */
/* @var $data Applicant */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Surname')); ?>:</b>
	<?php echo CHtml::encode($data->Surname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BirthPlace')); ?>:</b>
	<?php echo CHtml::encode($data->BirthPlace); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BirthDate')); ?>:</b>
	<?php echo CHtml::encode($data->BirthDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Photo')); ?>:</b>
	<?php echo CHtml::encode($data->Photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Sex')); ?>:</b>
	<?php echo CHtml::encode($data->Sex); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('MaritalStatus')); ?>:</b>
	<?php echo CHtml::encode($data->MaritalStatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ResServiceNum')); ?>:</b>
	<?php echo CHtml::encode($data->ResServiceNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Notes')); ?>:</b>
	<?php echo CHtml::encode($data->Notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NationalityID')); ?>:</b>
	<?php echo CHtml::encode($data->NationalityID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PassportID')); ?>:</b>
	<?php echo CHtml::encode($data->PassportID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VisaID')); ?>:</b>
	<?php echo CHtml::encode($data->VisaID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IndiaID')); ?>:</b>
	<?php echo CHtml::encode($data->IndiaID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Spouse')); ?>:</b>
	<?php echo CHtml::encode($data->Spouse); ?>
	<br />

	*/ ?>

</div>