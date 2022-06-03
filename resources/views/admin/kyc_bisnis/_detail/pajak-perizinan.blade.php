<?php 
    $class = ($action == "edit") ? "form-control" : "form-control-plaintext";
    $readonly = ($action == "edit") ?  "" : "readonly";
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Informasi Pajak</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Kode Akun Pajak', 
                'column'    => 'company_tax_account_code',
                'data'      => !empty($data->tax_account_code) ? $data->tax_account_code : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[0]) ? $data->submission[0]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []   
            ])
    </div>    

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Kode LKPBU', 
                'column'    => 'company_lkpub_code',
                'data'      => !empty($data->lkpub_code) ? $data->lkpub_code : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[1]) ? $data->submission[1]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []   
            ])
    </div>        

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor NPWP', 
                'column'    => 'company_npwp',
                'data'      => !empty($data->npwp) ? $data->npwp : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[2]) ? $data->submission[2]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []    
            ])
    </div>                

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Tanggal Registrasi NPWP Perusahaan', 
                'column'    => 'company_registration_date_npwp', 
                'data'      => !empty($data->registration_date_npwp) ? month(date('Y-m-d',strtotime($data->registration_date_npwp))) : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []    
            ])
    </div>           

    <div class="col-md-12 mb-2 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Nomor Perizinan Perusahaan</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor SIUP', 
                'column'    => 'company_siup',
                'data'      => !empty($data->siup) ?$data->siup : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[4]) ? $data->submission[4]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => [] 
            ])
    </div>         

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor Akta Pendirian Usaha', 
                'column'    => 'company_certificate_number',
                'data'      => !empty($data->company_certificate_number) ? $data->company_certificate_number : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[5]) ? $data->submission[5]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []   
            ])
    </div>  

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor NIB Perusahaan', 
                'column'    => 'company_nib',
                'data'      => !empty($data->nib) ? $data->nib : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[6]) ? $data->submission[6]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []   
            ])
    </div>        

    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Rekening Efek</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>        

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'SID Number', 
                'column'    => 'sid_number',
                'data'      => !empty($data->sid_number) ? $data->sid_number : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => '',
                'optional'  => 1,
                'optionDitolak' => []  
            ])
    </div>    

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Tanggal Registrasi Rekening Efek', 
                'column'    => 'securities_account_date_registration',
                'data'      => !empty($data->securities_account_date_registration) ? month(date('Y-m-d',strtotime($data->securities_account_date_registration))) : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => '',
                'optional'  => 1,
                'optionDitolak' => []    
            ])
    </div>       
</div>  