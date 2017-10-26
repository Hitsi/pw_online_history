<?php
/* @var $this LibraryController */
/* @var $model Library */
$typename = Lookup::item('LibraryType', $model->type);
$this->breadcrumbs = array(
    'Библиотека' => array('index'),
    $typename => array('typeview', 'type' => $typename),
    $model->name => array('view', 'type' => $typename, 'name' => $model->name),
    'Управление',
);

$this->menu = array(
    array('label' => 'Список статей', 'url' => array('index')),
    array('label' => 'Создать статью', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.create",Yii::app()->user->id)),
    array('label' => 'Просмотр статьи', 'url' => array('view', 'type' => $typename, 'name' => $model->name)),
    array('label' => 'Управление библиотекой', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Library.admin",Yii::app()->user->id)),
);
?>

<h1>Обновление статьи <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>