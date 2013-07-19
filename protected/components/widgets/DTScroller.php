<?php

/*
 * scrolling based page loading 
 * extention 
 */


class DTScroller extends CLinkPager {

    public $ajax = false;
    public $jsMethod = "";

    /**
     * only in case when u have to append extra param
     * @var type 
     */
    public $append_param;
    
    public function init() {
        Yii::app()->clientScript->registerScript('DTScroller', '
            

        jQuery(window).scroll(function() {
        
        pos = $("#right_main_content div.featured_books").last().position();
        top =Math.floor(pos[\'top\']);
        top = top - 500;
       
        console.log($(window).scrollTop()+"==="+Math.floor(pos[\'top\']-500));
                if($(window).scrollTop() == $(document).height() - $(window).height()) {
            console.log("ubaid khaliq");
                nextelem = jQuery(".yiiPager li.selected").next().children().eq(0);
                nextelem.trigger("click");
                jQuery(".yiiPager li.selected").attr("class", "page");
                jQuery(nextelem).parent().attr("class", "page selected");
            }

           
        
    })');
        
        parent::init();
    }

    public function createPageButton($label, $page, $class, $hidden, $selected) {
        if ($this->ajax == true) {
            if ($hidden || $selected) {
                $class.=' ' . ($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);
            }
            $htmlOptions = array();
            if ($this->jsMethod != "") {
                $htmlOptions = array("onclick" => $this->jsMethod);
            }
            $pageUrl = $this->createPageUrl($page);
            /**
             * extra param will be append
             */
            if (!empty($this->append_param)) {
                $this->append_param = utf8_decode($this->append_param);
                if (strstr($pageUrl, "?")) {
                    $pageUrl.= "&" . $this->append_param;
                } else {
                    $pageUrl.= "?" . $this->append_param;
                }
            }
            return '<li   class="' . $class . '">' . CHtml::link($label, $pageUrl, $htmlOptions) . '</li>';
        } else {
            return parent::createPageButton($label, $page, $class, $hidden, $selected);
        }
    }

}

?>
