<?php
/* @var $this ClansController */
/* @var $model Clans */

$this->breadcrumbs = array(
    'Кланы' => array('index'),
    'Создание',
);

$this->menu = array(
    array('label' => 'Список кланов', 'url' => array('index')),
    array('label' => 'Управление кланами', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.admin",Yii::app()->user->id)),
);
?>

<h1>Добавление клана</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>