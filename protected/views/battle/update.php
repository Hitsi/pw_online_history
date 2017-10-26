<?php
/* @var $this BattleController */
/* @var $model Battle */

$this->breadcrumbs = array(
    'Сражение' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Обновление',
);

$this->menu = array(
    array('label' => 'Список сражений', 'url' => array('index')),
    array('label' => 'Создать сражение', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.create",Yii::app()->user->id)),
    array('label' => 'Просмотр сражения', 'url' => array('view', 'id' => $model->id, 'datestart' => $model->datestart, 'atack' => $model->clan_atack->name, 'defend' => $model->clan_defend->name), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.delete",Yii::app()->user->id)),
    array('label' => 'Управление сражениями', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.admin",Yii::app()->user->id)),
);
?>

<h1>Обновление сражения <?php echo $model->datestart . " " . $model->clan_defend->name . " vs " . $model->clan_atack->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>