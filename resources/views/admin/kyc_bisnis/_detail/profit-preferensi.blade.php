<?php 
    $class = ($action == "edit") ? "form-control" : "form-control-plaintext";
    $readonly = ($action == "edit") ?  "" : "readonly";
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Total Kekayaan</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Total Kekayaan Bersih 1 Tahun Terakhir', 
                'column'    => 'company_income1',
                'data'      => !empty($data->company_income1) ? $data->company_income1 : '',
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
                'title'     => 'Total Kekayaan Bersih 2 Tahun Terakhir', 
                'column'    => 'company_income2',
                'data'      => !empty($data->company_income2) ? $data->company_income2 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[1]) ? $data->submission[1]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []      
            ])
    </div>         

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Total Kekayaan Bersih 3 Tahun Terakhir', 
                'column'    => 'company_income3',
                'data'      => !empty($data->company_income3) ? $data->company_income3 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[2]) ? $data->submission[2]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []      
            ])
    </div>            
    
    <div class="col-md-12 mb-2 mt-2 mcontent-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Motivasi Investasi</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>        

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Preferensi Investasi', 
                'column'    => 'company_reason_to_join',
                'data'      => !empty($data->reason_to_join) ? $data->reason_to_join : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []       
            ])
    </div>  
</div>
