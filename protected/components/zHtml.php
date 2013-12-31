<?php
/**
 * extending CHTml feature for handling zHTml
 */
class zHtml extends CHtml {

    public static function enumDropDownList($model, $attribute, $htmlOptions = array()) {
        return CHtml::activeDropDownList($model, $attribute, self::enumItem($model, $attribute), $htmlOptions);
    }
    /**
     * enum columns of db table will be return here in array
     * @param type $model
     * @param type $attribute
     * @return type
     */
    public static function enumItem($model, $attribute) {
        $attr = $attribute;
        self::resolveName($model, $attr);
        preg_match('/\((.*)\)/', $model->tableSchema->columns[$attr]->dbType, $matches);
        foreach (explode(',', $matches[1]) as $value) {
            $value = str_replace("'", null, $value);
            $values[$value] = Yii::t('enumItem', $value);
        }
        return $values;
    }

    /**
     * showing coma sperated string 
     * in differnt style
     * @param type $coma_string
     */
    public static function showComaSeperatedData($coma_string = "") {

        if (!empty($coma_string)) {
            $returnString = "<ul style='margin-left:20px'><li>";
            $returnString.=str_replace(",", "</li><li>", $coma_string);
            $returnString.= "</li></ul>";
            return $returnString;
        }
        return "";
    }

}

?>
