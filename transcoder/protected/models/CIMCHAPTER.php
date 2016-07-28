<?php

/**
 * This is the model class for table "CIM_CHAPTER".
 *
 * The followings are the available columns in table 'CIM_CHAPTER':
 * @property integer $chap
 * @property integer $SID
 * @property string $rom
 *
 * The followings are the available model relations:
 * @property CIMMASTER $s
 */
class CIMCHAPTER extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */

    /**     * @codeCoverageIgnore     */
    public function tableName() {
        return 'CIM_CHAPTER';
    }

    /**
     * @return array validation rules for model attributes.
     */

    /**     * @codeCoverageIgnore     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('chap, SID', 'numerical', 'integerOnly' => true),
            array('rom', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('chap, SID, rom', 'safe', 'on' => 'search'),
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
            's' => array(self::BELONGS_TO, 'CIMMASTER', 'SID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */

    /**     * @codeCoverageIgnore     */
    public function attributeLabels() {
        return array(
            'chap' => 'Chap',
            'SID' => 'Sid',
            'rom' => 'Rom',
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

        $criteria->compare('chap', $this->chap);
        $criteria->compare('SID', $this->SID);
        $criteria->compare('rom', $this->rom, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CIMCHAPTER the static model class
     */

    /**     * @codeCoverageIgnore     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}