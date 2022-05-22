<?php
$class = $action == 'edit' ? 'form-control' : 'form-control-plaintext';
$readonly = $action == 'edit' ? '' : 'readonly';
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Alamat Sesuai KTP</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        <?php if ( $data != null && $data->idcard_photo ) : ?>
        <div class="form-row text-center">
            <div class="form-group col-md-6 col-xl-12">
                <img src="<?= $data->idcard_photo ?>" width="100%" class="rounded mx-auto d-block" alt="Card image cap"
                    style="width: 400px;height: 250px;object-fit: contain;">
            </div>
            <?php if ( $action == "konfirmasi" ) : ?>
            <div class="form-group col-md-6 col-xl-12">
                <button type="button" class="btn btn-sm btn-primary open-imageDialog" data-toggle="modal"
                    data-target="#imageModal" data-image="<?= $data->idcard_photo ?>">Lihat Foto KTP</button>
            </div>
            <?php endif; ?>
        </div>
        <?php else : ?>
        <label class="py-3 red"><b>Foto KTP belum diunggah</b></label>
        <?php endif ?>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Negara',
            'column' => 'idcard_country',
            'data' => !empty($data->idcard_country) ? $data->idcard_country : '',
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
            'title' => 'Provinsi',
            'column' => 'idcard_province',
            'data' => !empty($data->idcard_province) ? $data->idcard_province : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[1]) ? $data->submission[1]['error'] : '',
            'optional' => 0,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Kabupaten / Kota',
            'column' => 'idcard_regency',
            'data' => !empty($data->idcard_regency) ? $data->idcard_regency : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[2]) ? $data->submission[2]['error'] : '',
            'optional' => 0,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Alamat Sesuai KTP ( Maks. 180 Karakter )',
            'column' => 'idcard_address',
            'data' => !empty($data->idcard_address) ? $data->idcard_address : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'textarea',
            'error' => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Penulisan alamat tidak sesuai dengan Kartu Identitas',
                'Belum melampirkan foto kartu KTP'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Kode Pos',
            'column' => 'idcard_postal_code',
            'data' => !empty($data->idcard_postal_code) ? $data->idcard_postal_code : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[4]) ? $data->submission[4]['error'] : '',
            'optional' => 1,
            'optionDitolak' => []
        ])
    </div>

    <?php if($data): ?>
    <?php if($data->address_same_with_idcard) : ?>
    <div class="alert-kyc-field col-md-6 offset-md-6"><b>Alamat yang terlampir sama dengan alamat KTP diatas</b></div>
    <?php else: ?>
    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Alamat Tinggal Sekarang</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Negara',
            'column' => 'country_domicile_name',
            'data' => !empty($data->country_domicile_name) ? $data->country_domicile_name : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[5]) ? $data->submission[5]['error'] : '',
            'optional' => $data->address_same_with_idcard ? 1 : 0,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Provinsi',
            'column' => 'province',
            'data' => !empty($data->province) ? $data->province : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[6]) ? $data->submission[6]['error'] : '',
            'optional' => $data->address_same_with_idcard ? 1 : 0,
            'optionDitolak' => []
        ]);
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Kabupaten / Kota',
            'column' => 'regency',
            'data' => !empty($data->regency) ? $data->regency : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[7]) ? $data->submission[7]['error'] : '',
            'optional' => $data->address_same_with_idcard ? 1 : 0,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Alamat Tinggal Sekarang ( Maks. 180 Karakter )',
            'column' => 'address',
            'data' => !empty($data->address) ? $data->address : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'textarea',
            'error' => isset($data->submission[8]) ? $data->submission[8]['error'] : '',
            'optional' => $data->address_same_with_idcard ? 1 : 0,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Kode Pos',
            'column' => 'postal_code',
            'data' => !empty($data->postal_code) ? $data->postal_code : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[9]) ? $data->submission[9]['error'] : '',
            'optional' => 1,
            'optionDitolak' => []
        ])
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>
