<?php

class DTMultiLangBehaviour extends CActiveRecordBehavior {

    /**
     * Named scope to use {@link localizedRelation}
     * @param string $lang the lang the retrieved models will be translated (default to current application language)
     * @return model 
     */
    public $defaultLanguage = 'en';
    public $current_lang;
    public $relation;
    public $langClassName;
    public $langTableName;
    public $langForeignKey;
    public $localizedAttributes = array();
    public $localizedPrefix;
    public $languages;

    public function localized($lang = 'en') {

        $this->current_lang = $lang;

        $owner = $this->getOwner();
        if ($this->current_lang != $this->defaultLanguage) {
            $owner->getDbCriteria()->with = array($this->relation => array("condition" => "lang_id='$lang'"));
        }

        return $owner;
    }

    public function afterFind($event) {
        $owner = $this->getOwner();
        if ($this->current_lang != $this->defaultLanguage) {
            $relation = $owner->getRelated($this->relation);
           
            foreach ($this->localizedAttributes as $attr) {
                
                $owner->$attr = $relation[0]->$attr;
            }
        }


        parent::afterFind($event);
    }

}

?>