<?php 
    $class = ($action == "edit") ? "form-control" : "form-control-plaintext";
    $readonly = ($action == "edit") ?  "" : "readonly";
?>
<div> 
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Keterangan Aset</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>                  
    
    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Sumber Dana', 
                'column'    => 'company_source_of_funds',
                'data'      => !empty($data->source_of_funds) ? $data->source_of_funds : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'list',
                'error'     => isset($data->submission[0]) ? $data->submission[0]['error'] : '',
                'optional'  => 0,
                'optionDitolak' => []    
            ])
    </div>    

    <div class="col-md-12 mb-2 mt-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Profit Perusahaan</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>   

    <div class="col-md-12 content-center row">
       @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Profit Operasional 1 Tahun Terakhir', 
                'column'    => 'company_total_property1',
                'data'      => !empty($data->company_total_property1) ? $data->company_total_property1 : '',
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
                'title'     => 'Profit Operasional 2 Tahun Terakhir', 
                'column'    => 'company_total_property2',
                'data'      => !empty($data->company_total_property2) ? $data->company_total_property2 : '',
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
                'title'     => 'Profit Operasional 3 Tahun Terakhir', 
                'column'    => 'company_total_property3',
                'data'      => !empty($data->company_total_property3) ? $data->company_total_property3 : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'text',
                'error'     => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div>         
</div>