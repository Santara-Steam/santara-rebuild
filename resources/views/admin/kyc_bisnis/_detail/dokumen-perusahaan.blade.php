<?php
    $class = ($action == "edit") ? "form-control" : "form-control-plaintext";
    $readonly = ($action == "edit") ?  "" : "readonly";
?>
<div>
    <div class="col-md-12 mb-2 content-center row checklist-admin-title">
        <div class="col-md-6"><h3><b>Dokumen Perusahaan</b></h3></div>
        <div class="col-md-6"><h3><b>Status Verifikasi</b></h3></div>
    </div>

    <div class="col-md-12 content-center row">
          @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Dokumen Akta Pendirian Usaha', 
                'column'    => 'company_document',
                'data'      => !empty($data->company_document) ? $data->company_document : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'document',
                'error'     => isset($data->submission[0]) ? $data->submission[0]['error'] : '',
                'optional'  => 0, 
                  'optionDitolak' => []         
            ])
    </div>         

    <div class="col-md-12 content-center row">
          @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Dokumen Akta Perubahan Terakhir', 
                'column'    => 'company_document_change',
                'data'      => !empty($data->company_document_change) ? $data->company_document_change : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'document',
                'error'     => isset($data->submission[1]) ? $data->submission[1]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []      
            ])
    </div>           

    <div class="col-md-12 content-center row">
          @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Dokumen SK Kemenkumham', 
                'column'    => 'document_sk_kemenkumham',
                'data'      => !empty($data->document_sk_kemenkumham) ? $data->document_sk_kemenkumham : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'document',
                'error'     => isset($data->submission[2]) ? $data->submission[2]['error'] : '',
                'optional'  => 0, 
                  'optionDitolak' => []         
            ])
    </div>       
    
    <div class="col-md-12 content-center row">
          @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Dokumen NPWP Perusahaan', 
                'column'    => 'document_npwp',
                'data'      => !empty($data->document_npwp) ? $data->document_npwp : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'document',
                'error'     => isset($data->submission[3]) ? $data->submission[3]['error'] : '',
                'optional'  => 0, 
                  'optionDitolak' => []         
            ])
    </div>

    <div class="col-md-12 content-center row">
          @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'Dokumen SIUP/NIB', 
                'column'    => 'document_siup',
                'data'      => !empty($data->siup_file) ? $data->siup_file : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'document',
                'error'     => isset($data->submission[5]) ? $data->submission[5]['error'] : '',
                'optional'  => 1,
                'optionDitolak' => []     
            ])
    </div> 

    <div class="col-md-12 content-center row">
          @include('admin/kyc_bisnis/_field_confirmation', [
                'title'     => 'KTP Direktur Utama / Direksi', 
                'column'    => 'idcard_director',
                'data'      => !empty($data->idcard_director) ? $data->idcard_director : '',
                'class'     => $class,
                'readonly'  => $readonly,
                'action'    => $action,
                'type'      => 'image',
                'error'     => isset($data->submission[4]) ? $data->submission[4]['error'] : '',
                'optional'  => 0, 
                  'optionDitolak' => []         
            ])
    </div>        
</div>