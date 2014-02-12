<?php

/**
 * This is the model class for table "import_mapping".
 *
 * The followings are the available columns in table 'import_mapping':
 * @property integer $id
 * @property string $file_name
 * @property string $file_path
 * @property string $module
 * @property string $category
 * @property string $city_id
 * @property string $total_steps
 * @property string $completed_steps
 * @property string $sheet
 * @property string $headers_json
 * @property string $db_cols_json
 * @property string $relational_json
 * @property string $create_time
 * @property string $create_user_id
 * @property string $update_time
 * @property string $update_user_id
 */
class ImportMapping extends DTActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ImportMapping the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'import_mapping';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sheet,file_name, file_path, module, create_time, create_user_id, update_time, update_user_id', 'required'),
            array('file_name, file_path, module', 'length', 'max' => 255),
            array('create_user_id, update_user_id', 'length', 'max' => 11),
            array('relational_json,headers_json, db_cols_json', 'safe'),
            array('category,city_id, total_steps,completed_steps', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, file_name, file_path, module, headers_json, db_cols_json, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'city' => array(self::BELONGS_TO, 'City', 'city_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'file_name' => 'File Name',
            'file_path' => 'File Path',
            'module' => 'Module',
            'category' => 'Category',
            'sheet' => 'Sheet No',
            'city_id' => 'City',
            'total_steps' => 'Total Steps',
            'completed_steps' => 'Completed Steps',
            'headers_json' => 'Headers Json',
            'db_cols_json' => 'Db Cols Json',
            'relational_json' => 'Relations Json',
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
        $criteria->compare('file_name', $this->file_name, true);
        $criteria->compare('file_path', $this->file_path, true);
        $criteria->compare('module', $this->module, true);
        $criteria->compare('category', $this->category, true);
        $criteria->compare('sheet', $this->sheet, true);
        $criteria->compare('city_id', $this->city_id, true);
        $criteria->compare('total_steps', $this->total_steps, true);
        $criteria->compare('completed_steps', $this->completed_steps, true);
        $criteria->compare('headers_json', $this->headers_json, true);
        $criteria->compare('db_cols_json', $this->db_cols_json, true);
        $criteria->compare('relational_json', $this->relational_json, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}