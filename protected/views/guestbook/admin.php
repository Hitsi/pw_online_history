<?php
/* @var $this GuestbookController */
/* @var $model Guestbook */

$this->breadcrumbs=array(
	'Гостевая книга'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Гостевая книга', 'url'=>array('index')),
	array('label'=>'Добавить запись', 'url'=>array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Guestbook.create",Yii::app()->user->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#guestbook-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление гостевой книгой</h1>

<p>
    Вы можете использовать операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    или <b>=</b>) В начале каждого поля поиска.
</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'guestbook-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'authorid',
		'author',
        array(
            'type' => 'raw',
            'name' => 'create_time',
            'value' => Yii::app()->dateFormatter->format('EEEE dd MMMM yyyy HH:mm', $model->create_time ),
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
