<?php

/**
 * This is the model class for table "ADICAP".
 *
 * The followings are the available columns in table 'ADICAP':
 * @property integer $ADICAP_ID
 * @property string $CODE
 * @property string $LIBELLE
 * @property integer $ADICAP_GROUPE_ID
 * @property integer $ADICAP_PARENT_ID
 * @property integer $MORPHO
 *
 * The followings are the available model relations:
 * @property ADICAPGROUPE $aDICAPGROUPE
 * @property ADICAP $aDICAPPARENT
 * @property ADICAP[] $aDICAPs
 * @property CIMOMORPHO[] $cIMOMORPHOs
 * @property CIMMASTER[] $cIMMASTERs
 */
class ADICAP extends CActiveRecord
{
    public $ADICAP_ID;
    public $CODE;
    public $LIBELLE;
    public $ADICAP_GROUPE_ID;
    public $ADICAP_PARENT_ID;
    public $ADICAPGROUPE;

    /**      @codeCoverageIgnore     */
    public function afterfind() {
        $this->ADICAPGROUPE = $this->aDICAPGROUPE;
    }

    /**
     * @return string the associated database table name
     */

    /**     * @codeCoverageIgnore     */
    public function tableName() {
        return 'ADICAP';
    }

    /**
     * @return array validation rules for model attributes.
     */

    /**     * @codeCoverageIgnore     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ADICAP_ID, ADICAP_GROUPE_ID, ADICAP_PARENT_ID, MORPHO', 'numerical', 'integerOnly' => true),
            array('CODE', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ADICAP_ID, CODE, LIBELLE, ADICAP_GROUPE_ID, ADICAP_PARENT_ID, MORPHO,aDICAPGROUPE,cIMMASTERs, cIMOMORPHOs, aDICAPPARENT', 'safe', 'on' => 'search'),
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
            'aDICAPGROUPE' => array(self::BELONGS_TO, 'ADICAPGROUPE', 'ADICAP_GROUPE_ID'),
            'aDICAPPARENT' => array(self::BELONGS_TO, 'ADICAP', 'ADICAP_PARENT_ID'),
            'cIMOMORPHOs' => array(self::MANY_MANY, 'CIMOMORPHO', 'ADICAPCIMO_MORPHO(ADICAP_ID, CIMO_MORPHO_ID)'),
            'cIMMASTERs' => array(self::MANY_MANY, 'CIMMASTER', 'ADICAPCIM_TOPO(ADICAP_ID, SID)'),
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
     * @return array customized attribute labels (name=>label)
     */

    /**     * @codeCoverageIgnore     */
    public function attributeLabels() {
        return array(
            'ADICAP_ID' => 'Adicap',
            'CODE' => 'Code',
            'LIBELLE' => 'Libelle',
            'ADICAP_GROUPE_ID' => 'Adicap Groupe',
            'ADICAP_PARENT_ID' => 'Adicap Parent',
            'MORPHO' => 'Morpho',
            'CIMMASTERS' => 'CimMasters',
            'CIMLIBELLES' => 'CimLibellés',
            'codeOblig' => 'Code obligatoire',
            'codeFacult' => 'Code facultatif',
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

        $criteria->compare('t.ADICAP_ID', $this->ADICAP_ID);
        $criteria->compare('t.CODE', $this->CODE, true);
        $criteria->compare('t.LIBELLE', $this->LIBELLE, true);
        $criteria->compare('t.ADICAP_GROUPE_ID', $this->ADICAP_GROUPE_ID);
        $criteria->compare('t.ADICAP_PARENT_ID', $this->ADICAP_PARENT_ID);
        $criteria->compare('t.MORPHO', $this->MORPHO);
        $criteria->with = 'cIMMASTERs';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ADICAP the static model class
     */

    /**     * @codeCoverageIgnore     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getCimMasters() {
        $result = "";
        if ($this->cIMMASTERs != null) {

            foreach ($this->cIMMASTERs as $sm)
                $result = $result . "\n" . ' - ' . $sm->LIBELLE;
        }

        return $result;
    }

    public function getCimLibelles() {
        $result = "";
        if ($this->cIMMASTERs != null) {

            foreach ($this->cIMMASTERs as $sm) {
                if ($sm->cIMLIBELLEs != null) {
                    foreach ($sm->cIMLIBELLEs as $sl) {
                        $result = $result . "\n" . ' - ' . $sl->libelle;
                        $result = $result . "\n" . ' - ' . $sl->EN_OMS;
                    }
                }
            }
        }

        return $result;
    }

}