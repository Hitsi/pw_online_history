<?php
/* @var $this LibraryController */
/* @var $model Library */

$this->breadcrumbs = array(
    'Библиотека' => array('index'),
    'Новая статья',
);

$this->menu = array(
    array('label' => 'Список статей', 'url' => array('index')),
    array('label' => 'Управление библиотекой', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.admin",Yii::app()->user->id)),
);
?>

<h1>Создать статью</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>