<?php

/**
 * This is the model class for table "ADICAP_GROUPE".
 *
 * The followings are the available columns in table 'ADICAP_GROUPE':
 * @property integer $ADICAP_GROUPE_ID
 * @property string $NOM
 * @property integer $GROUPE_PARENT_ID
 *
 * The followings are the available model relations:
 * @property ADICAP[] $aDICAPs
 * @property ADICAPGROUPE $gROUPEPARENT
 * @property ADICAPGROUPE[] $aDICAPGROUPEs
 */
class ADICAPGROUPE extends CActiveRecord
{
    public $ADICAP_GROUPE_ID;
    public $NOM;

    /**     * @codeCoverageIgnore     */
    public function behaviors() {
        return array(
            'EJsonBehavior' => array(
                'class' => 'application.behaviors.EJsonBehavior'
            ),
        );
    }

    /**
     * @return string the associated database table name
     */

    /**     * @codeCoverageIgnore     */
    public function tableName() {
        return 'ADICAP_GROUPE';
    }

    /**
     * @return array validation rules for model attributes.
     */

    /**     * @codeCoverageIgnore     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOM', 'required'),
            array('GROUPE_PARENT_ID', 'numerical', 'integerOnly' => true),
            array('NOM', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ADICAP_GROUPE_ID, NOM, GROUPE_PARENT_ID,', 'safe', 'on' => 'search'),
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
            'gROUPEPARENT' => array(self::BELONGS_TO, 'ADICAPGROUPE', 'GROUPE_PARENT_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */

    /**     * @codeCoverageIgnore     */
    public function attributeLabels() {
        return array(
            'ADICAP_GROUPE_ID' => 'Adicap Groupe',
            'NOM' => 'Nom',
            'GROUPE_PARENT_ID' => 'Groupe Parent',
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

        $criteria->compare('ADICAP_GROUPE_ID', $this->ADICAP_GROUPE_ID);
        $criteria->compare('NOM', $this->NOM, true);
        $criteria->compare('GROUPE_PARENT_ID', $this->GROUPE_PARENT_ID);
        $criteria->with = 'gROUPE_PARENT';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ADICAPGROUPE the static model class
     */

    /**     * @codeCoverageIgnore     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}