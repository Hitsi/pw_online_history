<?php

/**
 * This is the model class for table "{{battle}}".
 *
 * The followings are the available columns in table '{{battle}}':
 * @property integer $id
 * @property string $datestart
 * @property string $timestart
 * @property integer $defend
 * @property integer $atack
 * @property integer $winner
 * @property integer $gvgid
 * @property integer $territory
 * @property integer $important
 */
class Battle extends CActiveRecord {

    const IMPORTANT = 1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Battle the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{battle}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('datestart, timestart, defend, atack, gvgid, territory, important', 'required'),
            array('datestart', 'type', 'type' => 'date', 'dateFormat' => 'yyyy-MM-dd'),
            array('timestart', 'type', 'type' => 'date', 'dateFormat' => 'HH:mm:ss'),
            array('defend, atack, winner, gvgid, territory, important', 'numerical', 'integerOnly' => true),
            array('important', 'in', 'range' => array(1, 2)),
            array('territory', 'in', 'range' => range(1, 52)),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, datestart, timestart, defend, atack, winner, gvgid, territory, important', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'clan_atack' => array(self::BELONGS_TO, 'Clans', 'atack'),
            'clan_defend' => array(self::BELONGS_TO, 'Clans', 'defend'),
            'clan_winner' => array(self::BELONGS_TO, 'Clans', 'winner'),
            'gvg_info' => array(self::BELONGS_TO, 'Gvg', 'gvgid'),
            'videos' => array(self::HAS_MANY, 'Video', 'battleid',
                'order' => 'create_time'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'datestart' => 'Дата',
            'timestart' => 'Время',
            'defend' => 'Защитник',
            'atack' => 'Атакующий',
            'winner' => 'Победитель',
            'gvgid' => 'ГВГ',
            'territory' => 'Территория',
            'important' => 'Важно',
            'videos' => 'Видео',
            'gvg_info' => 'ГВГ',
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
        $criteria->compare('datestart', $this->datestart, true);
        $criteria->compare('timestart', $this->timestart, true);
        $criteria->compare('defend', $this->defend);
        $criteria->compare('atack', $this->atack);
        $criteria->compare('winner', $this->winner);
        $criteria->compare('gvgid', $this->gvgid);
        $criteria->compare('territory', $this->territory);
        $criteria->compare('important', $this->important);


        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'datestart DESC',
                    ),
            'pagination'=>array(
                                'pageSize'=>'20',
                        ),
                ));
    }

    public function getUrl($id = "", $datestart = "", $defend = "", $atack = "") {
        if (!empty($id) and !empty($datestart) and !empty($defend) and !empty($atack))
            return Yii::app()->createUrl('battle/view', array(
                        'id' => $id,
                        'datestart' => $datestart,
                        'defend' => $defend,
                        'atack' => $atack,
                    ));
        else
            return Yii::app()->createUrl('battle/view', array(
                        'id' => $this->id,
                        'datestart' => $this->datestart,
                        'defend' => $this->clan_defend->name,
                        'atack' => $this->clan_atack->name,
                    ));
    }

    private static $_items = array();

    public function droplist() {
        $models = self::model()->findAll(array(
            'order' => 'datestart DESC',
                ));
        foreach ($models as $model)
            self::$_items[$model->id] = $model->datestart . " - " . $model->clan_defend->name . " vs " . $model->clan_atack->name;
        return self::$_items;
    }

    public function getShowVideos() {
        $text = "";
        foreach ($this->videos as $value) {
            $text .= CHtml::link(Frapser::model()->findByPK($value->frapserid)->nick, Video::geturl($value->id, $value->title))."&nbsp;";
        }
        return $text;
    }

}