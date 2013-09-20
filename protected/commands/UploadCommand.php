<?php

class UploadCommand extends CConsoleCommand {

    public function run($args) {
        $model = new Users;

        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }
        $basePath = $basePath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "user";
        $basePath = $basePath . DIRECTORY_SEPARATOR . $args[0] . DIRECTORY_SEPARATOR . $args[2];

        $file_rows = $model->getArray($basePath);

        $blockList = $this->getBlockList();

        $this->refershFiles($args[2]);

        $index = 0;

        foreach ($file_rows as $email) {

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $email_p = explode("@", $email);
                if (in_array($email_p[0], $blockList)) {
                    $this->generateCsv($email, "block.csv", $index, $args[2]);
                    echo "blocked " . $email . "--" . $index;
                } else {
                    if ($this->validateEmailBox($email)) {
                        $this->generateCsv($email, "valid.csv", $index, $args[2]);
                        echo "valid " . $email . "--" . $index;
                    } else {
                        $this->generateCsv($email, "invalid.csv", $index, $args[2]);
                        echo "invalid " . $email . "--" . $index;
                    }
                }
            } else {

                $this->generateCsv($email, "noemail.csv", $index, $args[2]);
                echo "noemail " . $email . "--" . $index;
            }
            $index++;
            echo "\n";
        }

        UploadFiles::model()->updateByPk($args[4], array("is_proccessed" => 1));
    }

    public function getBlockList() {
        $blockList = CHtml::listData(BlockList::model()->findAll(), "title", "title");
        return $blockList;
    }

    public function validateEmailBox($email) {
        try {
            $url = 'http://apps.kernelbd.com/verifier/verifymail/?email=' . $email;

            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


            //execute post
            $result = curl_exec($ch);

            if (!stristr($result, "invalid")) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 
     */
    public function generateCsv($data, $file_name, $index, $dir) {


        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }
        $dir = explode(".", $dir);
        $dir = $dir[0];
        $basePath = $basePath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "results";
        $basePath = $basePath . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;

        if (!is_dir($basePath)) {
            mkdir($basePath);
        }

        $fp = fopen($basePath . $file_name, 'a');

        fputcsv($fp, array($data));
    }

    public function refershFiles($dir) {
        $basePath = Yii::app()->basePath;

        $dir = explode(".", $dir);
        $dir = $dir[0];


        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }
        $basePath = $basePath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "results";
        $basePath = $basePath . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;

        if (!is_dir($basePath)) {
            mkdir($basePath);
        }

        $fp = fopen($basePath . "valid.csv", 'w');
        $fp = fopen($basePath . "noemail.csv", 'w');
        $fp = fopen($basePath . "invalid.csv", 'w');
        $fp = fopen($basePath . "exist.csv", 'w');
        $fp = fopen($basePath . "block.csv", 'w');
    }

}

?>
