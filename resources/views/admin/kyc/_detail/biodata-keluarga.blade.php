<?php
$class = $action == 'edit' ? 'form-control' : 'form-control-plaintext';
$readonly = $action == 'edit' ? '' : 'readonly';
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Biodata Keluarga</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Status Pernikahan',
            'column' => 'marital_status',
            'data' => !empty($data->marital_status) ? App\Http\Controllers\KycController::getMarital($data->marital_status) : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[0]) ? $data->submission[0]['error'] : '',
            'optional' => 0,
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nama Pasangan ( Jika Status Menikah )',
            'column' => 'spouse_name',
            'data' => !empty($data->spouse_name) ? $data->spouse_name : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[1]) ? $data->submission[1]['error'] : '',
            'optional' => !empty($data->marital_status) && $data->marital_status == 2 ? 0 : 1,
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nama Gadis Ibu Kandung',
            'column' => 'mother_maiden_name',
            'data' => !empty($data->mother_maiden_name) ? $data->mother_maiden_name : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[2]) ? $data->submission[2]['error'] : '',
            'optional' => 0,
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nama Lengkap Ahli Waris',
            'column' => 'heir',
            'data' => !empty($data->heir) ? $data->heir : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
            'optional' => 1,
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Hubungan dengan ahli waris',
            'column' => 'heir_relation',
            'data' => !empty($data->heir_relation) ? $data->heir_relation : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[4]) ? $data->submission[4]['error'] : '',
            'optional' => 1,
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'No Telepon Ahli Waris',
            'column' => 'heir_phone',
            'data' => !empty($data->heir_phone) ? $data->heir_phone : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[5]) ? $data->submission[5]['error'] : '',
            'optional' => 1,
        ])
    </div>
</div>
