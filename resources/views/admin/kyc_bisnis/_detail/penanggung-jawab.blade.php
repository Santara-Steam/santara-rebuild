<?php
    $class = ($action == "edit") ? "form-control" : "form-control-plaintext";
    $readonly = ($action == "edit") ?  "" : "readonly";
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Penanggung Jawab Perusahaan</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nama Lengkap', 
                'column'    => 'company_responsible_name1',
                'data'      => !empty($data->company_responsible_name1) ? $data->company_responsible_name1 : '',
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
                'title'     => 'Jabatan', 
                'column'    => 'company_responsible_position1',
                'data'      => !empty($data->company_responsible_position1) ? $data->company_responsible_position1 : '',
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
                'title'     => 'Nomor KTP', 
                'column'    => 'company_responsible_idcard_number1',
                'data'      => !empty($data->company_responsible_idcard_number1) ? $data->company_responsible_idcard_number1 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[2]) ? $data->submission[2]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>

    <?php if( !empty($data->type_idcard1) && ($data->type_idcard1 == 'E-KTP') ) : ?>
        <div class="alert-kyc-field col-md-6 offset-md-6"><b>KTP Seumur Hidup</b></div>  
    <?php else: ?>  
    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Tanggal Kadaluarsa KTP', 
                'column'    => 'company_responsible_expired_date_idcard1',
                'data'      => !empty($data->company_responsible_expired_date_idcard1) ? month(date('Y-m-d',strtotime($data->company_responsible_expired_date_idcard1))) : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []     
            ])
    </div>        
    <?php endif; ?>

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor NPWP Penanggung Jawab', 
                'column'    => 'company_responsible_npwp1',
                'data'      => !empty($data->company_responsible_npwp1) ? $data->company_responsible_npwp1 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[4]) ? $data->submission[4]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>  

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor Pasport', 
                'column'    => 'company_responsible_passport1',
                'data'      => !empty($data->company_responsible_passport1) ? $data->company_responsible_passport1 : '',
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
                'title'     => 'Tanggal Kadaluarsa Pasport', 
                'column'    => 'company_responsible_expired_date_passport1',
                'data'      => !empty($data->company_responsible_expired_date_passport1) ? month(date('Y-m-d',strtotime($data->company_responsible_expired_date_passport1))) : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[6]) ? $data->submission[6]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div> 

    <?php if( !empty($data->company_responsible_name2) ) : ?>
    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Penanggung Jawab Perusahaan 2</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nama Lengkap', 
                'column'    => 'company_responsible_name2',
                'data'      => !empty($data->company_responsible_name2) ? $data->company_responsible_name2 : '',
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
                'title'     => 'Jabatan', 
                'column'    => 'company_responsible_position2',
                'data'      => !empty($data->company_responsible_position2) ? $data->company_responsible_position2 : '',
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
                'title'     => 'Nomor KTP', 
                'column'    => 'company_responsible_idcard_number2',
                'data'      => !empty($data->company_responsible_idcard_number2) ? $data->company_responsible_idcard_number2 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[9]) ? $data->submission[9]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>

    <?php if( !empty($data->type_idcard2) && ($data->type_idcard2 == 'E-KTP') ) : ?>
        <div class="alert-kyc-field col-md-6 offset-md-6"><b>KTP Seumur Hidup</b></div>  
    <?php else: ?>  
    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Tanggal Kadaluarsa KTP', 
                'column'    => 'company_responsible_expired_date_idcard2',
                'data'      => !empty($data->company_responsible_expired_date_idcard2) ? month(date('Y-m-d',strtotime($data->company_responsible_expired_date_idcard2))) : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[10]) ? $data->submission[10]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []     
            ])
    </div>        
    <?php endif; ?>

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor NPWP Penanggung Jawab', 
                'column'    => 'company_responsible_npwp2',
                'data'      => !empty($data->company_responsible_npwp2) ? $data->company_responsible_npwp2 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[11]) ? $data->submission[11]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>  

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor Pasport', 
                'column'    => 'company_responsible_passport2',
                'data'      => !empty($data->company_responsible_passport2) ? $data->company_responsible_passport2 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[12]) ? $data->submission[12]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>        

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Tanggal Kadaluarsa Pasport', 
                'column'    => 'company_responsible_expired_date_passport2',
                'data'      => !empty($data->company_responsible_expired_date_passport2) ? month(date('Y-m-d',strtotime($data->company_responsible_expired_date_passport2))) : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[12]) ? $data->submission[13]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div> 
    <?php endif; ?>

    <?php if( !empty($data->company_responsible_name3) ) : ?>
    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Penanggung Jawab Perusahaan 3</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nama Lengkap', 
                'column'    => 'company_responsible_name3',
                'data'      => !empty($data->company_responsible_name3) ? $data->company_responsible_name3 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[14]) ? $data->submission[14]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []     
            ])
    </div>   

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Jabatan', 
                'column'    => 'company_responsible_position3',
                'data'      => !empty($data->company_responsible_position3) ? $data->company_responsible_position3 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[15]) ? $data->submission[15]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []     
            ])
    </div>

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor KTP', 
                'column'    => 'company_responsible_idcard_number3',
                'data'      => !empty($data->company_responsible_idcard_number3) ? $data->company_responsible_idcard_number3 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[16]) ? $data->submission[16]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>

    <?php if( !empty($data->type_idcard3) && ($data->type_idcard3 == 'E-KTP') ) : ?>
        <div class="alert-kyc-field col-md-6 offset-md-6"><b>KTP Seumur Hidup</b></div>  
    <?php else: ?>   
    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Tanggal Kadaluarsa KTP', 
                'column'    => 'company_responsible_expired_date_idcard3',
                'data'      => !empty($data->company_responsible_expired_date_idcard3) ? month(date('Y-m-d',strtotime($data->company_responsible_expired_date_idcard3))) : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[17]) ? $data->submission[17]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []     
            ])
    </div>        
    <?php endif; ?>

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor NPWP Penanggung Jawab', 
                'column'    => 'company_responsible_npwp3',
                'data'      => !empty($data->company_responsible_npwp3) ? $data->company_responsible_npwp3 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[18]) ? $data->submission[18]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>  

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor Pasport', 
                'column'    => 'company_responsible_passport3',
                'data'      => !empty($data->company_responsible_passport3) ? $data->company_responsible_passport3 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[19]) ? $data->submission[19]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>        

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Tanggal Kadaluarsa Pasport', 
                'column'    => 'company_responsible_expired_date_passport3',
                'data'      => !empty($data->company_responsible_expired_date_passport3) ? month(date('Y-m-d',strtotime($data->company_responsible_expired_date_passport3))) : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[20]) ? $data->submission[20]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div> 
    <?php endif; ?>    

    <?php if( !empty($data->company_responsible_name4) ) : ?>
    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Penanggung Jawab Perusahaan 4</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nama Lengkap', 
                'column'    => 'company_responsible_name4',
                'data'      => !empty($data->company_responsible_name4) ? $data->company_responsible_name4 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[21]) ? $data->submission[21]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []     
            ])
    </div>   

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Jabatan', 
                'column'    => 'company_responsible_position4',
                'data'      => !empty($data->company_responsible_position4) ? $data->company_responsible_position4 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[22]) ? $data->submission[22]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []     
            ])
    </div>

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor KTP', 
                'column'    => 'company_responsible_idcard_number4',
                'data'      => !empty($data->company_responsible_idcard_number4) ? $data->company_responsible_idcard_number4 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[23]) ? $data->submission[23]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>

    <?php if( !empty($data->type_idcard4) && ($data->type_idcard4 == 'E-KTP') ) : ?>
        <div class="alert-kyc-field col-md-6 offset-md-6"><b>KTP Seumur Hidup</b></div>  
    <?php else: ?>      
    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Tanggal Kadaluarsa KTP', 
                'column'    => 'company_responsible_expired_date_idcard4',
                'data'      => !empty($data->company_responsible_expired_date_idcard4) ? month(date('Y-m-d',strtotime($data->company_responsible_expired_date_idcard4))) : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[24]) ? $data->submission[24]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []     
            ])
    </div>        
    <?php endif; ?>

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor NPWP Penanggung Jawab', 
                'column'    => 'company_responsible_npwp4',
                'data'      => !empty($data->company_responsible_npwp4) ? $data->company_responsible_npwp4 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[25]) ? $data->submission[25]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>  

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Nomor Pasport', 
                'column'    => 'company_responsible_passport4',
                'data'      => !empty($data->company_responsible_passport4) ? $data->company_responsible_passport4 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[26]) ? $data->submission[26]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>        

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Tanggal Kadaluarsa Pasport', 
                'column'    => 'company_responsible_expired_date_passport4',
                'data'      => !empty($data->company_responsible_expired_date_passport4) ? month(date('Y-m-d',strtotime($data->company_responsible_expired_date_passport4))) : '',                
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[27]) ? $data->submission[27]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div> 
    <?php endif; ?>        
</div>