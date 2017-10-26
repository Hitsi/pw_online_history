<?php
/* @var $this FrapserController */
/* @var $model Frapser */

$this->breadcrumbs = array(
    'Видеооператоры' => array('index'),
    'Создание',
);

$this->menu = array(
    array('label' => 'Список видеооператоров', 'url' => array('index')),
    array('label' => 'Управление видеооператорами', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Frapser.admin",Yii::app()->user->id)),
);
?>

<h1>Добавить видеооператора</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>