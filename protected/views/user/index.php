<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Пользователи',
);

$this->menu = array(
    array('label' => 'Создать пользователя', 'url' => array('create')),
    array('label' => 'Управление пользователями', 'url' => array('admin')),
);
?>

<h1>Users</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
