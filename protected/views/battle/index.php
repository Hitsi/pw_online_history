<?php
/* @var $this BattleController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = Yii::app()->name . ' - Сражения';
$this->breadcrumbs = array(
    'Сражения',
);
    $this->menu = array(
        array('label' => 'Создать сражение', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.create",Yii::app()->user->id)),
        array('label' => 'Управление сражениями', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.admin",Yii::app()->user->id)),
    );
?>

<h1>Сражения</h1>
* - помечены важные сражения
<p>
    Вы можете использовать операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    или <b>=</b>) В начале каждого поля поиска.
</p>
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
            'value' => 'Yii::app()->dateFormatter->format("d-MM-y ", Gvg::Model()->FindByPk($data->gvgid)->datestart)',
            'filter' => CHtml::listData(Gvg::model()->findAll(array('order' => 'datestart DESC')), 'id', 'datestart'),
        ),
        array(
            'type' => 'raw',
            'name' => 'datestart',
            'value' => 'CHtml::link(CHtml::encode(Yii::app()->dateFormatter->format("EEEE d MMMM yyyy HH:mm", $data->datestart." ".$data->timestart)), $data->url)',
            'filter' => FALSE,
        ),
        array(
            'type' => 'raw',
            'name' => 'defend',
            'value' => 'Clans::getIcon($data->clan_defend->id, $data->clan_defend->name, $data->clan_defend->image).CHtml::link(CHtml::encode($data->clan_defend->name), Clans::getGvgurl($data->clan_defend->id,$data->clan_defend->name))',
            'filter' => Clans::droplist(),
        ),
        array(
            'type' => 'raw',
            'name' => 'atack',
            'value' => 'Clans::getIcon($data->clan_atack->id, $data->clan_atack->name, $data->clan_atack->image).CHtml::link(CHtml::encode($data->clan_atack->name), Clans::getGvgurl($data->clan_atack->id,$data->clan_atack->name))',
            'filter' => Clans::droplist(),
        ),
        array(
            'type' => 'raw',
            'name' => 'winner',
            'value' => '$data->clan_winner==null?"":Clans::getIcon($data->clan_winner->id, $data->clan_winner->name, $data->clan_winner->image).CHtml::link(CHtml::encode($data->clan_winner->name), Clans::getGvgurl($data->clan_winner->id,$data->clan_winner->name))',
            'filter' => Clans::droplist(),
        ),
    ),
));
?>
