<?php

/**
 * This is the model class for table "dhl_rates".
 *
 * The followings are the available columns in table 'dhl_rates':
 * @property integer $id
 * @property string $weight
 * @property string $zone_id
 * @property string $rate
 * @property integer $city_id
 * @property integer $rate_type
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 *
 * The followings are the available model relations:
 * @property DhlRatesHistory[] $dhlRatesHistories
 */
class ZoneRates extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DhlRates the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'zone_rates';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('create_time, create_user_id, update_time, update_user_id', 'required'),
            array('city_id', 'numerical', 'integerOnly' => true),
            array('weight, zone_id', 'length', 'max' => 255),
            array('rate', 'length', 'max' => 10),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('rate_type', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, weight, zone_id, rate, city_id, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'ZoneRatesHistory' => array(self::HAS_MANY, 'ZoneRatesHistory', 'rate_id'),
            'dhlRatesHistories' => array(self::HAS_MANY, 'ZoneRatesHistory', 'rate_id','condition' => 'rate_type="dhl"'),
            'dhlRatesLastHist' => array(self::HAS_ONE, 'ZoneRatesHistory', 'rate_id','order'=>'id DESC'),
            'zone' => array(self::BELONGS_TO, 'Zone', 'zone_id'),
            'zone_dhl' => array(self::BELONGS_TO, 'Zone', 'zone_id', 'condition' => 'rate_type="dhl"'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'weight' => 'Weight',
            'zone_id' => 'Zone',
            'rate' => 'Rate',
            'rate_type' => 'Rate',
            'city_id' => 'City',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User',
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
        $criteria->compare('weight', $this->weight, true);
        $criteria->compare('zone_id', $this->zone_id, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('rate_type', $this->rate_type);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * save history data
     */
    public function afterSave() {
        $criteria = new CDbCriteria;
        $criteria->order = "create_time DESC";
        $criteria->condition = "rate_id = " . $this->id;
        $criteria->select = "rate";
        $lastZone = ZoneRatesHistory::model()->find($criteria);
        if ($lastZone != $this->rate) {
            $model = new ZoneRatesHistory;
            $model->rate_id = $this->id;
            $model->rate = $this->rate;
            $model->save();
        }
        parent::afterSave();
        return true;
    }

}