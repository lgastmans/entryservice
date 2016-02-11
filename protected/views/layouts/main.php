<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<?php Yii::app()->bootstrap->register(); ?>

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
	
	<div id="tbnav">
		<?php 
			$this->widget('bootstrap.widgets.TbNavbar', array(
		    	'brandLabel' => 'Home',
		    	'display' => null, // default is static to top
		    	'items' => array(
				    array(
					    'class' => 'bootstrap.widgets.TbNav',
					    'items' => array(
					    	array(
						    	'label' => 'Applicants', 
						    	'url' => array('applicant/admin'), 
						    	'active'=>($this->id=='applicant'?true:false), 
						    	'visible'=>!Yii::app()->user->isGuest,
						    	'icon'=>TbHtml::ICON_USER,
						    	'items'=>array(
						    			array('label'=>'New','url'=>array('applicant/create')),
						    			array('label'=>'Manage','url'=>array('applicant/admin')),
						    			//array('label'=>'Search','url'=>'#'),
						    			TbHtml::menuDivider(),
						    			array('label'=>'Import','url'=>array('applicant/import')),
						    		),
						    ),
						    array(
						    	'label' => 'Lists', 
						    	'url' => array('/lists/index'), 
						    	'active'=>($this->id=='lists'?true:false), 
						    	'visible'=>!Yii::app()->user->isGuest,
						    	'icon'=>TbHtml::ICON_LIST_ALT,
						    ),
						    array(
						    	'label' => 'Statistics', 
						    	'url' => array('/statistics/index'), 
						    	'active'=>($this->id=='statistics'?true:false), 
						    	'visible'=>!Yii::app()->user->isGuest,
						    	'icon'=>TbHtml::ICON_SIGNAL,
						    ),
						    array(
						    	'label' => 'Meetings', 
						    	'url' => array('/Meeting/admin'), 
						    	'active'=>($this->id=='meeting'?true:false), 
						    	'visible'=>!Yii::app()->user->isGuest,
						    	'icon'=>TbHtml::ICON_BRIEFCASE,
						    ),
						    array(
						    	'label' => 'Settings', 
						    	'url' => '#', 
						    	'active'=>($this->id=='milestone'?true:false) || ($this->id=='milestoneCategory'?true:false) || ($this->id=='status'?true:false), 
						    	'visible'=>!Yii::app()->user->isGuest,
						    	'icon'=>TbHtml::ICON_FLAG,
						    	'items'=>array(
						    		array('label'=>'Information', 'url'=>array('information/index')),
						    		TbHtml::menuDivider(),
						    		array('label'=>'Communities','url'=>array('community/admin')),
						    		array('label'=>'Milestones','url'=>array('milestone/admin')),
						    		array('label'=>'Milestone Categories','url'=>array('milestoneCategory/admin')),
						    		array('label'=>'School','url'=>array('school/admin')),
						    		array('label'=>'Status','url'=>array('status/admin')),
						    		array('label'=>'Statistics',
						    			'url'=>'#',
						    			'items'=>array(
						    				array('label'=>'Categories','url'=>array('statisticsCategory/admin')),
						    				array('label'=>'Answers','url'=>array('statisticsAnswer/admin')),
						    			)
						    		)
					    		),
						    ),
							array(
								'label'=>'Admin', //Yii::app()->getModule('user')->t("Profile"), 
								'url'=>'#',
								'active'=>(($this->id=='member'?true:false) || ($this->id=='profile'?true:false)),
								'visible'=>!Yii::app()->user->isGuest,
								'icon'=>TbHtml::ICON_COG,
								'items'=>array(
									array('label'=>'Users','url'=>Yii::app()->getModule('user')->profileUrl),
									array('label'=>'Members','url'=>array('Member/admin')),
									array('label'=>'Settings', 'url'=>array('settings/view&id=1')),
								)
							),

					    ),
				    ),

					array(
			            'class'=>'bootstrap.widgets.TbNav',
			            'htmlOptions'=>array('class'=>'pull-right'),
			            'items'=>array(
							array(
								'url'=>Yii::app()->getModule('user')->loginUrl, 
								'label'=>Yii::app()->getModule('user')->t("Login"), 
								'visible'=>Yii::app()->user->isGuest,
								'htmlOptions'=>array('style'=>'align:right;')
							),
							array(
								'url'=>Yii::app()->getModule('user')->logoutUrl, 
								'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 
								'visible'=>!Yii::app()->user->isGuest
							),						
			            ),
			        ),				

			    ),
		    ));
		?>
	</div>

	
	<?php /* if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif */?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		&copy; 2014 by Luk - 	Starcode.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
