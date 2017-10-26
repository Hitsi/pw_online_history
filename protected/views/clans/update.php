<?php
/* @var $this ClansController */
/* @var $model Clans */

$this->breadcrumbs = array(
    'Кланы' => array('index'),
    $model->name => array('view', 'id' => $model->id, 'name' => $model->name),
    'Обновление',
);

$this->menu = array(
    array('label' => 'Список кланов', 'url' => array('index')),
    array('label' => 'Просмотр клана', 'url' => array('view', 'id' => $model->id, 'name' => $model->name)),
    array('label' => 'Создать клан', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.create",Yii::app()->user->id)),
    array('label' => 'Управление кланами', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.admin",Yii::app()->user->id)),
);
?>

<h1>Обновление клана <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>