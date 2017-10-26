<?php
/* @var $this GuestbookController */
/* @var $model Guestbook */

$this->breadcrumbs=array(
	'Гостевая книга'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Гостевая книга', 'url'=>array('index')),
	array('label'=>'Добавить запись', 'url'=>array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Guestbook.create",Yii::app()->user->id)),
	array('label'=>'Обновить запись', 'url'=>array('update', 'id'=>$model->id), 'visible' => Yii::app()->getAuthManager()->checkAccess("Guestbook.update",Yii::app()->user->id)),
	array('label'=>'Удалить запись', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить эту запись?'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Guestbook.delete",Yii::app()->user->id)),
	array('label'=>'Управление', 'url'=>array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Guestbook.admin",Yii::app()->user->id)),
);
?>

<h1>Запись в гостевой #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'authorid',
		'author',
		'create_time',
	),
));
echo $model->content;
?>
