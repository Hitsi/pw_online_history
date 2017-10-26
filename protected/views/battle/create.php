<?php
/* @var $this BattleController */
/* @var $model Battle */

$this->breadcrumbs = array(
    'Сражения' => array('index'),
    'Создание',
);

$this->menu = array(
    array('label' => 'Список сражений', 'url' => array('index')),
    array('label' => 'Управление сражениями', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.admin",Yii::app()->user->id)),
);
?>

<h1>Создать сражение</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>