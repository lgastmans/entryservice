<?php
		$this->widget(
			'yiiwheels.widgets.detail.WhDetailView',
			array(
				'data' => array(
					'TypeID' => $model->TypeID,
					'Number' => $model->Number,
					'IssuedDate' => $model->IssuedDate,
					'ValidTill' => $model->ValidTill,
					'StateID' => $model->State,

				),
				'attributes' => array(
					array('name' => 'TypeID'),
					array('name' => 'Number'),
					array('name' => 'IssuedDate'),
					array('name' => 'ValidTill'),
					array('name' => 'StateID'),
				),
				'htmlOptions' => array(
					'style'=>'width:450px;',
					'id' => 'indianDetailView',
				),
			)
		);
?>