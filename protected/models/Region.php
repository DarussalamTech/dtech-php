<?php

/**
 * This is the model class for table "region".
 *
 * The followings are the available columns in table 'region':
 * @property integer $id
 * @property string $name
 * @property string $iso_code_2
 * @property string $iso_code_3
 * @property string $address_format
 * @property integer $postcode_required
 * @property integer $status
 * @property integer $zone_id
 * @property integer $currency_code
 */
class Region extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Region the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'region';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, iso_code_2, iso_code_3, address_format, postcode_required', 'required'),
            array('postcode_required, status', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),
            array('iso_code_2', 'length', 'max' => 2),
            array('iso_code_3', 'length', 'max' => 3),
            array('currency_code,zone_id,dhl_code', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, iso_code_2, iso_code_3, address_format, postcode_required, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'zone' => array(self::BELONGS_TO, 'Zone', 'zone_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'iso_code_2' => 'Iso Code 2',
            'iso_code_3' => 'Iso Code 3',
            'address_format' => 'Address Format',
            'postcode_required' => 'Postcode Required',
            'status' => 'Status',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('iso_code_2', $this->iso_code_2, true);
        $criteria->compare('iso_code_3', $this->iso_code_3, true);
        $criteria->compare('address_format', $this->address_format, true);
        $criteria->compare('postcode_required', $this->postcode_required);
        $criteria->compare('status', $this->status);
        $criteria->compare('zone_id', $this->zone_id);
        $criteria->compare('currency_code', $this->currency_code);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    /**
     * This will return coutry name on providing country id
     * @param type $region_id : country id
     */
    public function getRegionName($region_id){
        $criteria = new CDbCriteria();
        $criteria->select = "name";
        $criteria->condition = "id = :country_id";
        $criteria->params = array("country_id" => $region_id );
        
        return $this->find($criteria)['name'];
    }
}