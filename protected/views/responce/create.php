<?php
/* @var $this ResponceController */
/* @var $model Responce */

$this->breadcrumbs = array(
    'Responces' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Responce', 'url' => array('index')),
    array('label' => 'Manage Responce', 'url' => array('admin')),
);
?>

<h1>Create Responce</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>