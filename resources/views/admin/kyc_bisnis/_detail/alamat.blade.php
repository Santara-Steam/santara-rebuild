<?php 
    $class = ($action == "edit") ? "form-control" : "form-control-plaintext";
    $readonly = ($action == "edit") ?  "" : "readonly";
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Alamat Perusahaan</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>

    <div class="col-md-12 content-center row">
        @include('admin/kyc_bisnis/_field_confirmation', [
            'title' => 'Negara',
            'column' => 'company_country_address',
            'data' => !empty($data->country_name) ? $data->country_name : '',
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

        @include('admin/kyc_bisnis/_field_confirmation', [
            'title' => 'Provinsi',
            'column' => 'company_province_address',
            'data' => !empty($data->province_name) ? $data->province_name : '',
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

        @include('admin/kyc_bisnis/_field_confirmation', [
            'title' => 'Kabupaten',
            'column' => 'company_regency_address',
            'data' => !empty($data->regency_name) ? $data->regency_name : '',
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

        @include('admin/kyc_bisnis/_field_confirmation', [
            'title' => 'Alamat Perusahaan',
            'column' => 'company_address',
            'data' => !empty($data->company_address) ? $data->company_address : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'textarea',
            'error' => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
            'optional' => 0,
            'optionDitolak' => []
        ])

    </div>    

    <div class="col-md-12 content-center row">

        @include('admin/kyc_bisnis/_field_confirmation', [
            'title' => 'Kode Pos',
            'column' => 'company_postal_code',
            'data' => !empty($data->postal_code) ? $data->postal_code : '',
            'class' => $class,
            'readonly' => $readonly,
            'action' => $action,
            'type' => 'text',
            'error' => isset($data->submission[4]) ? $data->submission[4]['error'] : '',
            'optional' => 1,
            'optionDitolak' => []
        ])

    </div>       

    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Nomor Fax & Telepon</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>        

    <div class="col-md-12 content-center row">
        @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor Handphone Perusahaan', 
                'column'    => 'phone',
                'data'      => !empty($data->phone) ? $data->phone : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[7]) ? $data->submission[7]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []
            ])
    </div>       

    <div class="col-md-12 content-center row">
        @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor Telp Kantor', 
                'column'    => 'company_phone_number',
                'data'      => !empty($data->company_phone_number) ? $data->company_phone_number : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[5]) ? $data->submission[5]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []    
            ])
    </div>     

    <div class="col-md-12 content-center row">
        @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor Fax', 
                'column'    => 'company_fax',
                'data'      => !empty($data->fax) ? $data->fax : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[6]) ? $data->submission[6]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []    
            ])
    </div> 
</div>
