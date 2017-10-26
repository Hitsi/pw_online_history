<?php
/* @var $this GuestbookController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Гостевая книга',
);

$this->menu=array(
	array('label'=>'Создать запись', 'url'=>array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Guestbook.create",Yii::app()->user->id)),
	array('label'=>'Управление', 'url'=>array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Guestbook.admin",Yii::app()->user->id)),
);
?>

<h1>Гостевая книга</h1>

<div id="comments">
<?php 
if (! Yii::app()->user->isGuest)
echo $this->renderPartial('_form', array('model' => $model)); 
else
echo "Login";
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'sortableAttributes'=>array(
        'create_time',
    ),
)); ?>
</div>
