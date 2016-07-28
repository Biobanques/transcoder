<?php

/**
 * This is the model class for table "CIM_MASTER".
 *
 * The followings are the available columns in table 'CIM_MASTER':
 * @property integer $SID
 * @property string $code
 * @property string $sort
 * @property string $abbrev
 * @property string $LEVEL_
 * @property string $type
 * @property integer $id1
 * @property integer $id2
 * @property integer $id3
 * @property integer $id4
 * @property integer $id5
 * @property integer $id6
 * @property integer $id7
 * @property string $valid
 * @property string $date
 * @property string $author
 * @property string $comment
 * @property integer $CIMO3
 * @property string $LIBELLE
 *
 * The followings are the available model relations:
 * @property ADICAP[] $aDICAPs
 * @property CIMCHAPTER[] $cIMCHAPTERs
 * @property CIMLIBELLE[] $cIMLIBELLEs
 */
class CIMMASTER extends CActiveRecord
{
    public $code;
    public $LIBELLE;
    /**
     * @return string the associated database table name
     */

    /**     * @codeCoverageIgnore     */
    public function tableName() {
        return 'CIM_MASTER';
    }

    /**
     * @return array validation rules for model attributes.
     */

    /**     * @codeCoverageIgnore     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('SID, id1, id2, id3, id4, id5, id6, id7, CIMO3', 'numerical', 'integerOnly' => true),
            array('code, sort, abbrev, author', 'length', 'max' => 20),
            array('LEVEL_, type', 'length', 'max' => 2),
            array('valid', 'length', 'max' => 1),
            array('comment', 'length', 'max' => 200),
            array('LIBELLE', 'length', 'max' => 300),
            array('date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('SID, code, sort, abbrev, LEVEL_, type, id1, id2, id3, id4, id5, id6, id7, valid, date, author, comment, CIMO3, LIBELLE', 'safe', 'on' => 'search'),
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
            // 'aDICAPs' => array(self::MANY_MANY, 'ADICAP', 'ADICAPCIM_TOPO(SID, ADICAP_ID)'),
            'cIMCHAPTERs' => array(self::HAS_MANY, 'CIMCHAPTER', 'SID'),
            'cIMLIBELLEs' => array(self::HAS_MANY, 'CIMLIBELLE', 'SID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */

    /**     * @codeCoverageIgnore     */
    public function attributeLabels() {
        return array(
            'SID' => 'id',
            'code' => 'Code',
            'sort' => 'Sort',
            'abbrev' => 'Abbrev',
            'LEVEL_' => 'Niveau ',
            'type' => 'Type',
            'id1' => 'Id1',
            'id2' => 'Id2',
            'id3' => 'Id3',
            'id4' => 'Id4',
            'id5' => 'Id5',
            'id6' => 'Id6',
            'id7' => 'Id7',
            'valid' => 'Valid',
            'date' => 'Date',
            'author' => 'Author',
            'comment' => 'Comment',
            'CIMO3' => 'Cimo3',
            'LIBELLE' => 'Libelle',
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

    /**
     * @codeCoverageIgnore
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('SID', $this->SID);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('sort', $this->sort, true);
        $criteria->compare('abbrev', $this->abbrev, true);
        $criteria->compare('LEVEL_', $this->LEVEL_, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('id1', $this->id1);
        $criteria->compare('id2', $this->id2);
        $criteria->compare('id3', $this->id3);
        $criteria->compare('id4', $this->id4);
        $criteria->compare('id5', $this->id5);
        $criteria->compare('id6', $this->id6);
        $criteria->compare('id7', $this->id7);
        $criteria->compare('valid', $this->valid, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('CIMO3', $this->CIMO3);
        $criteria->compare('LIBELLE', $this->LIBELLE, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CIMMASTER the static model class
     */

    /**     * @codeCoverageIgnore     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getParents() {
        $result = array();
        if (intval($this->LEVEL_) > 1) {
            for ($i = intval($this->LEVEL_) - 1; $i > 0; $i--) {

                $cimResult = CIMMASTER::model()->findByPk($this->{'id' . $i});
                if ($cimResult != null)
                    $result[$i] = $cimResult;
            }
        }
        return $result;
    }

}