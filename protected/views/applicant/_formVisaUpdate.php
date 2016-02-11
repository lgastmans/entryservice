<?php
		$this->widget(
			'yiiwheels.widgets.detail.WhDetailView',
			array(
				'data' => array(
					'VisaType' => $model->VisaType,
					'Number' => $model->Number,
					'IssuedDate' => $model->IssuedDate,
					'ValidTill' => $model->ValidTill,
				),
				'attributes' => array(
					array('name' => 'VisaType'),
					array('name' => 'Number'),
					array('name' => 'IssuedDate'),
					array('name' => 'ValidTill'),
				),
				'htmlOptions' => array(
					'style'=>'width:450px;',
					'id' => 'passportDetailView',
				),
			)
		);
?>