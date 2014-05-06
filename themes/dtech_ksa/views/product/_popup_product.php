<div id="toPopup"> 
    <div class="close"></div>
    <div id="popup_content">
        <p>
            <?php
            echo CHtml::image($image, '', array('width' => '281px', 'height' => '450px'));
            ?>
        </p>
        <div class="para">
            <h6>Friendship</h6>
            <div class="main_div">
                <div class="left_para">
                    <p>Select Option</p>
                </div>
                <div class="right_para">
                    <select>
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="main_div">
                <div class="left_para">
                    <p>Sale Price</p>
                </div>
                <div class="right_para">
                    <p>SAR 30.00</p>
                </div>
            </div>
            <div class="main_div">
                <div class="left_para">
                    <p>Author:</p>
                </div>
                <div class="right_para">
                    <p>Abdul Malik Mujahid</p>
                </div>
            </div>
            <div class="main_div">
                <div class="left_para">
                    <p>Language:</p>
                </div>
                <div class="right_para">
                    <p>English</p>
                </div>
            </div>
            <div class="main_div">
                <div class="left_para">
                    <p>ISBN No.:</p>
                </div>
                <div class="right_para">
                    <p>9960-897-59-1</p>
                </div>
            </div>
            <div class="main_div">
                <div class="left_para">
                    <p>Availability:</p>
                </div>
                <div class="right_para">
                    <p>Yes</p>
                </div>
            </div>
            <div class="main_div">
                <div class="left_para">
                    <p>Category</p>
                </div>
                <div class="right_para">
                    <p>Stories</p>
                </div>
            </div>
            <div class="main_div">
                <div class="left_para">
                    <p>Enter Qunatity</p>
                </div>
                <div class="right_para">
                    <select>
                        <option>1</option>
                    </select>
                </div>
            </div>
            <div class="main_div">
                <div class="add_to_cart_for_books">
                    <input type="button" value="Add to Cart >" class="add_to_cart_books_arrow" />
                    <a onclick="dtech.doSocial('login-form', this);
                            return false;"  href="<?php echo $this->createUrl('/web/hybrid/login/', array("provider" => "facebook")); ?>">
                           <?php
                           echo CHtml::image(Yii::app()->theme->baseUrl . "/images/f_imgs_03.png");
                           ?>
                    </a>
                    <a onclick="dtech.doSocial('login-form', this);
                            return false;"  href="<?php echo $this->createUrl('/web/hybrid/login/', array("provider" => "twitter")); ?>">
                           <?php
                           echo CHtml::image(Yii::app()->theme->baseUrl . "/images/bird_img_03.png");
                           ?>
                    </a>
                    <a onclick="dtech.doSocial('login-form', this);
                            return false;"  href="<?php echo $this->createUrl('/web/hybrid/login/', array("provider" => "google")); ?>">
                           <?php
                           echo CHtml::image(Yii::app()->theme->baseUrl . "/images/p_img_03.png");
                           ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>