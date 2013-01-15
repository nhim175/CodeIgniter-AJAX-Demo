<div class="title-bar">
    <span class="left"></span>
    <h2>Phòng ban</h2>
    <span class="right"></span>
</div>
<div class="content">
    <div class="table-wrapper-wrapper">
        <div class="table-wrapper">
            <div class="table">
                <table id="positionList" class="list">
                    <tr class="form">
                        <td colspan="2"><input type="text" name="position" id="position" placeholder="Phòng ban"/></td>
                        <td><input type="button" onclick="addPosition()" value="ADD"/></td>
                    </tr>
                    <tr>
						<th>ID</th>
                        <th>Phòng ban</th>
                        
                    </tr>
                    
                    <?php 
                    foreach ($phong_ban as $p) {?>
                    <tr>
                        <td class="id"><?php echo $p->pb_id; ?></td>
                        <td class="name"><?php echo $p->ten; ?></td>
                        <td>
                            <a href="#" class="edit editPosition button">Edit</a>
                            <a href="#" class="update updatePosition button">Update</a>
                            <a href="#" class="delete deletePosition button">Delete</a>
                            <a href="#" class="show showPosition button active">
                                <img src="<?php echo base_url(); ?>assets/css/images/form-account.png"/>
                                <span class="balloon" id="balloon<?php echo $p->pb_id; ?>" style="display: none;">
                                    <span class="quote"></span>
                                </span>
                            </a>
                            
                            <input name="id" type="hidden" value="<?php echo $p->pb_id; ?>"/>
                        </td>
                    </tr>
                    <?php    
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$("a.editPosition").live("click", function() {
    if($(this).parent().parent().find("td.name").children().length>0) {
        return false;
    }
    var id = $(this).parent().parent().find("td.id").html();
    var name = $(this).parent().parent().find("td.name").html();
    $(this).parent().parent().find(".id").html("<input type='text' value='"+id+"'/>");
    $(this).parent().parent().find(".name").html("<input type='text' value='"+name+"'/>");  
});
$("a.updatePosition").live("click", function() {
    if($(this).parent().parent().find("td.name").children().length==0) {
        return false;
    }
    var name = $(this).parent().parent().find("td.name input").val();
    var id = $(this).parent().find("input").val();
    $.post('<?php echo base_url() ?>index.php/home/update_phongban', {id: id, name: name});
    $(this).parent().parent().find(".id").html(id);
    $(this).parent().parent().find(".name").html(name);      
    $.post('<?php echo base_url() ?>index.php/home/load_phongban',{}, function(data) {
        $('#phongBanWindow').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/home/load_nhanvien',{}, function(data) {
        $('#nhanVienWindow').html(data);
    });
});
$("a.deletePosition").live("click", function() {
    var r = confirm("Bạn có chắc chắn muốn xóa không?");
    if(r==false) {
        return false;
    }
    var id = $(this).parent().find("input").val();
    $.post('<?php echo base_url() ?>index.php/home/delete_phongban', {id: id});
    $(this).parent().parent().fadeOut(500, function() {
        $(this).remove();
    });     
    $.post('<?php echo base_url() ?>index.php/home/load_phongban',{}, function(data) {
        $('#phongBanWindow').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/home/load_nhanvien',{}, function(data) {
        $('#nhanVienWindow').html(data);
    });
});

$("a.showPosition").hover(function() {
    var id = $(this).parent().find("input").val();
    if($(this).hasClass("active")) {
        $.post('<?php echo base_url() ?>index.php/home/get_nv_in_pb', {id: id}, function(data) {
            $("#balloon"+id).append(data);
        });
    }
    $(this).removeClass("active");
    $("#balloon"+id).fadeIn(200);
    
}, function() {
    var id = $(this).parent().find("input").val();
    $("#balloon"+id).stop().hide();
});
$(function() {
	$( ".window" ).draggable();
});
function addPosition() {
    var name = $("#position").val();
    $.post('<?php echo base_url() ?>index.php/home/insert_phongban', {name: name});
    $.post('<?php echo base_url() ?>index.php/home/load_phongban',{}, function(data) {
        $('#phongBanWindow').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/home/load_nhanvien',{}, function(data) {
        $('#nhanVienWindow').html(data);
    });
}
</script>