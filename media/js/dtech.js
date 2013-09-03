// JavaScript Document
var dtech = {
    old_drop_val: "",
    getmultiplechecboxValue: function(elem_id) {
        var sel_ar = new Array();
        $("." + elem_id).each(function() {
            if ($(this).is(':checked')) {
                sel_ar.push($(this).val());
            }
        })
        return sel_ar.join(",");

    },
    updateProductListing: function(ajax_url, id) {

        var load_div = '<div id="load_subpanel_div" class="overlay" style="display:none">' +
                '<div class="loadingBar">' +
                '<span class="lodingString">Please Wait....</span><span class="loading">. . . .</span>' +
                '</div>' +
                '</div>';

        //$("#loading").show();
        rite_html = $("#right_main_conent").html();
        $("#right_main_conent").html(load_div + rite_html);
        $("#load_subpanel_div").show();



        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            data:
                    {
                        cat_id: id,
                        ajax: 1,
                        categories: dtech.getmultiplechecboxValue("filter_checkbox"),
                        author: dtech.getmultiplechecboxValue("author_checkbox"),
                        langs: dtech.getmultiplechecboxValue("lang_checkbox"),
                    }
        }).done(function(msg) {
            $("#right_main_conent").html(msg);

            if (id != "") {
                // s_url = "cat=" + id;
                // dtech.updatehashBrowerUrl(s_url);
                // dtech.updateCategoryStatus(id);
            }
            else {
                // dtech.updatehashBrowerUrl("");
                // dtech.updateCategoryStatus(id);
            }

            jQuery("#load_subpanel_div").remove();
        });
        return false;
    },
    updatePaginationFilter: function(obj) {

        dtech.updateProductListing($(obj).attr("href"), "");
    },
    /*
     * 
     * For pag loading on based 
     * of
     */
    updateListingOnScrolling: function(obj) {
        var id = "";
        var ajax_url = $(obj).attr("href");

        var load_div = '<div id="load_subpanel_div" class="overlay" style="display:none">' +
                '<div class="loadingBar">' +
                '<span class="lodingString">Please Wait....</span><span class="loading">. . . .</span>' +
                '</div>' +
                '</div>';

        rite_html = $("#list_featured").html();
        $("#list_featured").html(load_div + rite_html);
        $("#load_subpanel_div").show();

        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            data:
                    {
                        cat_id: id,
                        ajax: 1,
                        author: dtech.getmultiplechecboxValue("author_checkbox"),
                        langs: dtech.getmultiplechecboxValue("lang_checkbox"),
                        categories: dtech.getmultiplechecboxValue("filter_checkbox"),
                    }
        }).done(function(msg) {
            $("#list_featured").append(msg);
            $("#list_featured")

            if (id != "") {
                s_url = "cat=" + id;
                dtech.updatehashBrowerUrl(s_url);
                dtech.updateCategoryStatus(id);
            }
            else {
                //dtech.updatehashBrowerUrl("");
                dtech.updateCategoryStatus(id);
            }

            $("#load_subpanel_div").remove();
            jQuery("#sideBarBox").hide();
            jQuery(".under_best_seller").hide();
        });
        return false;
    },
    /**
     *  detail image change on runtime
     *  click
     * @param {type} obj
     * @returns {undefined} 
     */
    detailImagechange: function(obj) {
        jQuery("#large_image").attr("src", jQuery(obj).attr("large_image"));
        jQuery("#large_image").parent().attr("href", jQuery(obj).attr("large_image"));
    },
    showdetailLightbox: function() {
        jQuery("#dummy_link").trigger("click");
    },
    doGloblSearch: function() {
        if (jQuery.trim(jQuery("#serach_field").val()) != "") {
            jQuery("#search_form").submit();
        }
    },
    updatehashBrowerUrl: function(s) {
        window.location.hash = s;
    },
    load_languageDetail: function() {

        hash_str = window.location.hash;


        if (hash_str != "") {
            hash_str = hash_str.split("=");

            if (typeof(hash_str[1]) != "undefined") {

                lang_val = dtech.findLangVal(hash_str[1]);
                //console.log(lang_val);
                jQuery("#language").val(lang_val);
                window.location.hash = "";
                jQuery("#language").trigger("change");

            }
        }

    },
    findLangVal: function(text) {
        return_lang = "";
        jQuery("#language option").each(function() {
            text = jQuery.trim(text);
            if (jQuery(this).html() == text) {
                return_lang = jQuery(this).val();

                //return jQuery(this).val();
            }
        })

        return return_lang;
    },
    /**
     *  loaded automatically using category filtering
     *  in ajax
     * @returns {undefined}
     */
    loadallPrdoucts_Cat: function(url) {
        hash_str = window.location.hash;
        /**
         * hybrid auth used hash sign
         * dats y made this check
         */
        if (hash_str == "#_=_") {
            return true;
        }
        if (hash_str != "") {
            hash_str = hash_str.split("=");

            if (typeof(hash_str[1]) != "undefined") {

                dtech.updateProductListing(url, hash_str[1]);


            }
        }
    },
    /**
     * to see which category is selected
     * @param {type} cat_id
     * @returns {undefined}
     */
    updateCategoryStatus: function(cat_id) {
        $("#category_list ul li a").each(function() {
            if ($(this).attr("id") == cat_id) {
                $(this).css("font-weight", "bold");
            }
            else {
                $(this).css("font-weight", "normal");
            }
        })
    },
    custom_alert: function(output_msg, title_msg)
    {
        jQuery(".ui-widget ui-widget-content").remove();
        if (!title_msg)
            title_msg = 'Alert';

        if (!output_msg)
            output_msg = 'No Message to Display.';

        jQuery("<div id='custom_dialoge'></div>").html(output_msg).dialog({
            title: title_msg,
            resizable: false,
            modal: true,
            open: function(event, ui) {
                setTimeout(function() {
                    jQuery(".ui-button").trigger("click");
                }, 3000);

            },
            buttons: {
                "Ok": function()
                {
                    jQuery(this).dialog("close");
                }
            }
        });

    },
    /**
     * for redirecting to quran cate
     */
    redirectToQuranCategory: function(obj) {
        url = jQuery(obj).attr("href") + jQuery(obj).attr("cat");
        window.location.href = url;
        window.location.reload();
        return true;
    },
    showPaymentMethods: function(obj) {
        if ($(obj).val() == "1") {
            $(".pay_list").show();
            $(".credit_card_fields").hide();
            $(".manual_list").hide();
        }
        else if ($(obj).val() == "2") {
            $(".credit_card_fields").show();
            $(".pay_list").hide();
            $(".manual_list").hide();

        }
        else if ($(obj).val() == "3") {
            $(".manual_list").show();
            $(".pay_list").hide();
            $(".credit_card_fields").hide();

        }

        else {
            $(".pay_list").hide();
            $(".credit_card_fields").hide();
            $(".manual_list").hide();
        }

    },
    isNumber: function(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    },
    changeAdminCity: function(url, obj) {
        window.location.href = url + "?change_city_id=" + $(obj).val();
    },
    showProductChildren: function(obj) {

        if (confirm("Your Child data will be lost in case of doing , are you sure you want to do this")) {
            $("#productProfile").hide();
            $("#other").hide();
            $("#educationToys").hide();
            $("#quranProfile").hide();
            $(".grid_fields").remove();

            //dtech.old_drop_val = $(obj).val();

            if ($("#Product_parent_cateogry_id option:selected").text() == "Others") {
                $("#other").show();
                $("#other .plus_bind").trigger('click');
            }
            else if ($("#Product_parent_cateogry_id option:selected").text() == 'Books') {
                $("#productProfile").show();
                $("#productProfile .plus_bind").trigger('click');
            }
            else if ($("#Product_parent_cateogry_id option:selected").text() == 'Educational Toys') {
                $("#educationToys").show();
                $("#educationToys .plus_bind").trigger('click');
            }
            else if ($("#Product_parent_cateogry_id option:selected").text() == 'Quran') {
                $("#quranProfile").show();
                $("#quranProfile .plus_bind").trigger('click');
            }
            else {
                $("#other").show();
                $("#other .plus_bind").trigger('click');
            }
        }
        else {
            $(obj).val(dtech.old_drop_val);
            return false;
        }
    },
    preserveOldVal: function(obj) {
        dtech.old_drop_val = $(obj).val();

    },
    /**
     * to update element on ajax all
     * @param {type} ajax_url
     * @param {type} update_element_id
     * @param {type} resource_elem_id
     * @returns {undefined}
     */
    updateElementAjax: function(ajax_url, update_element_id, resource_elem_id) {

        if (jQuery("#" + resource_elem_id).val() != "") {
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                async: false,
                data:
                        {
                            resource_elem_id: jQuery("#" + resource_elem_id).val(),
                        }
            }).done(function(response) {
                jQuery("#" + update_element_id).html(response);
            });
        }
    },
    /**
     * 
     * @param {type} ajax_url
     * @param {type} update_element_id
     * @param {type} resource_elem_id
     * @param {type} callback function
     * 
     */
    updateElementCountry: function(ajax_url, update_element_id, resource_elem_id) {
        if (jQuery("#" + resource_elem_id).val() != "") {
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data:
                        {
                            resource_elem_id: jQuery("#" + resource_elem_id).val(),
                        }
            }).done(function(response) {
                jQuery("#" + update_element_id).html(response);
                if (jQuery("#LandingModel_city").attr("type") != "hidden") {
                    //jQuery("#LandingModel_city").msDropdown();
                }

                jQuery("#country_selection_form").submit();

            });
        }
    },
    checkApplied: function(obj) {
        if (jQuery(obj).is(':checked') == true) {
            jQuery(".applied").each(function() {
                if (jQuery(obj).attr("id") != jQuery(this).attr("id")) {
                    jQuery(this).prop('checked', false);
                }
            })
        }
    },
    //
    doSocial: function(form_id, obj) {
        jQuery('#' + form_id).attr("action", jQuery(obj).attr('href'));
       
        jQuery('#' + form_id).submit();

    },
    increaseQuantity: function(obj) {
        /**
         * accessing text field
         */
        field_val = jQuery(obj).parent().prev().children().eq(0).val();
        if (field_val == "") {
            field_val = 1;
        }
        field_val = parseInt(field_val);
        field_val = field_val + 1;
        jQuery(obj).parent().prev().children().eq(0).val(field_val);
        dtech.updateShoppingBag(jQuery(obj).parent().prev().children().eq(0));

    },
    decreaseQuantity: function(obj) {
        /**
         * accessing text field
         */
        field_val = jQuery(obj).parent().prev().children().eq(0).val();
        if (field_val == "") {
            field_val = 1;
        }

        field_val = parseInt(field_val);
        field_val = field_val - 1;
        if (field_val < 0) {
            field_val = 0;
        }
        jQuery(obj).parent().prev().children().eq(0).val(field_val);
        dtech.updateShoppingBag(jQuery(obj).parent().prev().children().eq(0));
    },
    /**
     * 
     * @param {type} obj
     * @returns {undefined}
     */
    updateShoppingBag: function(field_obj) {

        field_id = field_obj.attr("id").replace("cart_list_", "");
        jQuery("#cart_bag_" + field_id).val(field_obj.val());
    },
    /* Goi to history page -1. */
    go_history: function() {
        var previous_page = document.referrer;
        window.location = previous_page;
    },
    popupwindow: function(url, title, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    },
    disabledPrview: function() {
        /*
         * disabling all the buttons and link in preview formate
         */
        jQuery(".add_to_cart_button a").attr("disabled", "disabled");
        jQuery(".add_to_wish_list").attr("disabled", "disabled");
        jQuery(".email_cart_arrow").attr("disabled", "disabled");
        jQuery(".checkout_btn").attr("disabled", "disabled");
        jQuery("#search-text").attr("disabled", "disabled");
        jQuery("#search-button").attr("disabled", "disabled");
        jQuery("body").unbind("click");
        jQuery(".button-column a").remove();

        jQuery("#quantity").remove();
        jQuery("#ProductReviews_reviews").attr("disabled", "disabled");
        jQuery("#add_comment").attr("disabled", "disabled");

        jQuery("#ratingUser").remove();

        jQuery("body").click(function(event) {
            event.preventDefault();
        })
    },
    openColorBox: function(obj) {
        jQuery(obj).colorbox({width: "60%", height: "80%", iframe: true});

    },
    openColorBoxNoIFrame: function(obj) {
        jQuery(obj).colorbox({width: "60%", height: "80%"});

    },
    /**
     * if client wants to remove one thing from slider
     * he can remove
     * @param {type} obj
     * @returns {Boolean}
     */
    removeSlider: function(obj) {
        if (confirm("Are you sure you want to remove")) {
            $.ajax({
                url: $(obj).attr('href'),
                success: function(msg) {
                    $('#uproduct-grid').yiiGridView.update('product-grid');
                }
            });

            return false;
        }
    },
    updateNotifyCheckBox: function(obj) {

        if (!jQuery(obj).prev().is(':checked')) {
            jQuery(obj).prev().trigger("click");
        }
    },
    notifyUser: function(obj) {
        if (confirm("Are you sure you want to update order status")) {
            jQuery("#loading").show();
            jQuery.ajax({
                type: "POST",
                url: jQuery(obj).attr("href"),
                async: false,
                data:
                        {
                            ajax: 1,
                            'Order[status]': jQuery(obj).parent().prev().children().eq(0).val(),
                            'Order[notifyUser]': (jQuery(obj).prev().prev().is(':checked')) ? 1 : 0,
                        }
            }).done(function(response) {
                jQuery('#order-grid').yiiGridView.update('order-grid');
                jQuery("#loading").hide();
                jQuery("#flash-message").show();
                jQuery("#flash-message").html("Order status has been updated");
            });
        }
    },
    updateOrderProductQuantity: function(obj) {
        if (confirm("Are you sure you want to update quantity")) {
            jQuery("#loading").show();
            jQuery.ajax({
                type: "POST",
                url: jQuery(obj).attr("href"),
                async: false,
                data:
                        {
                            ajax: 1,
                            'OrderDetail[quantity]': jQuery(obj).prev().val(),
                        }
            }).done(function(response) {
                if (response.search("None") == -1) {
                    jQuery('#order-detail-grid').yiiGridView.update('order-detail-grid');
                    jQuery("#loading").hide();
                    jQuery("#flash-message-order").show();
                    jQuery("#flash-message-order").html("Order Product quantity has been updated");

                    setInterval(function() {
                        jQuery("#flash-message-order").hide();

                    }, 10 * 1000);
                }
                else {
                    jQuery('#order-detail-grid').yiiGridView.update('order-detail-grid');
                    jQuery("#loading").hide();
                    jQuery("#flash-error-order").show();
                    jQuery("#flash-error-order").html("Quantity is greater than actual stock");

                    setInterval(function() {
                        jQuery("#flash-error-order").hide();

                    }, 10 * 1000);
                }

            });
        }

        return false;
    },
    printPreview: function(obj) {
        var left = (screen.width / 2) - (700 / 2);
        var top = (screen.height / 2) - (490 / 2);
        var width = (screen.width / 2) * 1.2;
        var height = (screen.height / 2);
        var str = "height=" + height + ",scrollbars=yes,width=" + width + ",status=yes,";
        str += "toolbar=no,menubar=no,location=no,resizable=false,left=" + left + ",top=" + top + "";
        window.open($(obj).attr("href"), "popup", str);
    }
}
