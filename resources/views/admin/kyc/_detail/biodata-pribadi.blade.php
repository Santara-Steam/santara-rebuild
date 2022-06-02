<?php
$class = $action == 'edit' ? 'form-control' : 'form-control-plaintext';
$readonly = $action == 'edit' ? '' : 'readonly';
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Data Diri</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>


    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Foto Profile',
            'column' => 'photo',
            'data' => !empty($data->photo) ? $data->photo : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'photo',
            'error' => isset($data->submission[0]) ? $data->submission[0]['error'] : '',
            'optional' => 1,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nama Lengkap',
            'column' => 'full_name',
            'data' => !empty($data->full_name) ? $data->full_name : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[1]) ? $data->submission[1]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Penulisan nama tidak sesuai dengan Kartu Identitas',
                'Penulisan nama tidak sesuai dengan Kartu Identitas (Beserta Gelar)',
                'Belum melampirkan foto kartu KTP'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Tempat Lahir',
            'column' => 'birth_place',
            'data' => !empty($data->birth_place) ? $data->birth_place : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[2]) ? $data->submission[2]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Tempat lahir tidak sesuai dengan Kartu Identitas',
                'Belum melampirkan foto kartu KTP'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Tanggal Lahir',
            'column' => 'birth_date',
            'data' => !empty($data->birth_date) ? month(date('Y-m-d', strtotime($data->birth_date))) : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Tanggal lahir tidak sesuai dengan Kartu Identitas',
                'Belum melampirkan foto kartu KTP'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Jenis Kelamin',
            'column' => 'gender',
            'data' => !empty($data->gender) ? ($data->gender == 'm' ? 'Laki-laki' : 'Perempuan') : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[4]) ? $data->submission[4]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Jenis Kelamin tidak sesuai dengan Kartu Identitas',
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Pendidikan Terakhir',
            'column' => 'education_id',
            'data' => !empty($data->education) ? $data->education : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[5]) ? $data->submission[5]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Pendidikan terakhir tidak sesuai dengan Kartu Identitas'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Kewarganegaraan',
            'column' => 'country',
            'data' => !empty($data->country_name) ? $data->country_name : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[6]) ? $data->submission[6]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Kewarganegaraan tidak sesuai dengan Kartu Identitas'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Email',
            'column' => 'email',
            'data' => !empty($data->email) ? $data->email : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[7]) ? $data->submission[7]['error'] : '',
            'optional' => 0,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Email Lain',
            'column' => 'another_email',
            'data' => !empty($data->another_email) ? $data->another_email : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[8]) ? $data->submission[8]['error'] : '',
            'optional' => 1,
            'optionDitolak' => [
                'Penulisan email terdapat kesalahan'
            ]
        ])
    </div>

    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Nomor Telepon</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nomor Telepon',
            'column' => 'phone',
            'data' => !empty($data->phone) ? $data->phone : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[9]) ? $data->submission[9]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Penulisan nomor belum benar'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'No Telp Lain',
            'column' => 'alt_phone',
            'data' => !empty($data->alt_phone) ? $data->alt_phone : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[10]) ? $data->submission[10]['error'] : '',
            'optional' => 1,
            'optionDitolak' => []
        ])
    </div>

    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6">
            <h3><b>Kartu Tanda Penduduk</b></h3>
        </div>
        <div class="col-md-6">
            <h3><b>Status Verifikasi</b></h3>
        </div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nomor Passport',
            'column' => 'passport_number',
            'data' => !empty($data->passport_number) ? $data->passport_number : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[15]) ? $data->submission[15]['error'] : '',
            'optional' => 1,
            'optionDitolak' => [
                'Nomor Passport tidak sesuai dengan Kartu Identitas'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Tanggal Kadaluarsa Passport ( jika passport tidak kosong )',
            'column' => 'expired_date_passport',
            'data' => !empty($data->expired_date_passport)
                ? month(date('Y-m-d', strtotime($data->expired_date_passport)))
                : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[16]) ? $data->submission[16]['error'] : '',
            'optional' => 1,
            'optionDitolak' => [
                'Tanggal kadaluarsa bisa dipilih seumur hidup'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Nomor Induk Kependudukan (NIK)',
            'column' => 'idcard_number',
            'data' => !empty($data->idcard_number) ? $data->idcard_number : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[11]) ? $data->submission[11]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Penulisan NIK tidak sesuai dengan Kartu Identitas',
                'Belum melampirkan foto kartu KTP'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Tanggal Registrasi KTP',
            'column' => 'regis_date_idcard',
            'data' => !empty($data->regis_date_idcard) ? month(date('Y-m-d', strtotime($data->regis_date_idcard))) : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[12]) ? $data->submission[12]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Tanggal registrasi tidak sesuai dengan yang tercantum pada kartu identitas (diatas tanda tangan)',
                'Tanggal registrasi di KTP buram/tidak jelas',
                'Belum melampirkan foto kartu KTP'
            ]
        ])
    </div>

    <?php if( !empty($data->type_idcard) && ($data->type_idcard == 'E-KTP') ) : ?>
    <div class="alert-kyc-field col-md-6 offset-md-6"><b>KTP Seumur Hidup</b></div>
    <?php else: ?>
    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Tanggal Kadaluarsa KTP',
            'column' => 'expired_date_idcard',
            'data' => !empty($data->expired_date_idcard)
                ? month(date('Y-m-d', strtotime($data->expired_date_idcard)))
                : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[14]) ? $data->submission[14]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'EKTP bisa pilih Seumur Hidup'
            ]
        ])
    </div>
    <?php endif; ?>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Foto KTP',
            'column' => 'idcard_photo',
            'data' => !empty($data->idcard_photo) ? $data->idcard_photo : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'image',
            'error' => isset($data->submission[17]) ? $data->submission[17]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Foto kartu KTP buram/tidak jelas',
                'Lampiran bukan foto kartu KTP',
                'Kartu identitas tidak sesuai kriteria. EKTP dapat diganti dengan surat keterangan pengganti KTP',
                'Kartu identitas tidak sesuai kriteria. EKTP dapat diganti dengan surat keterangan pengganti KTP atau KTP Copy dan kartu identitas lain asli'
            ]
        ])
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc/_field_confirmation', [
            'title' => 'Foto Selfi',
            'column' => 'verification_photo',
            'data' => !empty($data->verification_photo) ? $data->verification_photo : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'image',
            'error' => isset($data->submission[18]) ? $data->submission[18]['error'] : '',
            'optional' => 0,
            'optionDitolak' => [
                'Swafoto memegang Kartu Identitas buram/tidak jelas',
                'Swafoto memegang Kartu Identitas buram/tidak jelas (Kartu Identitas terlalu jauh)',
                'Swafoto tidak memegang kartu KTP',
                'Swafoto memegang Kartu Identitas tidak sesuai dengan kriteria (menutup wajah)'
            ]
        ])
    </div>
</div>
