<?php
/* @var $this FrapserController */
/* @var $model Frapser */

$this->breadcrumbs = array(
    'Видеооператоры' => array('index'),
    'Управление',
);

$this->menu = array(
    array('label' => 'Список видеооператоров', 'url' => array('index')),
    array('label' => 'Создать видеооператора', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.create",Yii::app()->user->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#frapser-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление видеооператорами</h1>

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
    'id' => 'frapser-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'nick',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->nick), $data->url)'
        ),
        array(
            'name' => 'class',
            'value' => 'Lookup::item("PlayerClassName",$data->class)',
            'filter' => Lookup::items('PlayerClassName'),
        ),
        array(
            'type' => 'raw',
            'name' => 'calc',
            'value' => 'CHtml::link(CHtml::encode($data->calc), $data->calc,array("target"=>"_blank"))',
            'filter' => FALSE,
        ),
        'videoCount',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("frapser/view",array("id"=>$data->id,"nick"=>$data->nick))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("frapser/update",array("id"=>$data->id,"nick"=>$data->nick))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("frapser/delete",array("id"=>$data->id,"nick"=>$data->nick))',
                ),
            ),
        ),
    ),
));
?>
