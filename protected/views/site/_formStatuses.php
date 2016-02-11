<?php
	/*
		overdue statuses
	*/
	$model = new ApplicantStatus;

	$groupGridColumns = array(
		
		array(
			'name'=>'Name',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data["Name"]), array("applicant/update","id"=>$data["ID"]))',
		),
		'Status',
		'CompletionDate',
		'DaysOverdue',
	);

	$groupGridColumns[] = array(
		'name' => 'firstLetter',
		'value' => 'substr($data["Name"], 0, 1)',
		'headerHtmlOptions' => array('style' => 'display:none'),
		'htmlOptions' => array('style' => 'display:none')
	);

	$this->widget('yiiwheels.widgets.grid.WhGroupGridView',array(
		'id'=>'status-grid',
		'type' => TbHtml::GRID_TYPE_CONDENSED,
		'dataProvider'=>$model->overdueStatuses(),
		//'filter'=>$model,
		//'template' => "{items}",
		'extraRowColumns' => array('firstLetter'),
		'extraRowExpression' =>	'"<b style=\"font-size: 2em; color: #565656;\">".substr($data["Name"],0,1)."</b>"', //'"<b style="font-size: 3em; color: #333;">".substr($data["Name"], 0, 1)."</b>"',
		'extraRowHtmlOptions' => array('style' => 'padding:10px'),		
		
		'columns'=>$groupGridColumns,
	)); 

?>
