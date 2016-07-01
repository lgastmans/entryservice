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



Yii::app()->clientScript->registerScript('getData', "
	function getPostData() {
		var arr = [];

		//arr.push($('#filter').val());
		arr.push($('#applicantStatus').val());
		arr.push($('#searchDate').val());
		arr.push($('#dateFrom').val());
		arr.push($('#dateTo').val());
		//arr.push($('#milestoneStatus').val());

		/*
		var milestones = [];
		$('[id^=\"milestone_\"]').each(function(index, element){
			if ($(element).attr('checked')) {
				milestones.push(index);
			}
		});
		arr.push(milestones);
		*/

		console.log(arr);
		return JSON.stringify(arr);
	};
");

?>

<div>
	<div style="float: left; width:300px; padding:0px;">

			<div class="control-group ">
	            <label class="control-label" for="dateFrom">Status</label>
	            <div class="controls">
					<?php

						$val = '';
						if (isset(Yii::app()->session['lists_applicantStatus']))
							$val = Yii::app()->session['lists_applicantStatus'];
						echo TbHtml::dropDownList('applicantStatus', $val, $statuses);
						echo "<br>";

						$val = '';
						if (isset(Yii::app()->session['lists_dateFrom']))
							$val = Yii::app()->session['lists_dateFrom'];
					?>
				</div>
			</div>

			<div class="control-group ">
	            <label class="control-label" for="dateFrom">Date</label>
	            <div class="controls">
					<?php

						$val = '';
						if (isset(Yii::app()->session['lists_searchDate']))
							$val = Yii::app()->session['lists_searchDate'];
						echo TbHtml::dropDownList('searchDate', $val, array('StartedOn'=>'Started On', 'CompletedOn'=>'Completed On'));
						echo "<br>";

					?>
				</div>
			</div>

            <div class="control-group ">
                <label class="control-label" for="dateFrom">From</label>
                <div class="controls">
					<?php			
						$val = '';
						if (isset(Yii::app()->session['lists_dateFrom']))
							$val = Yii::app()->session['lists_dateFrom'];

						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						  //'model'=> $model,
						  //'attribute'=>'IssuedDate',
						  'name'=>'dateFrom',    
						  'value'=>$val,
						  'options'=>array(
						      'showButtonPanel'=>true,
						      'yearRange'=>'-50:+50',
						      'changeMonth'=>true,
						      'changeYear'=>true,
						      'dateFormat'=>'dd-mm-yy',
						      'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
						  ),
						  'htmlOptions'=>array(
						      'style'=>''
						  ),
						));
		            ?>
		        </div>
		    </div>

            <div class="control-group ">
                <label class="control-label" for="dateTo">To</label>
                <div class="controls">
					<?php			
						$val = '';
						if (isset(Yii::app()->session['lists_dateTo']))
							$val = Yii::app()->session['lists_dateTo'];

						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						  //'model'=> $model,
						  //'attribute'=>'IssuedDate',
						  'name'=>'dateTo',    
						  'value'=>$val,
						  'options'=>array(
						      'showButtonPanel'=>true,
						      'yearRange'=>'-50:+50',
						      'changeMonth'=>true,
						      'changeYear'=>true,
						      'dateFormat'=>'dd-mm-yy',
						      'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
						  ),
						  'htmlOptions'=>array(
						      'style'=>''
						  ),
						));
		            ?>
		        </div>
		    </div>

		    <?php
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
