<?php

/**
 * This is the model class for table "CIMO_MORPHO".
 *
 * The followings are the available columns in table 'CIMO_MORPHO':
 * @property integer $CIMO_MORPHO_ID
 * @property string $CODE
 * @property string $LIBELLE
 * @property string $CIM_REF
 *
 * The followings are the available model relations:
 * @property ADICAP[] $aDICAPs
 */
class CIMOMORPHO extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */

    /**     * @codeCoverageIgnore     */
    public function tableName() {
        return 'CIMO_MORPHO';
    }

    /**
     * @return array validation rules for model attributes.
     */

    /**     * @codeCoverageIgnore     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('CIMO_MORPHO_ID, CODE, LIBELLE', 'required'),
            array('CIMO_MORPHO_ID', 'numerical', 'integerOnly' => true),
            array('CODE', 'length', 'max' => 10),
            array('LIBELLE', 'length', 'max' => 250),
            array('CIM_REF', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('CIMO_MORPHO_ID, CODE, LIBELLE, CIM_REF', 'safe', 'on' => 'search'),
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
                //'aDICAPs' => array(self::MANY_MANY, 'ADICAP', 'ADICAPCIMO_MORPHO(CIMO_MORPHO_ID, ADICAP_ID)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */

    /**     * @codeCoverageIgnore     */
    public function attributeLabels() {
        return array(
            'CIMO_MORPHO_ID' => 'Cimo Morpho',
            'CODE' => 'Code',
            'LIBELLE' => 'Libelle',
            'CIM_REF' => 'Cim Ref',
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

        $criteria->compare('CIMO_MORPHO_ID', $this->CIMO_MORPHO_ID);
        $criteria->compare('CODE', $this->CODE, true);
        $criteria->compare('LIBELLE', $this->LIBELLE, true);
        $criteria->compare('CIM_REF', $this->CIM_REF, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CIMOMORPHO the static model class
     */

    /**     * @codeCoverageIgnore     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}