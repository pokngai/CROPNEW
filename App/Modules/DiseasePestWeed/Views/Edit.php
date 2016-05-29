<?php
Use System\Template\Template;
$template = new Template();
$template->open();

?>

<div class="container" id="container-center">

    <div class="row card" style="padding: 10px;">

        <h4>ข้อมูลโรค/แมลง/วัคพืช</h4>
        <form class="col s12" action="" method="post">
            <div class="row">
                <div class="input-field col m4 s12">
                    <select id="plant_id" name="plant_id">
                        <option selected disabled>กรุณาเลือกรายการ</option>
                        <?php while ($plant = $this->plants->fetch()): ?>
                            <option value="<?php echo $plant->plant_id; ?>"
                                <?php $this->row->plant_id == $plant->plant_id ? print 'selected' :  print ''; ?>><?php echo $plant->plant_name; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="plant_id">พืชที่ปลูก</label>
                </div>
                <div class="input-field col m4 s12">
                    <select id="problem_type_id" name="problem_type_id">
                        <option value="0" selected disabled>กรุณาเลือกรายการ</option>
                        <option value="1" <?php $this->row->problem_type_id == 1 ? print 'selected' :  print ''; ?>>โรค
                        </option>
                        <option value="2" <?php $this->row->problem_type_id == 2 ? print 'selected' :  print ''; ?>>ศัตรูพืช
                        </option>
                        <option value="3" <?php $this->row->problem_type_id == 3 ? print 'selected' :  print ''; ?>>วัชพืช
                        </option>
                    </select>
                    <label for="problem_type_id">ชนิดปัญหา</label>
                </div>
                <div class="input-field col  m4 s12">
                    <input name="disease_pest_weed_name" type="text" class="validate" required
                           value="<?php echo $this->row->disease_pest_weed_name; ?>">
                    <label for="disease_pest_weed_name">ชื่อโรค/ศัตรูพืช/วัชพืช</label>
                </div>
                <div class="input-field col  m4 s12">
                    <input name="disease_pest_weed_detail" type="text" class="validate" required
                           value="<?php echo $this->row->disease_pest_weed_detail; ?>">
                    <label for="disease_pest_weed_detail">รายละเอียดของโรค/ศัตรูพืช/วัชพืช</label>
                </div>
                <div class="input-field col m4 s12" id="layout_symptom" hidden>
                    <select id="symptom_id" name="symptom_id">

                        <?php while ($symptom = $this->symptoms->fetch()): ?>
                            <option value="0" selected>กรุณาเลือกรายการ</option>
                            <option
                                value="<?php echo $symptom->symptom_id; ?>"
                                <?php $this->row->symptom_id == $symptom->symptom_id ? print 'selected' : print ''; ?>><?php echo $symptom->symptom_name; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="symptom_id">อาการ</label>
                </div>
            </div>

            <div align="center" class="row">
                <br> <br> <br>
                <div class="col s12">
                    <button class="btn waves-effect green " style="margin: 5px;" type="submit" name="submit"
                            id="btn-submit" value="ss"><i class="fa fa-save"></i> บันทึก
                    </button>
                    <button class="btn waves-effect light-green" style="margin: 5px;" type="reset" name="reset"
                            value="ss"><i class="fa fa-refresh"></i> เริ่มใหม่
                    </button>
                    <button class="btn waves-effect orange" style="margin: 5px;" type="button"
                            onclick="window.location.href = '<?php echo $this->route->backToModule() . '//' . $this->param(0); ?>'">
                        <i class="fa fa-arrow-circle-left"></i> ย้อนกลับ
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php
$template->close();
?>
<script>

    $(document).ready(function () {

        try {

            $(document).on('change', '#problem_type_id', function (e) {
                e.preventDefault();
                if ($('#problem_type_id').val() == 1) {
                    $('#layout_symptom').show();
                } else {
                    $('#layout_symptom').hide();
                    $('#symptom_id').val(0);
                }
            });

            $(document).on('submit', 'form', function (e) {
                if ($('#plant_id').val() <= 0) {
                    alert('กรุณาเลือกพืชที่ปลูก');
                    $('#plant_id').focus();
                }

                if ($('#problem_type_id').val() <= 0) {
                    alert('ชนิดปัญหา');
                    $('#problem_type_id').focus();
                }

                if ($('#problem_type_id').val() > 0 && $('#plant_id').val() > 0) {
                    $('form').submit();
                }
                e.preventDefault();
            });

            if ($('#problem_type_id').val() == 1) {
                $('#layout_symptom').show();
            }

        } catch (e) {
            alert(e);
        }
    });

</script>