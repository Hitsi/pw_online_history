<?php
/* @var $this BattleController */
/* @var $model Battle */

$this->breadcrumbs = array(
    'Сражения' => array('index'),
    Yii::app()->dateFormatter->format("dd-MM-y ", $model->datestart) . " " . $model->clan_defend->name . " vs " . $model->clan_atack->name,
);

$this->menu = array(
    array('label' => 'Список сражений', 'url' => array('index')),
    array('label' => 'Создать сражение', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.create",Yii::app()->user->id)),
    array('label' => 'Обновить сражение', 'url' => array('update', 'id' => $model->id, 'datestart' => $model->datestart, 'atack' => $model->clan_atack->name, 'defend' => $model->clan_defend->name), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.update",Yii::app()->user->id)),
    array('label' => 'Удалить сражение', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id, 'datestart' => $model->datestart, 'atack' => $model->clan_atack->name, 'defend' => $model->clan_defend->name), 'confirm' => 'Вы уверены что хотите удалить?'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.delete",Yii::app()->user->id)),
    array('label' => 'Управление сражениями', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.admin",Yii::app()->user->id)),
    array('label' => 'Добавить видео', 'url' => array('video/create', 'battleid' => $model->id), 'visible' => Yii::app()->getAuthManager()->checkAccess("Video.create",Yii::app()->user->id)),
);
?>

<h1>Сражение <?php echo Yii::app()->dateFormatter->format("dd-MM-y ", $model->datestart) . " " . $model->clan_defend->name . " vs " . $model->clan_atack->name; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'type' => 'raw',
            'name' => 'datestart',
            'value' => Yii::app()->dateFormatter->format("EEEE dd MMMM yyyy HH:mm", $model->datestart . " " . $model->timestart),
        ),
        'territory',
        array(
            'type' => 'raw',
            'name' => 'defend',
            'value' => Clans::getIcon($model->clan_defend->id, $model->clan_defend->name, $model->clan_defend->image).CHtml::link(CHtml::encode($model->clan_defend->name), Clans::getGvgurl($model->clan_defend->id, $model->clan_defend->name)),
        ),
        array(
            'type' => 'raw',
            'name' => 'atack',
            'value' => Clans::getIcon($model->clan_atack->id, $model->clan_atack->name, $model->clan_atack->image).CHtml::link(CHtml::encode($model->clan_atack->name), Clans::getGvgurl($model->clan_atack->id, $model->clan_atack->name)),
        ),
        array(
            'type' => 'raw',
            'name' => 'winner',
            'value' => $model->clan_winner == null ? "" : Clans::getIcon($model->clan_winner->id, $model->clan_winner->name, $model->clan_winner->image).CHtml::link(CHtml::encode($model->clan_winner->name), Clans::getGvgurl($model->clan_winner->id, $model->clan_winner->name)),
        ),
        array(
            'type' => 'raw',
            'name' => 'gvgid',
            'value' => CHtml::link(CHtml::encode(Yii::app()->dateFormatter->format("d-MM-y ", $model->gvg_info->datestart)), Gvg::geturl($model->gvg_info->datestart)),
        ),
        array(
            'type' => 'raw',
            'name' => 'important',
            'value' => Lookup::item('Important', $model->important),
        ),
        array(
            'type' => 'raw',
            'name' => 'videos',
            'value' => $model->showVideos,
        ),
    ),
));
?>
