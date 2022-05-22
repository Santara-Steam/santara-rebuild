<?php
$class = $action == 'edit' ? 'form-control' : 'form-control-plaintext';
$readonly = $action == 'edit' ? '' : 'readonly';
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Akun Bank</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nama Pemilik Rekening',
            'column' => 'account_name1',
            'data' => !empty($data->account_name1) ? $data->account_name1 : '',
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
            'title' => 'Nama Bank',
            'column' => 'bank_investor1',
            'data' => !empty($data->bank1) ? $data->bank1 : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[1]) ? $data->submission[1]['error'] : '',
            'optional' => 0,
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nomor Rekening',
            'column' => 'account_number1',
            'data' => !empty($data->account_number1) ? $data->account_number1 : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[2]) ? $data->submission[2]['error'] : '',
            'optional' => 0,
        ])
    </div>

    <?php if( !empty($data->account_number2) ): ?>
    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Akun Bank 2</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nama Pemilik Rekening',
            'column' => 'account_name2',
            'data' => !empty($data->account_name2) ? $data->account_name2 : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
            'optional' => 0,
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nama Bank',
            'column' => 'bank_investor2',
            'data' => !empty($data->bank2) ? $data->bank2 : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[4]) ? $data->submission[4]['error'] : '',
            'optional' => 0,
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nomor Rekening',
            'column' => 'account_number2',
            'data' => !empty($data->account_number2) ? $data->account_number2 : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[5]) ? $data->submission[5]['error'] : '',
            'optional' => 0,
        ])
    </div>
    <?php endif; ?>

    <?php if( !empty($data->account_number3) ): ?>
    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Akun Bank 3</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nama Pemilik Rekening',
            'column' => 'account_name3',
            'data' => !empty($data->account_name3) ? $data->account_name3 : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[6]) ? $data->submission[6]['error'] : '',
            'optional' => 0,
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nama Bank',
            'column' => 'bank_investor3',
            'data' => !empty($data->bank3) ? $data->bank3 : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[7]) ? $data->submission[7]['error'] : '',
            'optional' => 0,
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nomor Rekening',
            'column' => 'account_number3',
            'data' => !empty($data->account_number3) ? $data->account_number3 : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[8]) ? $data->submission[8]['error'] : '',
            'optional' => 0,
        ])
    </div>
    <?php endif; ?>
</div>
