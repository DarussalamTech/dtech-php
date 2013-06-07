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
        rite_html = $("#right_main_content").html();
        $("#right_main_content").html(load_div + rite_html);
        $("#load_subpanel_div").show();

        url_hash = window.location.hash;

        if (id == "" && id != "all" && url_hash != "") {
            url_hash = url_hash.split("=");
            if (url_hash[0] == "#cat") {
                id = url_hash[1];
            }
        }
        /**
         * in case of all id will be nul
         */
        if (id == "all") {
            id = "";
        }

        $.ajax({
            type: "POST",
            url: ajax_url,
            data:
                    {
                        cat_id: id,
                        ajax: 1,
                        author: $("#author_id").val(),
                        langs: dtech.getmultiplechecboxValue("filter_checkbox"),
                    }
        }).done(function(msg) {
            $("#right_main_content").html(msg);

            if (id != "") {
                s_url = "cat=" + id;
                dtech.updatehashBrowerUrl(s_url);
                dtech.updateCategoryStatus(id);
            }
            else {
                dtech.updatehashBrowerUrl("");
                dtech.updateCategoryStatus(id);
            }

            //$("#loading").hide();
        });
        return false;
    },
    updatePaginationFilter: function(obj) {
        dtech.updateProductListing($(obj).attr("href"), "");
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
                data:
                        {
                            resource_elem_id: jQuery("#" + resource_elem_id).val(),
                        }
            }).done(function(response) {
                jQuery("#" + update_element_id).html(response);
            });
        }
    },
}
