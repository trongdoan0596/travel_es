<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\CoachCourseSearch */
/* @var $form yii\widgets\ActiveForm */

?>
<script src="/backend/themes/admin/js/moment.js"></script>
<script src="/backend/themes/admin/js/bootstrap-daterangepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
<div class="panel">
    <div class="panel-hdr">
        <h2>
			Xuất excel danh sách account
        </h2>
    </div>
    <div class="panel-container show">
        <div class="panel-content">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
            ]); ?>
            <div class="row">
                <div class="col-lg-3">
                    <div id="date-range" class="date-range pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="Ngày đăng ký">
                        <i class="fas fa-calendar-alt"></i>&nbsp;<span class="visible-lg-inline-block">Ngày đăng ký</span>&nbsp; <i class="fas fa-angle-down" style="float: right; margin-right: 2px; font-size: 16px; font-weight: bold; position: relative; top: 1px;"></i>
						<input type="hidden" id="date_start" name="date_start">
						<input type="hidden" id="date_end" name="date_end">
                    </div>
                    
                    
                </div>
              
                <div class="col-lg-4">
                    <div class="form-group">
                        <?= Html::Button('Xuất excel', ['class' => 'btn btn-success','id' => 'form-export-btn']) ?>
                        <?= Html::Button('<i class="fas fa-search"></i> Lọc', ['id'=>'btn-search','class' => 'btn btn-primary hide']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById('btn-search').addEventListener('click', function(e) {
        e.preventDefault();
        $('input[name="_export"]').remove();
        var form = e.target.closest('form');
        form.submit();
    });
    document.getElementById('form-export-btn').addEventListener('click', function(e) {
        e.preventDefault();
        var form = e.target.closest('form');
        var m = document.createElement("input");
        m.setAttribute('type', 'hidden');
        m.setAttribute('name', '_export');
        form.appendChild(m);
        form.submit();
    });
    jQuery(document).ready(function(){

		var startDate = moment('<?= date('Y-m-d', time()); ?>');
		var endDate = moment('<?= date('Y-m-d', time()); ?>');

        $('#date-range').daterangepicker({
                opens: 'right',
                startDate: startDate,
                endDate: endDate,
                minDate: '01/03/2021',
                maxDate: '12/31/2025',
                dateLimit: {
                    days: 365
                },
                showDropdowns: false,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Hôm nay': [moment(), moment()],
                    'Hôm qua': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Tuần này(Thứ 2 - Hôm nay)': [moment().startOf('week'), moment()],
                    'Tuần trước(Thứ 2 - Chủ Nhật trước)': [moment().subtract('week', 1).startOf('week'), moment().subtract('week', 1).endOf('week')],
                    '7 ngày qua': [moment().subtract('days', 6), moment()],
                    '14 ngày qua': [moment().subtract('days', 13), moment()],
                    '30 ngày qua': [moment().subtract('days', 29), moment()],
                    'Tháng hiện tại': [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                buttonClasses: ['btn btn-sm'],
                applyClass: ' blue',
                cancelClass: 'default',
                format: 'MM/DD/YYYY',
                separator: ' đến ',
                locale: {
                    applyLabel: 'Chọn',
                    cancelLabel: 'Hủy',
                    fromLabel: 'Từ',
                    toLabel:'Đến',
                    customRangeLabel: 'Tùy chỉnh',
                    daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                    monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                    firstDay: 1
                }
            },
            function (start, end) {
                $('#date-range span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                $("#date_start").val(start.format('YYYY-MM-DD'));
                $("#date_end").val(end.format('YYYY-MM-DD'));
            }
        );
        $('#date-range').show();
        $('#date-range').on('cancel.daterangepicker', function(ev, picker) {
            $('#date-range span').html('Ngày đăng ký');
            $("#date_start").val('');
            $("#date_end").val('');
        });
    });

</script>

<style>
.date-range{padding: 8px 4px;min-width: 175px;width:100%;width: 100%;border: 1px solid #E5E5E5;text-align: left; padding-left: 14px;}
button.applyBtn.btn.btn-sm.blue { background-color: #886ab5; color: #fff; }
button.applyBtn.btn.btn-sm.blue:hover {opacity:.8 }
.date-range .form-group{display:none}
</style>
