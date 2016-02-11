<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$today = new DateTime();
?>

<h3><?php echo $today->format('d M Y');?></h3>

<br><br>

<?php
	if(!Yii::app()->user->isGuest) {

		$this->widget('yiiwheels.widgets.box.WhBox', array(
		    'title' => 'Overdue statuses',
		    'headerIcon' => TbHtml::ICON_EXCLAMATION_SIGN,
		    'content' => $this->renderPartial("_formStatuses", array(), true),
		    'htmlOptions' => array('style'=>'width:700px; padding-left:100px;'),
		));
		
		$this->widget('yiiwheels.widgets.box.WhBox', array(
		    'title' => 'Overdue milestones with Date Started not blank',
		    'headerIcon' => TbHtml::ICON_EXCLAMATION_SIGN,
		    'content' => $this->renderPartial("_formMilestones", array(), true),
		    'htmlOptions' => array('style'=>'width:700px; padding-left:100px;'),
		));

		/*
		$this->widget('yiiwheels.widgets.box.WhBox', array(
		    'title' => 'Reminders',
		    'headerIcon' => TbHtml::ICON_EXCLAMATION_SIGN,
		    'content' => $this->renderPartial("_formReminders", array(), true),
		    'htmlOptions' => array('style'=>'width:700px; padding-left:100px;'),
		));
		*/
	}
?>
