<div class="title-bar">
    <span class="left"></span>
    <h2>Nhân viên</h2>
    <span class="right"></span>
</div>
<div class="content">
    <div class="table-wrapper-wrapper">
        <div class="table-wrapper">
            <div class="table">
                <table id="employeeList" class="list">
                    <tr class="form">
                        <td id="position_cell">
                            <select name="position" id="position">
                                <?php 
                                foreach($phong_ban as $p) {
                                ?>
                                <option value="<?php echo $p->pb_id; ?>"><?php echo $p->ten; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type="text" name="employee" id="employee" placeholder="Nhân viên"/></td>
                        <td><input type="text" name="bday" id="bday" placeholder="Năm sinh"/></td>
                        <td><input type="button" value="ADD" onclick="addEmployee()"/></td>
                    </tr>
                    <tr>
                        <th>Phòng ban</th>
                        <th>Nhân viên</th>
                        <th>Ngày sinh</th>
                    </tr>
                    <?php 
                    foreach ($nhan_vien as $nv) {?>
                    <tr>
                        <td class="position"><?php echo $nv->ten; ?></td>
                        <td class="name"><?php echo $nv->ho_ten; ?></td>
                        <td class="date"><?php echo $nv->ngay_sinh; ?></td>
                        <td>
                            <a href="#" class="edit editEmployee button">Edit</a>
                            <a href="#" class="update updateEmployee button">Update</a>
                            <a href="#" class="delete deleteEmployee button">Delete</a>
                            <input name="id" type="hidden" value="<?php echo $nv->nv_id; ?>"/>
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
$("#bday").datepicker({ dateFormat: "yy-mm-dd" });
$("a.editEmployee").live("click", function() {
    if($(this).parent().parent().find("td.name").children().length>0) {
        return false;
    }
    var name = $(this).parent().parent().find("td.name").html();
    var date = $(this).parent().parent().find("td.date").html();    
    var position = $(this).parent().parent().find("td.position").html();
    var positionSelect = $("#position_cell").html();
    positionSelect = positionSelect.replace(">"+position+"<", "selected='selected'>"+position+"<");
    $(this).parent().parent().find(".name").html("<input type='text' value='"+name+"'/>");
    $(this).parent().parent().find(".date").html("<input class='date' type='text' value='"+date+"'/>");  
    $(this).parent().parent().find(".position").html(positionSelect);
    $("input.date").datepicker({ dateFormat: "yy-mm-dd" });
});

$("a.updateEmployee").live("click", function() {
    if($(this).parent().parent().find("td.name").children().length==0) {
        return false;
    }
    var name = $(this).parent().parent().find("td.name input").val();
    var bday = $(this).parent().parent().find("td.date input").val();
    if(!(checkBlank(name)&&checkBday(bday))) {
        return false;
    }
    var pb_id = $(this).parent().parent().find("td.position select").val();
    var id = $(this).parent().find("input").val();
    $.post('<?php echo base_url() ?>index.php/home/update_nhanvien', {id: id, name: name, bday: bday, pb_id: pb_id});
    var posValue = $(this).parent().parent().find("td.position select option:selected").html();
    $(this).parent().parent().find(".name").html(name);
    $(this).parent().parent().find(".date").html(bday.replace(/\//g,"-"));
    $(this).parent().parent().find(".position").html(posValue);   
    $.post('<?php echo base_url() ?>index.php/home/load_phongban',{}, function(data) {
        $('#phongBanWindow').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/home/load_nhanvien',{}, function(data) {
        $('#nhanVienWindow').html(data);
    });
});
$("a.deleteEmployee").live("click", function() {
    var r = confirm("Bạn có chắc chắn muốn xóa không?");
    if(r==false) {
        return false;
    }
    var id = $(this).parent().find("input").val();
    $.post('<?php echo base_url() ?>index.php/home/delete_nhanvien', {id: id});
    
    $(this).parent().parent().remove();    
    $.post('<?php echo base_url() ?>index.php/home/load_phongban',{}, function(data) {
        $('#phongBanWindow').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/home/load_nhanvien',{}, function(data) {
        $('#nhanVienWindow').html(data);
    });
});
function addEmployee() {    
    var pos = $("select#position").val();
    var bday = $("#bday").val();
    var employee = $("#employee").val();
    if(!(checkBlank(employee)&&checkBday(bday))) {
        return false;
    }
    
    $.post('<?php echo base_url() ?>index.php/home/insert_nhanvien', {name: employee, bday: bday, pb_id: pos});
    $.post('<?php echo base_url() ?>index.php/home/load_phongban',{}, function(data) {
        $('#phongBanWindow').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/home/load_nhanvien',{}, function(data) {
        $('#nhanVienWindow').html(data);
    });
}
$(function() {
	$( ".window" ).draggable();
});
</script>