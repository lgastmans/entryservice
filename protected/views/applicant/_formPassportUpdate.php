<?php
		$this->widget(
			'yiiwheels.widgets.detail.WhDetailView',
			array(
				'data' => array(
					'PassportNumber' => $model->PassportNumber,
					'IssuedDate' => $model->IssuedDate,
					'ValidTill' => $model->ValidTill,
					'IssuedBy' => $model->IssuedBy,
				),
				'attributes' => array(
					array('name' => 'PassportNumber'),
					array('name' => 'IssuedDate'),
					array('name' => 'ValidTill'),
					array('name' => 'IssuedBy'),
				),
				'htmlOptions' => array(
					'style'=>'width:450px;',
					'id' => 'passportDetailView',
				),
			)
		);
?>