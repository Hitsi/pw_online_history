<?php
/* @var $this BattleController */
/* @var $model Battle */

$this->breadcrumbs = array(
    'Battles' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Список сражений', 'url' => array('index')),
    array('label' => 'Создать сражение', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.create",Yii::app()->user->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#battle-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление сражениями</h1>

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
    'id' => 'battle-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'type' => 'raw',
            'name' => 'territory',
            'value' => '$data->important==Battle::IMPORTANT?$data->territory."*":$data->territory',
        ),
        array(
            'type' => 'raw',
            'name' => 'gvgid',
            'value' => 'Gvg::Model()->FindByPk($data->gvgid)->datestart',
            'filter' => CHtml::listData(Gvg::model()->findAll(array('order' => 'datestart DESC')), 'id', 'datestart'),
        ),
        array(
            'type' => 'raw',
            'name' => 'datestart',
            'value' => 'CHtml::link(CHtml::encode($data->datestart)." ".CHtml::encode($data->timestart), $data->url)',
        ),
        array(
            'type' => 'raw',
            'name' => 'defend',
            'value' => 'CHtml::link(CHtml::encode($data->clan_defend->name), Clans::getGvgurl($data->clan_atack->id,$data->clan_atack->name))',
            'filter' => Clans::droplist(),
        ),
        array(
            'type' => 'raw',
            'name' => 'atack',
            'value' => 'CHtml::link($data->clan_atack->name, Clans::getGvgurl($data->clan_atack->id,$data->clan_atack->name))',
            'filter' => Clans::droplist(),
        ),
        array(
            'type' => 'raw',
            'name' => 'winner',
            'value' => '$data->clan_winner==null?"":CHtml::link(CHtml::encode($data->clan_winner->name), Clans::getGvgurl($data->clan_winner->id,$data->clan_winner->name))',
            'filter' => Clans::droplist(),
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
