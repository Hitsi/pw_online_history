<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Пользователи' => array('index'),
    'Создание',
);

$this->menu = array(
    array('label' => 'Список пользователей', 'url' => array('index')),
    array('label' => 'Управление пользователями', 'url' => array('admin')),
);
?>

<h1>Создать пользователя</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>