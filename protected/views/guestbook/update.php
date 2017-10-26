<?php
/* @var $this GuestbookController */
/* @var $model Guestbook */

$this->breadcrumbs=array(
	'Гостевая книга'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обновить запись',
);

$this->menu=array(
	array('label'=>'List Guestbook', 'url'=>array('index')),
	array('label'=>'Create Guestbook', 'url'=>array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Guestbook.create",Yii::app()->user->id)),
	array('label'=>'View Guestbook', 'url'=>array('view', 'id'=>$model->id), 'visible' => Yii::app()->getAuthManager()->checkAccess("Guestbook.view",Yii::app()->user->id)),
	array('label'=>'Manage Guestbook', 'url'=>array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Guestbook.admin",Yii::app()->user->id)),
);
?>

<h1>Обновление записи <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>