<?php

Yii::import('zii.widgets.CDetailView');
/**
 * CDetailView class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * EmailDetailView displays the detail of a single data model.
 *
 * EmailDetailView is best used for displaying a model in a regular format (e.g. each model attribute
 * is displayed as a row in a table.) The model can be either an instance of {@link CModel}
 * or an associative array.
 *
 * EmailDetailView uses the {@link attributes} property to determines which model attributes
 * should be displayed and how they should be formatted.
 *
 * A typical usage of CDetailView is as follows:
 * <pre>
 * $this->widget('EmailDetailView', array(
 *     'data'=>$model,
 *     'attributes'=>array(
 *         'title',             // title attribute (in plain text)
 *         'owner.name',        // an attribute of the related object "owner"
 *         'description:html',  // description attribute in HTML
 *         array(               // related city displayed as a link
 *             'label'=>'City',
 *             'type'=>'raw',
 *             'value'=>CHtml::link(CHtml::encode($model->city->name),
 *                                  array('city/view','id'=>$model->city->id)),
 *         ),
 *     ),
 * ));
 * </pre>
 *
 * @property CFormatter $formatter The formatter instance. Defaults to the 'format' application component.
 *
 * @author Qiang Xue <ali.abbas@darussalampk.com>
 */
class EmailDetailView extends CDetailView {

    /**
     * for alternate row in email
     * @var type 
     */
    public $alter_nateitemTemplate = "<tr class=\"{class}\" style='text-align:left;border:1px solid;background:white'><th>{label}</th><td>{value}</td></tr>\n";

    /**
     * 
     * @throws CException
     */
    public function run() {
        $formatter = $this->getFormatter();
        if ($this->tagName !== null)
            echo CHtml::openTag($this->tagName, $this->htmlOptions);

        $i = 0;
        $n = is_array($this->itemCssClass) ? count($this->itemCssClass) : 0;

        foreach ($this->attributes as $attribute) {
            if (is_string($attribute)) {
                if (!preg_match('/^([\w\.]+)(:(\w*))?(:(.*))?$/', $attribute, $matches))
                    throw new CException(Yii::t('zii', 'The attribute must be specified in the format of "Name:Type:Label", where "Type" and "Label" are optional.'));
                $attribute = array(
                    'name' => $matches[1],
                    'type' => isset($matches[3]) ? $matches[3] : 'text',
                );
                if (isset($matches[5]))
                    $attribute['label'] = $matches[5];
            }

            if (isset($attribute['visible']) && !$attribute['visible'])
                continue;

            $tr = array('{label}' => '', '{class}' => $n ? $this->itemCssClass[$i % $n] : '');
            if (isset($attribute['cssClass']))
                $tr['{class}'] = $attribute['cssClass'] . ' ' . ($n ? $tr['{class}'] : '');

            if (isset($attribute['label']))
                $tr['{label}'] = $attribute['label'];
            elseif (isset($attribute['name'])) {
                if ($this->data instanceof CModel)
                    $tr['{label}'] = $this->data->getAttributeLabel($attribute['name']);
                else
                    $tr['{label}'] = ucwords(trim(strtolower(str_replace(array('-', '_', '.'), ' ', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $attribute['name'])))));
            }

            if (!isset($attribute['type']))
                $attribute['type'] = 'text';
            if (isset($attribute['value']))
                $value = $attribute['value'];
            elseif (isset($attribute['name']))
                $value = CHtml::value($this->data, $attribute['name']);
            else
                $value = null;

            $tr['{value}'] = $value === null ? $this->nullDisplay : $formatter->format($value, $attribute['type']);

            if (strstr($this->itemCssClass[$i % $n], "even")) {
            
                $this->renderalterNateItem($attribute, $tr);
            } else {
           
                $this->renderItem($attribute, $tr);
            }


            $i++;
        }

        if ($this->tagName !== null)
            echo CHtml::closeTag($this->tagName);
    }

    /**
     * This method is used by run() to render item row
     *
     * @param array $options config options for this item/attribute from {@link attributes}
     * @param string $templateData data that will be inserted into {@link itemTemplate}
     * @since 1.1.11
     */
    protected function renderalterNateItem($options, $templateData) {
        echo strtr(isset($options['template']) ? $options['template'] : $this->alter_nateitemTemplate, $templateData);
    }

}

?>
