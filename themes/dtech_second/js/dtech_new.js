var dtech_new = {
    popupStatus: 0,
    is_filter: "",
    mouse_is_inside: false,
    loadPopup: function() {
        if (dtech_new.popupStatus == 0) { // if value is 0, show popup
            dtech_new.closeloading(); // fadeout loading
            jQuery("#toPopup").fadeIn(0500); // fadein popup div
            jQuery("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
            jQuery("#backgroundPopup").fadeIn(0001);
            dtech_new.popupStatus = 1; // and set value to 1
        }
    },
    disablePopup: function() {
        if (dtech_new.popupStatus == 1) { // if value is 1, close popup
            jQuery("#toPopup").fadeOut("normal");
            jQuery("#backgroundPopup").fadeOut("normal");
            dtech_new.popupStatus = 0; // and set value to 0
        }
    },
    loading: function() {
        jQuery("div.loader").show();
    },
    closeloading: function() {
        jQuery("div.loader").fadeOut('normal');
    },
    showBestSeller: function() {
        jQuery(".under_best_seller").toggle('fast');
    },
    registerCountryDropDown: function() {
        jQuery("#countries").msDropdown();
    },
    showCategoryListing: function(obj) {
        if (dtech_new.is_filter == 0) {
            window.location.href = jQuery(obj).attr("href");
        }
        else {
            hash_split = jQuery(obj).attr("href").split("#");
            hash_split = hash_split[1].split("=");
            dtech.updateProductListing(jQuery(obj).attr("href"), hash_split[1]);
        }
    },
    showtopMenu: function() {
        jQuery(".top_link_hover").parent().hover(function() {
            link_width = parseInt(jQuery(this).width()-50);
            if(link_width<=70){
                link_width = 70;
            }
            jQuery(this).children().eq(1).children().eq(0).css("margin-left",link_width);
            jQuery(this).children().eq(1).show();
            
        }, function() {
            jQuery(this).children().eq(1).children().removeAttr("style");
            jQuery(this).children().eq(1).hide();
        });
    },
    aquardinaMenu: function(obj) {
//
        if (jQuery(obj).parent().siblings().is(":visible") == false) {
            jQuery(".inner_list").hide();
            jQuery(".aquardian_img").attr("src", jQuery(".aquardian_img").attr("invisible"));
            jQuery(obj).children().eq(0).attr("src", jQuery(obj).children().eq(0).attr("visible"));
            jQuery(obj).parent().siblings().show();
            jQuery('.listing input[type=checkbox]').each(function()
            {
                this.checked = false;
            });
        }
        else {
            jQuery(obj).children().eq(0).attr("src", jQuery(obj).children().eq(0).attr("invisible"));
            jQuery(obj).parent().siblings().hide();
        }
    },
    loadCartAgain: function(ajax_url) {
        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            dataType: 'json',
            data:
                    {
                    }
        }).done(function(response) {

            jQuery("#cart").html(response._view_cart);
        });
    },
    updateCart: function(ajax_url, obj, cart_id) {
        if (jQuery(obj).val() <= 0)
        {
            dtech.custom_alert('Qauntity Can not be zero');
            window.location.reload();
        }
        else
        {
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                dataType: 'json',
                async: false,
                data:
                        {
                            'quantity': jQuery(obj).val(),
                            'type': 'update_quantity',
                            'from': 'main',
                            'cart_id': cart_id
                        }
            }).done(function(response) {

                jQuery("#cart_control").html(response._view_cart);
                if (typeof(response._view_main_cart)) {
                    jQuery("#cart_container").html(response._view_main_cart);
                }
                if (jQuery(".grand_total_bag").length > 0) {
                    jQuery(".grand_total_bag").html(jQuery(".grand_total").html());
                }
            });
        }
    },
    /**
     * update main cart content 
     * @param {type} ajax_url
     * @param {type} obj
     * @param {type} cart_id
     * @returns {undefined}
     */
    updateMainCartPage: function(ajax_url, obj, cart_id) {

        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            dataType: 'json',
            async: false,
            data:
                    {
                        'quantity': jQuery(obj).val(),
                        'type': 'main',
                        'cart_id': cart_id
                    }
        }).done(function(response) {

            jQuery("#cart_container").html(response._view_cart);
        });
    },
    /**
     *  load oer lay funciton
     * @returns {undefined}
     */
    loadWaitmsg: function() {
        jQuery("#load_subpanel_div").remove();
        var load_div = '<div id="load_subpanel_div" class="overlay2" style="display:none">' +
                '<div class="loadingBar">' +
                '<span class="lodingString">Please Wait....</span><span class="loading">. . . .</span>' +
                '</div>' +
                '</div>';
        //jQuery("#loading").show();
        rite_html = jQuery("#main_features_part").html();
        jQuery("#main_features_part").html(load_div + rite_html);
    },
    showPaymentMethods: function(obj) {
        if (jQuery(obj).val() == "Credit Card") {

            jQuery(".credit_card_fields").show();
        }
        else {
            jQuery(".credit_card_fields").hide();
        }

    },
    showCartBox: function(obj) {
        jQuery(".login_bx").hide();
        if (jQuery(".cart_bx").is(":visible") == false) {

            dtech_new.mouse_is_inside = true;
            jQuery(".cart_bx").show();
            jQuery(".cart_arrow img").attr("src", jQuery(".cart_arrow img").attr("hover"));
            jQuery(".search_img").css("z-index", "-1");
            jQuery(".cart_bx").show();
        }
        else {
            jQuery(".cart_arrow img").attr("src", jQuery(".cart_arrow img").attr("unhover"));
            jQuery(".search_img").css("z-index", "10");
            jQuery(".cart_bx").hide();
        }

        jQuery('.cart_bx').hover(function() {
            dtech_new.mouse_is_inside = true;
        }, function() {
            dtech_new.mouse_is_inside = false;
        });
        jQuery("body").click(function() {
            if (!dtech_new.mouse_is_inside)
                jQuery(".cart_bx").hide();
            if (jQuery(".cart_bx").is(":visible") == false) {
                jQuery(".cart_arrow img").attr("src", jQuery(".cart_arrow img").attr("unhover"));
            }

        });
    },
    showLoginBox: function(obj) {
        jQuery(".cart_bx").hide();
        jQuery(".cart_arrow img").attr("src", jQuery(".cart_arrow img").attr("unhover"));
        if (jQuery(".login_bx").is(":visible") == false) {
            dtech_new.mouse_is_inside = true;
            jQuery(".login_bx").show();
        }
        else {

            jQuery(".login_bx").hide();
        }
    },
    /**
     *  hiding the box
     *  where ever click
     * @returns {undefined}
     */
    hideLoginBox: function() {

        jQuery('.login_bx').hover(function() {
            dtech_new.mouse_is_inside = true;
        }, function() {
            dtech_new.mouse_is_inside = false;
        });
        jQuery("body").click(function() {
            if (!dtech_new.mouse_is_inside)
                jQuery(".login_bx").hide();
        });
    },
    fillFeaturedBox: function(obj) {

        jQuery(".feature_btn").attr("class", "feature_btn");
        jQuery(obj).attr("class", "featured_btn_selected feature_btn");
        dtech_new.loadWaitmsg();
        jQuery("#load_subpanel_div").show();
        ajax_url = jQuery(obj).attr("url");
        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            async: false,
            data:
                    {
                        'value': jQuery(obj).val(),
                    }
        }).done(function(response) {
            jQuery(".featured_box").html(response);
            jQuery("#load_subpanel_div").remove();
        });
    },
    changeLang: function(obj) {
        jQuery("#lang_h").val(jQuery(obj).attr("lang"));
        jQuery("#lang_change_form").submit();
    },
    /**
     * slider js code for home page of website
     */
    makeSlider: function() {
        $(".banner_dots a").click(function() {
            elem_id = $(this).attr("id").replace("cs-button-coin-", "");
            $(".banner_slider").hide();
            $(".banner_dots a").attr("class", "cs-button-coin");
            $("#banner_slider_" + elem_id).show('slow');
            $("#banner_slider_" + elem_id + " #cs-button-coin-" + elem_id).attr("class", "cs-button-coin cs-active");
        });
        setInterval(function() {
            var visible_id = "";
            var counter_id = 1;
            $(".banner_slider").each(function() {
                if ($(this).is(":visible")) {
                    visible_id = $(this).attr("id");
                }
            })

            if ($("#" + visible_id).next().length != 0) {

                $("#" + visible_id).hide();
                $("#" + visible_id).next().show('slow');
                counter_id = visible_id.replace("banner_slider_", "");
                next_counter_id = $("#" + visible_id).next().attr("id").replace("banner_slider_", "");
                current_vis = $("#" + visible_id).next().attr("id");
                $(".banner_dots a").attr("class", "cs-button-coin");
                $("#" + current_vis + " #cs-button-coin-" + counter_id).attr("class", "cs-button-coin");
                $("#" + current_vis + " #cs-button-coin-" + next_counter_id).attr("class", "cs-button-coin cs-active");
            }
            else {
                $("#" + visible_id).hide();
                $("#banner").children().eq(0).show('slow');
                counter_id = visible_id.replace("banner_slider_", "");
                next_counter_id = $("#banner").children().eq(0).attr("id").replace("banner_slider_", "");
                current_vis = $("#banner").children().eq(0).attr("id");
                $(".banner_dots a").attr("class", "cs-button-coin");
                $("#" + current_vis + " #cs-button-coin-" + counter_id).attr("class", "cs-button-coin");
                $("#" + current_vis + " #cs-button-coin-" + next_counter_id).attr("class", "cs-button-coin cs-active");
            }

        }, slider_timings * 1000);
    }
}