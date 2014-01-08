<?php
/**
 * register script jquery ui
 */
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/packages/jui/css/base/jquery-ui.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/packages/jui/js/jquery-ui.min.js');

unset($sheetData[0]);
$json_encode = CJSON::encode(array_chunk($sheetData, 50), true);
$total_length = count($sheetData);
$steps = ceil($total_length / 50);
?>

<script>

    var total_record = <?php echo $total_length; ?>;
    var total_json = <?php echo $json_encode; ?>;
    var start_status = 0;
    var end_status = 10;
    var steps = <?php echo $steps ?>;


    function insertintoDb(current) {
        jQuery("#loading").show();
        percentage = (current*100)/steps;
        jQuery("#progressbar").progressbar({
            value: percentage
        });
        if (typeof(total_json[current] != "undefined")) {
            $.ajax({
                url: "<?php echo $this->createUrl("/import/insert", 
                        array("id" => $model->id));
                    ?>",
                type: "POST",
                cache: false,
                data:
                        {
                            data: total_json[current],
                            index: current,
                            total_steps: steps,
                        },
                beforeSend: function(xhr) {
                    $("#other_status").html(start_status + " to " + end_status + " is in progress..");
                }
            }).done(function(data) {

                if (parseInt(current) + 1 == parseInt(steps)) {
                    jQuery("#loading").hide();
                    jQuery("#status").html("Page is redirecting to get files");
                    window.location = "<?php echo $this->createUrl("/import/status", array("id" => $model->id)) ?>"
                }
                else {
                    start_status = end_status + 1;
                    end_status = end_status + 10;

                }

                insertintoDb(current + 1);

            });
        }
    }

</script>
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Step 4 Start Importing</h1>
    </div>


</div>
<div class="clear"></div>
<?php
//CVarDumper::dump(array_chunk($sheetData, 50), 10, true);
?>
<h2 id="status">
    Please wait your file is uploading...
    and importing data...

</h2>
<br/>
<h2 id="other_status" style="margin-left:25px;color:black">

</h2>
<div class="clear"></div>
<div id="progressbar"></div>
<div class="form wide">
    <div class="row buttons">
        <?php echo CHtml::Button('Start', array("class" => "btn", 'onclick' => 'insertintoDb(0);$(this).hide();')); ?>
    </div>
</div><!-- form -->