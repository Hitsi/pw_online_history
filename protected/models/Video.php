<?php

/**
 * This is the model class for table "{{video}}".
 *
 * The followings are the available columns in table '{{video}}':
 * @property integer $id
 * @property integer $create_time
 * @property integer $frapserid
 * @property integer $clan
 * @property integer $type
 * @property integer $linktype
 * @property string $link
 * @property integer $class
 * @property integer $battleid
 */
class Video extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Video the static model class
     */

    const YOUTUBE_VIDEO = 1;
    const VK_VIDEO = 2;
    const FILE_VIDEO = 3;
    const OTHER_VIDEO = 4;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{video}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title,frapserid, clan, type, linktype, link, class', 'required'),
            array('frapserid, clan, type, linktype, class, battleid', 'numerical', 'integerOnly' => true),
            array('title,link', 'length', 'max' => 120),
            array('link', 'url'),
            array('type,linktype', 'in', 'range' => array(1, 2, 3, 4, 5)),
            array('class', 'in', 'range' => range(1, 10)),
            //array('create_time', 'date','allowEmpty'=>TRUE),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('title, create_time, frapserid, clan, type, linktype, link, class, battleid', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'clan_info' => array(self::BELONGS_TO, 'Clans', 'clan'),
            'frapser_info' => array(self::BELONGS_TO, 'Frapser', 'frapserid'),
            'battle_info' => array(self::BELONGS_TO, 'Battle', 'battleid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Название',
            'create_time' => 'Дата добавления',
            'frapserid' => 'Видеооператор',
            'clan' => 'Клан',
            'type' => 'Тип видео',
            'linktype' => 'Тип ссылки',
            'link' => 'Ссылка',
            'class' => 'Класс',
            'battleid' => 'ГВГ',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('frapserid', $this->frapserid);
        $criteria->compare('clan', $this->clan);
        $criteria->compare('type', $this->type);
        $criteria->compare('linktype', $this->linktype);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('class', $this->class);
        $criteria->compare('battleid', $this->battleid);


        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'create_time DESC',
                    ),
            'pagination'=>array(
                                'pageSize'=>'20',
                        ),
                ));
    }

    public function getUrl($id = "", $title = "") {
        if (!empty($id) and !empty($title))
            return Yii::app()->createUrl('video/view', array(
                        'id' => $id,
                        'title' => $title,
                    ));
        else
            return Yii::app()->createUrl('video/view', array(
                        'id' => $this->id,
                        'title' => $this->title,
                    ));
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->create_time = time();
            } 
            return true;
        }
        else
            return false;
    }

    private $_oldTime;

    protected function afterFind() {
        parent::afterFind();
        $this->_oldTime = $this->create_time;
    }

    public function findRecentVideo($limit = 5) {
        return $this->findAll(array(
                    'order' => 'create_time DESC',
                    'limit' => $limit,
                ));
    }

public function videoname($id) {
	$test="";
        $videos=Video::model()->with(array('frapser_info'))->findAllByAttributes(array("battleid"=>$id));
if($videos!=null)
                            foreach ($videos as $video) {
                                $video_url = CHtml::link(CHtml::encode($video->frapser_info->nick), Video::geturl($video->id, $video->title));
				#$video_url = $video->frapser_info->nick;
                                $test.=$video_url . " ";
                            }
                             
                            return $test;
    }

}