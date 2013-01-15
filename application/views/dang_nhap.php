<html>
<head>
    <meta charset="utf-8"/>
    <?php echo link_tag('assets/css/style.css'); ?>
    <title>Đăng nhập</title>
</head>
<body>
<div class="container">
    <div class="log-in">
        <form method="post" action="<?php echo base_url()?>index.php/home/login">
            <table>
                <tr>
                    <td colspan="2"><p class="center-align"><img src="<?php echo base_url()?>assets/img/user.png"/></p></td>
                </tr>
                <tr>
                    <td><label for="username">Tên đăng nhập: </label></td>
                    <td><input type="text" id="username" name="username"/></td>
                </tr>
                <tr>
                    <td><label for="password">Mật khẩu: </label></td>
                    <td><input type="password" id="password" name="password"/></td>
                </tr>
                <tr>
                    <td colspan="2"><p class="center-align"><input type="submit" value="Đăng nhập" class="btn"/></p></td>
                </tr>
                <?php if($sai_mk == 1) { ?>
                <tr>
                    <td colspan="2"><p class="center-align red">Sai mật khẩu</p></td>
                </tr>
                <?php } ?>
            </table>
        </form>
    </div>
</div>
</body>
</html>