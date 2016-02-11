<?php
	/*
		overdue statuses
	*/
	$model = new ApplicantMilestones;

	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'milestones-grid',
		'type' => TbHtml::GRID_TYPE_CONDENSED,
		'dataProvider'=>$model->overdueMilestones(),
		//'filter'=>$model,
		'columns'=>array(
			'Name',
			'Status',
			'Description',
			'DateStarted',
			'TimelineInterval',
		),
	)); 

?>
