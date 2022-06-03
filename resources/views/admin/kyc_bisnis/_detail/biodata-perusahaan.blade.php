<?php
    $class = ($action == "edit") ? "form-control" : "form-control-plaintext";
    $readonly = ($action == "edit") ?  "" : "readonly";
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Profil Perusahaan</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Foto Profile', 
                'column'    => 'company_photo',
                'data'      => !empty($data->company_photo) ? $data->company_photo : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'photo',
                'error'     => isset($data->submission[0]) ? $data->submission[0]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []      
            ])          
    </div>                

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nama Perusahaan', 
                'column'    => 'company_name',
                'data'      => !empty($data->company_name) ? $data->company_name : '',
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
                'title'     => 'Jenis Perusahaan', 
                'column'    => 'company_type2',
                'data'      => !empty($data->business_type_name) ? $data->business_type_name : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []     
            ])
    </div>  

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Tipe Perusahaan', 
                'column'    => 'company_character',
                'data'      => !empty($data->company_char_name) ? $data->company_char_name : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[2]) ? $data->submission[2]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []      
            ])
    </div> 

               
    
    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Perusahaan Berbasis Syariah', 
                'column'    => 'company_syariah',
                'data'      => !empty($data->company_syariah) ? (($data->company_syariah == 'N') ? 'Tidak': 'Ya') : '',
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
                'title'     => 'Domisili Perusahaan', 
                'column'    => 'company_country_domicile',
                'data'      => !empty($data->company_country_domicile) ? $data->company_country_domicile : '',
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
                'title'     => 'Tempat Pendirian Perusahaan', 
                'column'    => 'company_establishment_place',
                'data'      => !empty($data->company_establishment_place) ? $data->company_establishment_place : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[6]) ? $data->submission[6]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []   
            ])
    </div>                 

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Tanggal Pendirian Perusahaan', 
                'column'    => 'company_date_establishment',
                'data'      => !empty($data->company_date_establishment) ? month(date('Y-m-d',strtotime($data->company_date_establishment))) : '',
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
                'title'     => 'Email', 
                'column'    => 'company_email',
                'data'      => !empty($data->email) ? $data->email : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[8]) ? $data->submission[8]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []   
            ])
    </div>                         

    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Email Lain', 
                'column'    => 'company_another_email',
                'data'      => !empty($data->another_email) ? $data->another_email : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[9]) ? $data->submission[9]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []      
            ])
    </div>             
                        
    <div class="col-md-12 content-center row">
         @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Deskripsi Singkat Perusahaan', 
                'column'    => 'company_description',
                'data'      => !empty($data->description) ? $data->description : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'textarea',
                'error'     => isset($data->submission[10]) ? $data->submission[10]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []       
            ])
    </div>                                 
</div>