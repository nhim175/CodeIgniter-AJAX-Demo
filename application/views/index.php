<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8"/>
	<title>Quản lý nhân viên</title>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>    
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/function.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery-ui-1.8.23.custom.css"/>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css"/>
</head>

<body>
<div class="log-out"><a href="<?php echo base_url()?>index.php/home/logout" title="Đăng xuất">Đăng xuất</a></div>
<div class="window" id="phongBanWindow">
</div>
<div class="window" id="nhanVienWindow">
</div>
<script type="text/javascript">
$.post('<?php echo base_url() ?>index.php/home/load_phongban',{}, function(data) {
    $('#phongBanWindow').html(data);
});
$.post('<?php echo base_url() ?>index.php/home/load_nhanvien',{}, function(data) {
    $('#nhanVienWindow').html(data);
});

var zIndex = 1;
$(".window").live("mousedown", function() {
    $(this).css("z-index",zIndex++);
    $(".window").css({"opacity": 0.7, "box-shadow": "0px 0px 0px #FFF"});
    $(this).css({"opacity": 1, "box-shadow": "0px 0px 50px #555"});
});
</script>
</body>
</html>