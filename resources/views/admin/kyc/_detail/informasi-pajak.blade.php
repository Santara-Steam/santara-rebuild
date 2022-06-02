<?php
$class = $action == 'edit' ? 'form-control' : 'form-control-plaintext';
$readonly = $action == 'edit' ? '' : 'readonly';
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Informasi Pajak</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Pendapatan Pertahun Sebelum Pajak',
            'column' => 'income',
            'data' => !empty($data->income) ? number_format($data->income, 0, ',', '.') : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[0]) ? $data->submission[0]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Nominal pendapatan belum diakumulasi 12 bulan',
                'Nominal pendapatan tidak boleh dikosongkan'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Kode Akun Pajak',
            'column' => 'tax_account_code',
            'data' => !empty($data->tax_account_code) ? $data->tax_account_code : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[1]) ? $data->submission[1]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Tidak	sesuai.	WNI	Individual-Domestic (1010)'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'No NPWP',
            'column' => 'npwp',
            'data' => !empty($data->npwp) ? $data->npwp : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[2]) ? $data->submission[2]['error'] : '',
            'optional' => 1,
            'optionDitolak' => [
                'Nomor NPWP belum lengkap'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Tanggal Registrasi NPWP',
            'column' => 'date_registration_of_npwp',
            'data' => !empty($data->date_registration_of_npwp)
                ? month(date('Y-m-d', strtotime($data->date_registration_of_npwp)))
                : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
            'optional' => 1,
            'optionDitolak' => [
                'Nomor SID tidak sesuai dengan yang tercantum pada Kartu KSEI',
                'Nomor SID tidak sesuai'
            ]
        ])
    </div>

    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Rekening Efek</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'SID Number',
            'column' => 'sid_number',
            'data' => !empty($data->sid_number) ? $data->sid_number : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[7]) ? $data->submission[7]['error'] : '',
            'optional' => !empty($data->have_securities_account) && $data->have_securities_account ? 0 : 1,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Tanggal Registrasi Rekening Efek',
            'column' => 'securities_account_date_registration',
            'data' => !empty($data->securities_account_date_registration)
                ? month(date('Y-m-d', strtotime($data->securities_account_date_registration)))
                : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[5]) ? $data->submission[5]['error'] : '',
            'optional' => !empty($data->have_securities_account) && $data->have_securities_account ? 0 : 1,
            'optionDitolak' => [
                'Tanggal Registrasi tidak sesuai',
                'Tanggal registrasi tidak boleh kosong'
            ]
        ])
    </div>

    <?php if( !empty($data->have_securities_account) && ($data->have_securities_account) ): ?>
    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Foto Rekening Efek',
            'column' => 'securities_account',
            'data' => !empty($data->securities_account) ? $data->securities_account : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'document',
            'error' => isset($data->submission[6]) ? $data->submission[6]['error'] : '',
            'optional' => 1,
            'optionDitolak' => [
                'Lampiran tidak sesuai kriteria',
                'Dokumen tidak bisa dibuka',
                'Lampiran tidak mencantumkan nama pengguna dan Nomor SID',
                'Lampiran bukan bukti kepemilikan rekening efek pemilik akun',
                'Unggah lampiran dengan format .jpeg .jpg atau .png',
                'Tidak melampirkan dokumen rekening efek'
            ]
        ])
    </div>
    <?php endif; ?>
</div>
