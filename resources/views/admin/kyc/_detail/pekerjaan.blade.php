<?php
$class = $action == 'edit' ? 'form-control' : 'form-control-plaintext';
$readonly = $action == 'edit' ? '' : 'readonly';
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Pekerjaan</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Pekerjaan',
            'column' => 'job_name',
            'data' => !empty($data->name) ? $data->name : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[0]) ? $data->submission[0]['error'] : '',
            'optional' => 0,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Bidang Usaha ( Jika Bidang Pekerjaan Wirswasta )',
            'column' => 'description_job',
            'data' => !empty($data->description_job) ? $data->description_job : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[1]) ? $data->submission[1]['error'] : '',
            'optional' => !empty($data->name) && $data->name == 'Wiraswasta / Pengusaha' ? 0 : 1,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Total Aset</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Total Aset',
            'column' => 'total_assets_of_investor',
            'data' => !empty($data->total_assets_of_investors)
                ? number_format($data->total_assets_of_investors, 0, ',', '.')
                : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[2]) ? $data->submission[2]['error'] : '',
            'optional' => 1,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Sumber Dana',
            'column' => 'source_of_investor_funds',
            'data' => !empty($data->source_of_investor_funds) ? $data->source_of_investor_funds : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'list',
            'error' => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
            'optional' => 0,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Motivasi',
            'column' => 'reason',
            'data' => !empty($data->reason_to_join) ? $data->reason_to_join : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[4]) ? $data->submission[4]['error'] : '',
            'optional' => 0,
            'optionDitolak' => []
        ])
    </div>
</div>
