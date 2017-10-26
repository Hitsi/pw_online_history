<?php
/* @var $this ClansController */
/* @var $model Clans */

$this->breadcrumbs = array(
    'Clans' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Список кланов', 'url' => array('index')),
    array('label' => 'Добавить клан', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.create",Yii::app()->user->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#clans-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление кланами</h1>

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
    list($controller) = Yii::app()->createController('Clans');
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'clans-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'name',
            'type' => 'html',
            'value' => 'ClansController::clans_image($data->id, $data->name, $data->image, "16","small_img left").CHtml::link(CHtml::encode($data->name), $data->url)'
        ),
        'master',
        'marshal',
        array(
            'name' => 'kh',
            'value' => 'Lookup::item("KhExist",$data->kh)',
            'filter' => Lookup::items('KhExist'),
        ),
        array(
            'name' => 'type',
            'value' => 'Lookup::item("ClanType",$data->type)',
            'filter' => Lookup::items('ClanType'),
        ),
        /*
          'type',
          'academ',
          'info',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("clans/view",array("id"=>$data->id,"name"=>$data->name))',
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl("clans/update",array("id"=>$data->id,"name"=>$data->name))',
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl("clans/delete",array("id"=>$data->id,"name"=>$data->name))',
                ),
            ),
        ),
    ),
));
?>
