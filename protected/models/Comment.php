<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property integer $id
 * @property string $content
 * @property integer $create_time
 * @property string $author
 * @property integer $gvg_id
 *
 * The followings are the available model relations:
 * @property Gvg $gvg
 */
class Comment extends CActiveRecord {
    
     public $verifyCode;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{comment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('content', 'required'),
            array('author', 'length', 'max' => 128),
            array('verifyCode', 'captcha', 'allowEmpty' => !Yii::app()->user->isGuest),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, create_time, author, gvg_id, type', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'gvg' => array(self::BELONGS_TO, 'Gvg', 'gvg_id'),
            'user_info' => array(self::BELONGS_TO, 'User', 'authorId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'content' => 'Сообщение',
            'create_time' => 'Дата',
            'author' => 'Ник',
            'authorId' => 'Автор',
            'gvg_id' => 'Гвг',
            'type' => 'Раздел',
            'verifyCode' => 'Код для проверки',
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
        $criteria->compare('content', $this->content, true);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('gvg_id', $this->gvg_id);
        $criteria->compare('type', $this->type);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->create_time = time();
                $this->authorId=Yii::app()->user->id;
            }
            return true;
        }
        else
            return false;
    }

    public function getUrl($gvg = null) {
        if ($gvg === null)
            $gvg = $this->gvg;
        return $gvg->url . '#c' . $this->id;
    }

    public function findRecentComments($limit = 5) {
        return $this->with('gvg')->findAll(array(
                    'order' => 'create_time DESC',
                    'limit' => $limit,
                ));
    }

}