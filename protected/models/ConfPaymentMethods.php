<?php

/**
 * This is the model class for table "payment_methods".
 *
 * The followings are the available columns in table 'payment_methods':
 * @property string $id
 * @property string $name
 * @property string $status
 * @property string $key
 * @property string $secret
 * @property string $signature
 * @property string $city_id
 * @property string $sandbox
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class ConfPaymentMethods extends DTActiveRecord {

    public $confViewName = 'ConfPaymentMethods/PaymentMethods';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PaymentMethods the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'payment_methods';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('name', 'length', 'max' => 255),
            array('status, sandbox', 'length', 'max' => 7),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('signature,secret ,key , city_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, status, sandbox, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'city_rel' => array(self::BELONGS_TO, 'City', 'city_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'sandbox' => 'Sanbox',
            'secret' => 'apiPassword (TRANSACTION_KEY)',
            'key' => 'apiUsername (LOGIN_ID)',
            'signature' => 'apiSignature',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('sandbox', $this->sandbox, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * convert amount to usd if 
     * the default currency rate is not in usd
     * @param type $amount
     */
    public function convertToDollar($amount) {

        if (Yii::app()->session['currency'] != "USD" && $amount > 0) {
            // Initialize the CURL library
            $api_key = "a634e1f81617c61308330be500514cbe";
            $cURL = curl_init();

            // Set the URL to execute
            curl_setopt($cURL, CURLOPT_URL, "http://xmlfeed.theeasyapi.com");

            // Set options
            curl_setopt($cURL, CURLOPT_HEADER, 0);
            curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($cURL, CURLOPT_POST, 1);
            curl_setopt($cURL, CURLOPT_POSTFIELDS, "request=<easyapi_wrapper>
                <login>
                   <apikey>" . $api_key . "</apikey>
                </login>
                <search>
                   <service>convert_webxcurrency</service>
                   <criteria>
                      <amount>$amount</amount>
                      <tocur>USD</tocur>
                      <fromcur>" . Yii::app()->session['currency'] . "</fromcur>
                   </criteria>
                </search>
             </easyapi_wrapper>");

            // Execute, saving results in a variable
            $strPage = curl_exec($cURL);

            // Close CURL resource
            curl_close($cURL);

            // Now the variable $strPage has the returned XML.
            // Parse the XML into something a little more useful
            $xml_ret = simplexml_load_string($strPage);
            return json_decode(json_encode($xml_ret), true);
        }

        return $amount;
    }

    /**
     * 
     * @param type $amount
     * @param type $from
     * @param type $to
     * @return type
     */
    public function convertCurrency($amount, $from, $to) {
        $url = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
        $data = file_get_contents($url);
        preg_match("/<span class=bld>(.*)<\/span>/", $data, $converted);
        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
        
        return ceil($converted);
    }

}