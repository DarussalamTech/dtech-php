<?php

/**
 * Wrapper for the PHPExcel library.
 * @see README.md
 */
class XPHPExcel extends CComponent {

    private static $_isInitialized = false;

    /**
     * Register autoloader.
     */
    public static function init() {
        if (!self::$_isInitialized) {
            spl_autoload_unregister(array('YiiBase', 'autoload'));
            require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'PHPExcel.php');
            spl_autoload_register(array('YiiBase', 'autoload'));

            self::$_isInitialized = true;
        }
    }

    /**
     * Returns new PHPExcel object. Automatically registers autoloader.
     * @return PHPExcel
     */
    public static function createPHPExcel() {
        self::init();
        return new PHPExcel;
    }

    /**
     * 
     * @param type $file_path
     * @return phexcelreader
     */
    public static function loadExcelFile($file_path) {
        /**
         * Excel module area to get Columns list
         */
        ini_set('memory_limit', '512M');
        $phpExcel = self::createPHPExcel();


        $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
        $cacheSettings = array(' memoryCacheSize ' => '512MB');

        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);


        $inputFileType = PHPExcel_IOFactory::identify($file_path);

        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        $objPHPExcel = $objReader->load($file_path);



        return $objPHPExcel;
    }

}

