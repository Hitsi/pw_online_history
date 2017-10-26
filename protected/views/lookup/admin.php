<?php
/* @var $this LookupController */
/* @var $model Lookup */

$this->breadcrumbs = array(
    'Константы' => array('index'),
    'Управление',
);

$this->menu = array(
    array('label' => 'Список констант', 'url' => array('index'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Lookup.index",Yii::app()->user->id)),
    array('label' => 'Добавить константу', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Lookup.create",Yii::app()->user->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lookup-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление константамии</h1>
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
    'id' => 'lookup-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'code',
        array(
            'type' => 'raw',
            'name' => 'type',
            'value' => '$data->type',
            'filter' => Lookup::droplist()
        ),
        'position',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
