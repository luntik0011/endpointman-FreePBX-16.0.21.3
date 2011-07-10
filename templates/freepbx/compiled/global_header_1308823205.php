<?php if(!defined('IN_RAINTPL')){exit('Hacker attempt');}?><html>
    <head>
        <title>PBX Endpoint Configuration Manager</title>
        <?php
	if( isset($var["silent_mode"]) ){
?>
        <script type="text/javascript" src="common/libfreepbx.javascripts.js" language="javascript"></script>
        <script type="text/javascript" src="assets/endpointman/js/jquery.tools.min.js"></script>
        <script type="text/javascript" src="assets/endpointman/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="assets/endpointman/js/jquery.coda-slider-2.0.js"></script>
        <link href="common/mainstyle.css" rel="stylesheet" type="text/css" />
        <?php
	}
?>
        <?php
	if( $var["amp_ver"] < 2.9 ){
?>
        <script type="text/javascript" src="assets/endpointman/js/jquery.tools.min.js"></script>
        <script type="text/javascript" src="assets/endpointman/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="assets/endpointman/js/jquery.coda-slider-2.0.js"></script>
        <?php
	}
?>
        <style>
            .tooltip {
                display:none;
                background:transparent url('assets/endpointman/images/black_arrow.png');
                font-size:12px;
                height:70px;
                width:160px;
                padding:25px;
                color:#fff;
            }
            #spinner
            {
                display:none;
                width:200px;
                height: 200px;
                position: fixed;
                top: 40%;
                left: 55%;
                background:url('assets/endpointman/images/ajax-loader.gif') no-repeat center #fff;
                text-align:center;
                padding:10px;
                font:normal 16px Tahoma, Geneva, sans-serif;
                margin-left: -50px;
                margin-top: -50px;
                z-index:2;
                overflow: auto;
                background-color:#f8f8ff;
                border: 1px solid #aaaaff;
            }
        </style>
	<?php
	if( isset($var["template_editor_display"]) ){
?>
        <link href="assets/endpointman/theme/coda-slider-2.0a.css" media="screen, projection" rel="stylesheet" type="text/css" />

        <script type="text/javascript">
            $().ready(function() {
                $('#coda-slider-9').codaSlider({
                    dynamicArrows: false
                });
            });
        </script>
	<?php
	}
?>
	<?php
	if( isset($var["amp_conf_serial"]) ){
?>
        <script type="text/javascript" charset="utf-8">
            $(function(){
                $("select#brand_edit").change(function(){
                    $.ajaxSetup({ cache: false });
                    $.getJSON("config.php?type=tool&quietmode=1&handler=file&module=endpointman&file=ajax_select.html.php&atype=model",{id: $(this).val()}, function(j){
                        var options = '';
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
                        }
                        $("#model_new").html(options);
                        $('#model_new option:first').attr('selected', 'selected');
                        $("#template_list").html('<option></option>');
                        $('#template_list option:first').attr('selected', 'selected');
                    })
                })
            })
            $(function(){
                $("select#product_select").change(function(){
                    $.ajaxSetup({ cache: false });
                    $.getJSON("config.php?type=tool&quietmode=1&handler=file&module=endpointman&file=ajax_select.html.php&atype=template",{id: $(this).val()}, function(j){
                        var options = '';
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
                        }
                        $("#template_selector").html(options);
                        $('#template_selector option:first').attr('selected', 'selected');
                    })
                })
            })
            $(function(){
                $("select#model_new").change(function(){
                    $.ajaxSetup({ cache: false });
                    $.getJSON("config.php?type=tool&quietmode=1&handler=file&module=endpointman&file=ajax_select.html.php&atype=template2",{id: $(this).val()}, function(j){
                        var options = '';
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
                        }
                        $("#template_list").html(options);
                        $('#template_list option:first').attr('selected', 'selected');
                    }),
                    $.ajaxSetup({ cache: false });
                    $.getJSON("config.php?type=tool&quietmode=1&handler=file&module=endpointman&file=ajax_select.html.php&atype=lines",{id: $(this).val()}, function(j){
                        var options = '';
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
                        }
                        $("#line_list").html(options);
                        $('#line_list option:first').attr('selected', 'selected');
                    })
                })
            })

            $(function(){
                $("select#brand_list_selected").change(function(){
                    $.ajaxSetup({ cache: false });
                    $.getJSON("config.php?type=tool&quietmode=1&handler=file&module=endpointman&file=ajax_select.html.php&atype=model",{id: $(this).val()}, function(j){
                        var options = '';
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
                        }
                        $("#model_list_selected").html(options);
                        $('#model_list_selected option:first').attr('selected', 'selected');
                    })
                })
            })
            $(function(){
                $("select#model_class").change(function(){
                    $.ajaxSetup({ cache: false });
                    $.getJSON("config.php?type=tool&quietmode=1&handler=file&module=endpointman&file=ajax_select.html.php&atype=model_clone",{id: $(this).val()}, function(j){
                        var options = '';
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
                        }
                        $("#model_clone").html(options);
                        $('#model_clone option:first').attr('selected', 'selected');
                    })
                })
            })

            function toggleDisplay(tbl, tblClass, rowClass) {
                if($("#img"+rowClass).attr("src") == 'assets/endpointman/images/bullet_plus.png') {
                    $("#img"+rowClass).attr("src", "assets/endpointman/images/bullet_minus.png");
                    $("#img2"+rowClass).attr("src", "assets/endpointman/images/collapse.png");
                    $("#img3"+rowClass).attr("src", "assets/endpointman/images/collapse.png");
                    $('.'+rowClass).show();
                } else {
                    $("#img"+rowClass).attr("src", "assets/endpointman/images/bullet_plus.png");
                    $("#img2"+rowClass).attr("src", "assets/endpointman/images/expand.png");
                    $("#img3"+rowClass).attr("src", "assets/endpointman/images/expand.png");
                    $('.'+rowClass).hide();
                }
            }
            
        </script>
	<?php
	}
?>
    </head>
    <body face="Arial">
        <div id="spinner">
        </div>
        <br>
        <h1><face="Arial"><center><?=_('End Point Configuration Manager')?></center></h1>
        <hr>