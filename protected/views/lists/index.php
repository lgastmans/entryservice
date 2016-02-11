<?php
/* @var $this ListsController */

$this->breadcrumbs=array(
	'Lists',
);

	/*
		Applicant Statuses
	*/
	$criteria=new CDbCriteria;
	$criteria->select='ID, Description';
	$criteria->order='Description ASC';
	$data = Status::model()->findAll($criteria);
	$statuses = array("ALL"=>"All");
	if ($data) {
		foreach ($data as $item) {
			$statuses[$item->ID] = $item->Description;
		}
	}

	/*
		Milestones
	*/
	$criteria=new CDbCriteria;
	$criteria->select='ID, Description';
	$criteria->condition='IsActive=true';
	$criteria->order='Description ASC';
	$data = Milestone::model()->findAll($criteria);
	$milestones = array();
	if ($data) {
		foreach ($data as $item) {
			$milestones[$item->ID] = $item->Description;
		}
	}


Yii::app()->clientScript->registerScript('getData', "
	function getPostData() {
		var arr = [];

		arr.push($('#filter').val());
		arr.push($('#applicantStatus').val());
		arr.push($('#dateFrom').val());
		arr.push($('#dateTo').val());
		arr.push($('#milestoneStatus').val());

		var milestones = [];
		$('[id^=\"milestone_\"]').each(function(index, element){
			if ($(element).attr('checked')) {
				milestones.push(index);
			}
		});
		arr.push(milestones);

		//console.log(arr);
		return JSON.stringify(arr);
	};
");

?>

<div>
	<div style="float: left; width:300px; padding:0px;">
		<?php
			echo TbHtml::small('Filter applicant on Name or Surname');
			echo "<br>";

			$val = '';
			if (isset(Yii::app()->session['lists_filter']))
				$val = Yii::app()->session['lists_filter'];
			echo TbHtml::textField('filter', $val, array('placeholder' => '', 'size' => TbHtml::INPUT_SIZE_DEFAULT));
			echo "<br>";

			echo TbHtml::ajaxButton(
		        'Search',
		        array('lists/processData'),
		        array(
			        'dataType'=>'json',
			        'type'=>'post',
							'url' => CController::createUrl('lists/processData'),
							'data' => 'js:{ "data": getPostData() }',
					/*
					'data' => 'js:{
						"filter": $("#filter").val(),
						"applicantStatus": $("#applicantStatus").val(),
						"dateFrom": $("#dateFrom").val(),
						"dateTo": $("#dateTo").val(),
						"milestoneStatus": $("#milestoneStatus").val(),
					}',
					*/
					'success'=>"js:function(data) {
						$('#list-grid').yiiGridView('update', {data: $(this).serialize()});
					}",
		        ),
		        array(
			        'id'=>'someID',
			        'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
			        'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		        )
		    );
			echo "<hr>";

			$val = '';
			if (isset(Yii::app()->session['lists_applicantStatus']))
				$val = Yii::app()->session['lists_applicantStatus'];
			echo TbHtml::dropDownList('applicantStatus', $val, $statuses);
			echo "<br>";

			$val = '';
			if (isset(Yii::app()->session['lists_dateFrom']))
				$val = Yii::app()->session['lists_dateFrom'];
			echo TbHtml::small('From');
			echo "<br>";
			?>
		    <div class="input-append">
			    <?php
			    	$this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
					    'name' => 'dateFrom',
					    'value' => $val,
					    'pluginOptions' => array(
					    	'format' => 'dd-mm-yyyy'
					    ),
					    'htmlOptions' => array(
					    	'id' => 'dateFrom'
					    )
				    ));
			    ?>
			    <span class="add-on"><icon class="icon-calendar"></icon></span>
		    </div>
		    <br>

		    <?php
			$val = '';
			if (isset(Yii::app()->session['lists_dateTo']))
				$val = Yii::app()->session['lists_dateTo'];
			echo TbHtml::small('To');
			echo "<br>";
			?>
		    <div class="input-append">
			    <?php
			    	$this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
					    'name' => 'dateTo',
					    'value' => $val,
					    'pluginOptions' => array(
					    	'format' => 'dd-mm-yyyy'
					    ),
					    'htmlOptions' => array(
					    	'id' => 'dateTo'
					    )
				    ));
			    ?>
			    <span class="add-on"><icon class="icon-calendar"></icon></span>
		    </div>
		    <br>

		    <?php

			echo "<hr>";

			echo TbHtml::small('Milestones');
			echo "<br>";

			echo TbHtml::dropDownList('milestoneStatus', '', array('All','Pending','Completed','Cancelled','NA','Extended'));
			echo "<br>";

			foreach ($milestones as $key=>$value) {
				echo TbHtml::checkBox($key, false, array('label' => $value, 'id'=>"milestone_".$key))."<br>";
			}
		?>

	</div>
	<div style="float: left;">
		<?php
			$dataProvider = Lists::model()->listData();

			$data = $dataProvider->getData();

			//$this->widget('yiiwheels.widgets.grid.WhGridView',array(
			$this->widget('bootstrap.widgets.TbGridView',array(
				'id'=>'list-grid',
				'type' => TbHtml::GRID_TYPE_CONDENSED,
				'dataProvider'=>$dataProvider,
				//'filter'=>$model,
				//'template' => "{items}",
				/*
				'extraRowColumns' => array('firstLetter'),
				'extraRowExpression' =>	'"<b style=\"font-size: 2em; color: #565656;\">".substr($data["Name"],0,1)."</b>"', //'"<b style="font-size: 3em; color: #333;">".substr($data["Name"], 0, 1)."</b>"',
				'extraRowHtmlOptions' => array('style' => 'padding:10px'),
				'columns'=>$groupGridColumns,
				*/
				'columns' => array(
					//'ID',
					array(
						'name'=>'Name',
						'header'=>'Name',
						'headerHtmlOptions' => array('class' => 'span2'),
						'type'=>'raw',
						'value' => 'CHtml::link(CHtml::encode($data["Name"]), array("applicant/update","id"=>$data["ID"]))',
					),
					array(
						'name'=>'Surname',
						'header'=>'Surname',
						'headerHtmlOptions' => array('class' => 'span2'),
					),
					array(
						'name'=>'ResServiceNum',
						'header'=>'RS Number',
						'headerHtmlOptions' => array('class' => 'span2'),
					),

					'Nationality',
				),
			));
		?>
	</div>
</div>

<div style="clear:both;"></div>
