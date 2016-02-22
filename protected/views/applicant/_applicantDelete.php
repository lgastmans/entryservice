<?php 
Yii::app()->clientScript->registerScript('delApplicantjsFuncs', "
	$('#delApplicant').click(function() {
		if (confirm('Are you sure?')) {
			$.ajax({
				type: 'POST',
				url: '".Yii::app()->createUrl('applicant/delete', array('id'=>$model->ID))."',
				data: { id: ".$model->ID." }
			})
			.done(function( msg ) {
				var url = '".Yii::app()->createUrl('applicant/admin')."';
				window.location = url;
			});
		}
	})
");

	//print_r($model);
?>

<h4><p>Note: All data related to the applicant will be deleted.</p><p>This action cannot be undone.</p></h4>
<br/>

<?php
	echo TbHtml::button('Delete this applicant',
		array(
			'id' => 'delApplicant',
			'color' => TbHtml::BUTTON_COLOR_DANGER, 
			'size' => TbHtml::BUTTON_SIZE_LARGE
		)
	);

?>