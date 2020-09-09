jQuery(document).ready(function(){
    window.addEventListener("message", function(event) {
        if (event.data && event.data.code != "") {
            document.getElementById('opensocialshare_share_settings_interface_script').value = encodeURIComponent(event.data.code);
            var b = jQuery('#adminForm').serialize();
            jQuery.post(jQuery('#adminForm').attr('href'), b).error(
                function() {
                    console.log('error');
                }).success(function() {
                console.log('success');
            });
        }
    }, false); 
});

 /**
 * @param elem
 */
function ossHorizontalRearrangeProviderList(elem) {
    if (elem.checked) {
        var ul = '<li title="'+elem.value+'" id="osshorizontal_' + elem.value.toLowerCase().replace(/\ /gi,'').replace(/\+/gi,'')+'" class="ossshare_iconsprite32 ossshare_' + elem.value.toLowerCase().replace(/\ /gi,'').replace(/\+/gi,'')+'"><input type="hidden" name="horizontal_rearrange[]" value="'+elem.value+'"></li>';
        jQuery('#horsortable').append(ul);
    }
    else {
    if (jQuery('#osshorizontal_' + elem.value.toLowerCase().replace(/\ /gi,'').replace(/\+/gi,''))) {
        jQuery('#osshorizontal_' + elem.value.toLowerCase().replace(/\ /gi,'').replace(/\+/gi,'')).remove();
        }
    }
}

/**
 * @param elem
 */
function ossVerticalRearrangeProviderList(elem) {
    if (elem.checked) {
        var ul = '<li title="'+elem.value+'" id="ossvertical_' + elem.value.toLowerCase().replace(/\ /gi,'').replace(/\+/gi,'')+'" class="ossshare_iconsprite32 ossshare_' + elem.value.toLowerCase().replace(/\ /gi,'').replace(/\+/gi,'')+'"><input type="hidden" name="vertical_rearrange[]" value="'+elem.value+'"></li>';
        jQuery('#versortable').append(ul);
    }
    else {
        if (jQuery('#ossvertical_' + elem.value.toLowerCase().replace(/\ /gi,'').replace(/\+/gi,''))) {
            jQuery('#ossvertical_' + elem.value.toLowerCase().replace(/\ /gi,'').replace(/\+/gi,'')).remove();
        }
    }
}

/**
 * @param elem
 */
function ossVerticalSharingLimit(elem) {
    var provider = $("#sharevprovider").find(":checkbox");
    var checkCount = 0;
    for (var i = 0; i < provider.length; i++) {
        if (provider[i].checked) {
            // count checked providers
            checkCount++;
            if (checkCount >= 10) {
                elem.checked = false;
                $("#ossVerticalSharingLimit").show('slow');
                setTimeout(function () {
                    $("#ossVerticalSharingLimit").hide('slow');
                }, 5000);
                return;
            }
        }
    }
}

/**
 * @param elem
 */
function ossHorizontalSharingLimit(elem) {
    var provider = $("#sharehprovider").find(":checkbox");
    var checkCount = 0;
    for (var i = 0; i < provider.length; i++) {
        if (provider[i].checked) {
            // count checked providers
            checkCount++;
            if (checkCount >= 10) {
                elem.checked = false;
                $("#ossHorizontalSharingLimit").show('slow');
                setTimeout(function () {
                    $("#ossHorizontalSharingLimit").hide('slow');
                }, 5000);
                return;
            }
        }
    }
}

/**
 * select counter in checkbox and rearrange
 */
function createHorzontalShareProvider() {
    jQuery('#osshorizontalshareprovider,#osshorizontalsharerearange').show();
    jQuery('#osshorizontalcounterprovider').hide();
}

/**
 * single image in provider
 */
function singleImgShareProvider() {
    jQuery('#osshorizontalshareprovider,#osshorizontalsharerearange,#osshorizontalcounterprovider').hide();
}

/**
 * select counter in checkbox
 */
function createHorizontalCounterProvider() {
    jQuery('#osshorizontalcounterprovider').show();
    jQuery('#osshorizontalsharerearange,#osshorizontalshareprovider').hide();
}

/**
 * select vertical sharing provider in checkbox
 */
function createVerticalShareProvider() {
    jQuery('#ossverticalshareprovider,#ossverticalsharerearange').show();
    jQuery('#ossverticalcounterprovider').hide();
}

/**
 * select counter in checkbox
 */
function createVerticalCounterProvider() {
    jQuery('#ossverticalcounterprovider').show();
    jQuery('#ossverticalsharerearange,#ossverticalshareprovider').hide();
}

/**
 * select vertical interface in sharing
 */
function makeVerticalVisible() {
    jQuery('#sharevertical').show();
    jQuery('#sharehorizontal,#shareadvance').hide();
    jQuery('#arrow').addClass("vertical");
    jQuery('#arrow').removeClass("advance");
    jQuery('#arrow').removeClass("horizontal");
    jQuery('#mymodal3').css("color", "#00CCFF");
    jQuery('#mymodal1, #mymodal2').css("color", "#000000");
}

/**
 * select horizontal interface in sharing
 */
function makeHorizontalVisible() {
    jQuery('#sharehorizontal').show();
    jQuery('#sharevertical,#shareadvance').hide();
    jQuery('#arrow').removeClass("vertical");
    jQuery('#arrow').removeClass("advance");
    jQuery('#arrow').addClass("horizontal");
    jQuery('#mymodal2').css("color", "#00CCFF");
    jQuery('#mymodal1,#mymodal3').css("color", "#000000");
}
/**
 * select advance interface in sharing
 */
function makeAdvanceVisible() {
    jQuery('#shareadvance').show();
    jQuery('#sharevertical,#sharehorizontal').hide();
    jQuery('#arrow').removeClass("vertical");
    jQuery('#arrow').removeClass("horizontal");
    jQuery('#arrow').addClass("advance");
    jQuery('#mymodal1').css("color", "#00CCFF");
    jQuery('#mymodal2,#mymodal3').css("color", "#000000");
}
jQuery(document).ready(function(){
    articalType('horizontal');
    articalType('vertical');
    jQuery('input[name="settings[horizontalarticaltype]"]').click(function(){
        articalType('horizontal');
    });
    jQuery('input[name="settings[verticalarticaltype]"]').click(function(){
        articalType('vertical');
    });
});

function articalType(shareTheme){
    if(jQuery('input[name="settings['+shareTheme+'articaltype]"]:checked').val() == '0'){
        jQuery('#'+shareTheme+'Articles').show();
    }else{
        jQuery('#'+shareTheme+'Articles').hide();
    }
}