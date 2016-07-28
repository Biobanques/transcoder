<?php

/**
 * This is the model class for table "CIM_LIBELLE".
 *
 * The followings are the available columns in table 'CIM_LIBELLE':
 * @property integer $LID
 * @property integer $SID
 * @property string $source
 * @property string $valid
 * @property string $libelle
 * @property string $FR_OMS
 * @property string $EN_OMS
 * @property string $GE_DIMDI
 * @property string $GE_AUTO
 * @property string $FR_CHRONOS
 * @property string $date
 * @property string $author
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property CIMMASTER $s
 */
class CIMLIBELLE extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */

    /**     * @codeCoverageIgnore     */
    public function tableName() {
        return 'CIM_LIBELLE';
    }

    /**
     * @return array validation rules for model attributes.
     */

    /**     * @codeCoverageIgnore     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('LID, SID', 'numerical', 'integerOnly' => true),
            array('source', 'length', 'max' => 2),
            array('valid', 'length', 'max' => 1),
            array('libelle, FR_OMS, EN_OMS, GE_DIMDI, GE_AUTO, FR_CHRONOS', 'length', 'max' => 510),
            array('author', 'length', 'max' => 20),
            array('comment', 'length', 'max' => 200),
            array('date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('LID, SID, source, valid, libelle, FR_OMS, EN_OMS, GE_DIMDI, GE_AUTO, FR_CHRONOS, date, author, comment', 'safe', 'on' => 'search'),
        );
    }

    /**     * @codeCoverageIgnore     */
    public function behaviors() {
        return array(
            'EJsonBehavior' => array(
                'class' => 'application.behaviors.EJsonBehavior'
            ),
        );
    }

    /**
     * @return array relational rules.
     */

    /**     * @codeCoverageIgnore     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
                //'s' => array(self::BELONGS_TO, 'CIMMASTER', 'SID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */

    /**     * @codeCoverageIgnore     */
    public function attributeLabels() {
        return array(
            'LID' => 'Lid',
            'SID' => 'Sid',
            'source' => 'Source',
            'valid' => 'Valid',
            'libelle' => 'Libelle',
            'FR_OMS' => 'Fr Oms',
            'EN_OMS' => 'En Oms',
            'GE_DIMDI' => 'Ge Dimdi',
            'GE_AUTO' => 'Ge Auto',
            'FR_CHRONOS' => 'Fr Chronos',
            'date' => 'Date',
            'author' => 'Author',
            'comment' => 'Comment',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */

    /**     * @codeCoverageIgnore     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('LID', $this->LID);
        $criteria->compare('SID', $this->SID);
        $criteria->compare('source', $this->source, true);
        $criteria->compare('valid', $this->valid, true);
        $criteria->compare('libelle', $this->libelle, true);
        $criteria->compare('FR_OMS', $this->FR_OMS, true);
        $criteria->compare('EN_OMS', $this->EN_OMS, true);
        $criteria->compare('GE_DIMDI', $this->GE_DIMDI, true);
        $criteria->compare('GE_AUTO', $this->GE_AUTO, true);
        $criteria->compare('FR_CHRONOS', $this->FR_CHRONOS, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('comment', $this->comment, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CIMLIBELLE the static model class
     */

    /**     * @codeCoverageIgnore     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}