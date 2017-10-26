<?php
/* @var $this GuestbookController */
/* @var $model Guestbook */

$this->breadcrumbs=array(
	'Гостевая книга'=>array('index'),
	'Написать',
);

$this->menu=array(
	array('label'=>'Гостевая книга', 'url'=>array('index')),
	array('label'=>'Управление', 'url'=>array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Guestbook.admin",Yii::app()->user->id)),
);
?>

<h1>Создать запись в гостевой книге</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>