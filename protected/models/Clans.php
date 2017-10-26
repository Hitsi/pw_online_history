<?php

/**
 * This is the model class for table "{{clans}}".
 *
 * The followings are the available columns in table '{{clans}}':
 * @property integer $id
 * @property string $name
 * @property string $master
 * @property string $marshal
 * @property integer $kh
 * @property string $site
 * @property integer $type
 * @property integer $academ
 * @property string $info
 */
class Clans extends CActiveRecord {

    const TYPE_GVG = 1;
    const TYPE_PVP = 2;
    const TYPE_PVE = 3;
    const TYPE_OUT = 4;

    public $icon; // атрибут для хранения загружаемой картинки статьи
    public $del_img; // атрибут для удаления уже загруженной картинки

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Clans the static model class
     */

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{clans}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, kh, type,info', 'required'),
            array('del_img', 'boolean'),
            array('kh, type, academ, owner', 'numerical', 'integerOnly' => true),
            array('type,videotype', 'in', 'range' => array(1, 2, 3, 4)),
            array('kh', 'in', 'range' => array(0, 1)),
            array('site,video', 'url'),
            array('icon', 'file',
                'types' => 'jpg, gif, png, bmp',
                'allowEmpty' => 'true',
                'tooLarge' => 'разрешение 16 на 16.',
            ),
            array('name, master, marshal, site, video', 'length', 'max' => 128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('name, master, marshal, kh, type, academ', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'academ_info' => array(self::BELONGS_TO, 'Clans', 'academ'),
            'battle_defend' => array(self::STAT, 'Battle', 'defend',
                'condition' => 'battle.important=' . Battle::IMPORTANT),
            'battle_atack' => array(self::STAT, 'Battle', 'atack',
                'condition' => 'battle.important=' . Battle::IMPORTANT),
            'battle_win' => array(self::STAT, 'Battle', 'winner',
                'condition' => 'battle.important=' . Battle::IMPORTANT),
            'videos' => array(self::HAS_MANY, 'Video', 'clan',
                'order' => 'video.create_time DESC'),
            'battles' => array(self::HAS_MANY, 'Battle', 'defend,atack',
                'order' => 'datestart DESC'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'master' => 'Мастер',
            'marshal' => 'Маршал',
            'kh' => 'Наличие кланхолла',
            'site' => 'Сайт',
            'type' => 'Тип',
            'academ' => 'Второй состав',
            'info' => 'Инфо о клане',
            'videotype' => 'Тип видео',
            'video' => 'Видеоролик',
            'icon' => 'Иконка клана',
            'del_img' => 'Удалить картинку?',
            'owner' => 'Модератор клана',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('master', $this->master, true);
        $criteria->compare('marshal', $this->marshal, true);
        $criteria->compare('kh', $this->kh, true);
        $criteria->compare('site', $this->site, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('academ', $this->academ);
        $criteria->compare('info', $this->info);
        $criteria->compare('owner', $this->owner);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'name',
                    ),
            'pagination'=>array(
                                'pageSize'=>'20',
                        ),
                ));
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord and empty($this->owner)) {
                $this->owner = Yii::app()->user->id;
            }
            return true;
        }
        else
            return false;
    }

    public function getUrl($id = "", $name = "") {
        if (!empty($id) and !empty($name))
            return Yii::app()->createUrl('clans/view', array(
                        'id' => $id,
                        'name' => $name,
                    ));
        else
            return Yii::app()->createUrl('clans/view', array(
                        'id' => $this->id,
                        'name' => $this->name,
                    ));
    }

    public function getGvgUrl($id = "", $name = "") {
        if (!empty($id) and !empty($name))
            return Yii::app()->createUrl('clans/gvg', array(
                        'id' => $id,
                        'name' => $name,
                    ));
        else
            return Yii::app()->createUrl('clans/gvg', array(
                        'id' => $this->id,
                        'name' => $this->name,
                    ));
    }

    public function getVideoUrl($id = "", $name = "") {
        if (!empty($id) and !empty($name))
            return Yii::app()->createUrl('clans/video', array(
                        'id' => $id,
                        'name' => $name,
                    ));
        else
            return Yii::app()->createUrl('clans/video', array(
                        'id' => $this->id,
                        'name' => $this->name,
                    ));
    }
    
    public function getIcon ($id, $name, $image, $width = "16") {
        if (isset($image) && !empty($image) && file_exists(Yii::app()->basePath . "/../images/clans/" . $image))
            return CHtml::image(Yii::app()->getBaseUrl(true) . "/images/clans/" . $image, $name, array(
                        "width" => $width,
                    ));
        else
            return CHtml::image(Yii::app()->getBaseUrl(true) . "/images/noclan.gif", "Нет картинки", array(
                        "width" => $width,
                    ));
    }

    private static $_items = array();

    public function droplist() {
        $models = self::model()->findAll(array(
            'order' => 'name',
                ));

        foreach ($models as $model)
            self::$_items[$model->id] = $model->name;
        return CHtml::listData(Clans::model()->findAll(array('order' => 'name')), 'id', 'name');
    }

}