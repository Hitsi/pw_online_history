<?php
/* @var $this ResponceController */
/* @var $model Responce */

$this->breadcrumbs = array(
    'Responces' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Написать сообщение', 'url' => array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#responce-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление сообщениями</h1>

<p>
    Вы можете использовать операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    или <b>=</b>) В начале каждого поля поиска.
</p>

<?php echo CHtml::link('Расширенный поиск', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'responce-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'type' => 'raw',
            'name' => 'title',
            'value' => '$data->title',
        ),
        array(
            'type' => 'date',
            'name' => 'create_time',
            'value' => '$data->create_time',
        ),
        'email',
        array(
            'type' => 'raw',
            'name' => 'status',
            'value' => 'Lookup::item("ResponceStatus",$data->status)',
            'filter' => Lookup::items("ResponceStatus"),
        ),
        'nick',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
