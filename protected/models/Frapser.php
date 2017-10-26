<?php

/**
 * This is the model class for table "{{frapser}}".
 *
 * The followings are the available columns in table '{{frapser}}':
 * @property integer $id
 * @property string $nick
 * @property integer $class
 * @property string $calc
 * @property string $info
 * @property integer $owner
 */
class Frapser extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Frapser the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{frapser}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nick, class', 'required'),
            array('nick', 'unique'),
            array('class, owner', 'numerical', 'integerOnly' => true),
            array('nick, calc', 'length', 'max' => 120),
            array('calc', 'url'),
            array('class', 'in', 'range' => range(1, 10)),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('nick, class, owner', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'videoCount' => array(self::STAT, 'Video', 'frapserid'),

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nick' => 'Ник',
            'class' => 'Класс',
            'calc' => 'Кукла',
            'info' => 'Инфо',
            'videoCount' => 'Видеозаписей',
            'owner' => 'Владелец',
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
        $criteria->compare('nick', $this->nick, true);
        $criteria->compare('class', $this->class);
        $criteria->compare('calc', $this->calc, true);
        $criteria->compare('info', $this->info, true);
        $criteria->compare('owner', $this->owner);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'nick',
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

    public function getUrl($id="", $nick = "") {
        if (!empty($nick) and !empty($id))
            return Yii::app()->createUrl('frapser/view', array(
                        'id'=> $id,
                        'nick' => $nick,
                    ));
        else
            return Yii::app()->createUrl('frapser/view', array(
                        'id'=> $this->id,
                        'nick' => $this->nick,
                    ));
    }

    private static $_items = array();

    public function droplist($change=false) {
        $condition="";
        if($change and !Yii::app()->authManager->isAssigned('admin',Yii::app()->user->id) and !Yii::app()->authManager->isAssigned('moderator',Yii::app()->user->id))
        {
            $condition="owner=".Yii::app()->user->id;
        }
        $models = self::model()->findAll(array(
            "condition"=>$condition,
            'order' => 'nick',
        ));
        foreach ($models as $model)
            self::$_items[$model->id] = $model->nick;
        return self::$_items;
    }
}