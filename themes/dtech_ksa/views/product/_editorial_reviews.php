<h2><?php echo Yii::t('product_detail', 'Product Description', array(), NULL, $this->currentLang); ?></h2>
<div 
    class="border_detail" 
    >
    <p dir="<?php echo Yii::app()->params['text_position'][$this->currentLang]; ?>"><?php echo $product->product_description; ?></p></div>
