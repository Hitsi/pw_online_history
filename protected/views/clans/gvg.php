<?php
/* @var $this ClansController */
/* @var $model Clans */

$this->breadcrumbs = array(
    'Clans' => array('index'),
    $model->name => Clans::getUrl($model->id, $model->name),
    'Гвг',
);

$this->menu = array(
    array('label' => 'Список кланов', 'url' => array('index')),
    array('label' => 'Инфо о клане', 'url' => array('view', 'id' => $model->id, 'name' => $model->name)),
    array('label' => 'Видео клана', 'url' => array('video', 'id' => $model->id, 'name' => $model->name)),
    array('label' => 'Создать клан', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.create",Yii::app()->user->id)),
    array('label' => 'Обновить клан', 'url' => array('update', 'id' => $model->id), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.update",Yii::app()->user->id)),
    array('label' => 'Удалить клан', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы уверены что хотите удалить?'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.delete",Yii::app()->user->id)),
    array('label' => 'Управление кланами', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Clans.admin",Yii::app()->user->id)),
);
?>

<h1>Гвг клана <?php echo $model->name; ?></h1>
<?php echo $this->renderPartial('_info', array('model' => $model)); ?>

<?php
$dataProvider = new CActiveDataProvider('Battle', array(
            'criteria' => array(
                'condition' => 'atack=' . $model->id . ' or defend=' . $model->id,
                'order' => 'datestart DESC, timestart DESC'
            ),
        ));

$model_battle = new Battle('search');
$model_battle->unsetAttributes();  // clear any default values
if (isset($_GET['Battle']))
    $model_battle->attributes = $_GET['Battle'];
$dataProvider->criteria->compare('territory', $model_battle->territory, true);
$dataProvider->criteria->compare('datestart', $model_battle->datestart, true);
$dataProvider->criteria->compare('defend', $model_battle->defend, true);
$dataProvider->criteria->compare('atack', $model_battle->atack, true);
$dataProvider->criteria->compare('winner', $model_battle->winner, true);

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'battle-grid',
    'dataProvider' => $dataProvider,
    'filter' => $model_battle,
    'columns' => array(
        array(
            'type' => 'html',
            'name' => 'territory',
            'value' => '$data->important==1?CHtml::encode($data->territory)."*":CHtml::encode($data->territory)',
        ),
        array(
            'type' => 'html',
            'name' => 'datestart',
            'value' => 'CHtml::link(CHtml::encode($data->datestart." ".$data->timestart), Battle::geturl($data->id,$data->datestart,$data->clan_defend->name,$data->clan_atack->name))',
        ),
        array(
            'type' => 'html',
            'name' => 'defend',
            'value' => 'Clans::getIcon($data->clan_defend->id, $data->clan_defend->name, $data->clan_defend->image) . "&nbsp;" .CHtml::link(CHtml::encode($data->clan_defend->name), Clans::geturl($data->clan_defend->id,$data->clan_defend->name))',
            'filter' => Clans::droplist(),
        ),
        array(
            'type' => 'html',
            'name' => 'atack',
            'value' => 'Clans::getIcon($data->clan_atack->id, $data->clan_atack->name, $data->clan_atack->image) . "&nbsp;" .CHtml::link(CHtml::encode($data->clan_atack->name), Clans::geturl($data->clan_atack->id,$data->clan_atack->name))',
            'filter' => Clans::droplist(),
        ),
        array(
            'type' => 'html',
            'name' => 'winner',
            'value' => '$data->clan_winner==null?"":Clans::getIcon($data->clan_winner->id, $data->clan_winner->name, $data->clan_winner->image) . "&nbsp;" .CHtml::link(CHtml::encode($data->clan_winner->name), Clans::geturl($data->clan_winner->id,$data->clan_winner->name))',
            'filter' => Clans::droplist(),
        ),
        array(
            'type' => 'raw',
            'name' => 'videos',
            'filter' => FALSE,
            'value' => 'Video::videoname($data->id)'
        ),
    ),
));
?>
