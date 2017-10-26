<?php
/* @var $this GvgController */
/* @var $model Gvg */

$this->breadcrumbs = array(
    'Гвг' => array('index'),
    'Управление',
);

$this->menu = array(
    array('label' => 'Список гвг', 'url' => array('index')),
    array('label' => 'Создать гвг', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Gvg.create",Yii::app()->user->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#gvg-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление Гвг</h1>

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
    'id' => 'gvg-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'datestart',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->datestart), $data->url)'
        ),
        array(
            'name' => 'dateend',
            'type' => 'raw',
            'value' => '$data->dateend',
            'filter' => FALSE,
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("gvg/view",array("datestart"=>$data->datestart))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("gvg/update",array("datestart"=>$data->datestart))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("gvg/delete",array("datestart"=>$data->datestart))',
                ),
            ),
        ),
    ),
));
echo Yii::app()->createUrl("gvg/update", array('datestart' => $model->datestart));
?>
