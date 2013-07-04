<script type="text/javascript">


    jQuery(document).ready(function() {
        //jQuery('div.read_more').slideToggle();

        jQuery('#more').click(function() {
            jQuery('div.brief').hide();
            jQuery('div.read_more').show('slow');
        });
        jQuery('#close').click(function() {
            jQuery('div.brief').show('slow');
            jQuery('div.read_more').hide();
        });


    });

</script>




<div id="description_content">

    <h1>Book Description</h1>
    <article>Release date: March 2, 2004 | Series: Wicked Years (Book 1)</article>

    <?php
    if (str_word_count($product->product_description) < 500) {
        echo CHtml::openTag('p');
        echo $product->product_description;
        echo CHtml::closeTag('p');
    } else {

        echo CHtml::openTag('div', array('class' => 'brief'));

        echo CHtml::openTag('p');
        echo substr($product->product_description, 0, 1000) . '.....';
        ?>
        <a id="more" href="javascript:void(0)">Read Detail </a>
        <?php
        echo CHtml::closeTag('p');

        echo CHtml::closeTag('div');


        echo CHtml::openTag('div', array('class' => 'read_more',"style"=>"display:none"));

        echo CHtml::openTag('p');
        echo $product->product_description;
        ?>
        <a id="close" style="" href="javascript:void(0)">Close Detail </a>
        <?php
        echo CHtml::closeTag('p');

        echo CHtml::closeTag('div');
    }
    ?>

    <h2>Product Reviews</h2>
    
    <p>
    <?php echo $product->product_overview; ?>
    </p>
    <article>Copyright 1995 Reed Business Information, Inc.</article>

</div>
