<!DOCTYPE html>
<html lang="en">
<head>
<link href="<?php echo base_url(); ?>assets/error/error_db.png" rel="shortcut icon" />  
<title>Error</title>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/js/plugins/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#report').click(function(){
            $('#loading').show();
            $.ajax({
                url : $(this).attr('href'),
                success : function(msg){
                    $('#notification').text(msg);
                    $('#loading').hide();
                }
            })
            return false;
        });
    });
</script>
<style type="text/css">
@import url('<?php echo base_url(); ?>templates/fonts/roboto.css');

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
    background: #f8f8f8 url("<?php echo base_url(); ?>templates/images/patternbg.png") repeat scroll 0 0;
	margin: 40px;
	font: 13px/20px 'RobotoCondensed',Arial,Helvetica,sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #933;
	background-color: transparent;
	font-size: 32px;
	font-weight: normal;
	margin: 14px 0 14px 0;
	padding: 14px 15px 10px 15px;
    text-align: center;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 100px auto;
    width: 70%;
    display: block;
}

#container .bug-icon{
    float: left;
    width: 256px;
    height: 256px;
    display: block;
    background-image: url(<?php echo base_url(); ?>assets/error/error_db.png);
}

#container .msg{
    float: left;
	font-size: 21px;
	font-weight: normal;
}

#container .msg .oops-icon{
    margin-bottom: 30px;
    width: 450px;
    height: 150px;
    display: block;
    background-image: url(<?php echo base_url(); ?>assets/error/oops.png);
}

#container .msg .message{
    width: 470px;
    display: block;
}

p {
	margin: 12px 15px 12px 15px;
}


.myButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #f7c5c0;
	-webkit-box-shadow:inset 0px 1px 0px 0px #f7c5c0;
	box-shadow:inset 0px 1px 0px 0px #f7c5c0;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #fc8d83), color-stop(1, #e4685d));
	background:-moz-linear-gradient(top, #fc8d83 5%, #e4685d 100%);
	background:-webkit-linear-gradient(top, #fc8d83 5%, #e4685d 100%);
	background:-o-linear-gradient(top, #fc8d83 5%, #e4685d 100%);
	background:-ms-linear-gradient(top, #fc8d83 5%, #e4685d 100%);
	background:linear-gradient(to bottom, #fc8d83 5%, #e4685d 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fc8d83', endColorstr='#e4685d',GradientType=0);
	background-color:#fc8d83;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #d83526;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #b23e35;
    float: left;
}

.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #e4685d), color-stop(1, #fc8d83));
	background:-moz-linear-gradient(top, #e4685d 5%, #fc8d83 100%);
	background:-webkit-linear-gradient(top, #e4685d 5%, #fc8d83 100%);
	background:-o-linear-gradient(top, #e4685d 5%, #fc8d83 100%);
	background:-ms-linear-gradient(top, #e4685d 5%, #fc8d83 100%);
	background:linear-gradient(to bottom, #e4685d 5%, #fc8d83 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e4685d', endColorstr='#fc8d83',GradientType=0);
	background-color:#e4685d;
}

.myButton:active {
	position:relative;
	top:1px;
}

</style>
</head>
<body>
	<div id="container">
        <div class="bug-icon"></div>
        <div class="msg">
    		<div class="oops-icon"></div>
            <div class="message">
        		<?php echo $message; ?>
            </div>
        </div>
        <a id="report" href="<?php echo base_url(); ?>/send_email?type=db&url=<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" class="myButton">Send Report</a>
        <img src="<?php echo base_url(); ?>/assets/images/loader.gif" style="float: left; margin: 10px; display: none;" id="loading" />
        <span style="float: left; margin: 10px;" id="notification"></span>
	</div>
</body>
</html>