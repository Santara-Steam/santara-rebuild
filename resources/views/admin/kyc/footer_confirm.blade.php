<hr class="mt-3 mb-1"/>
<div class="row py-2"> 
    <?php if (!$is_empty) : 
        if( ($action == 'edit') && ($active != 'kyc-bisnis') ):  ?>
            <div class="col-md-6">
                <button type="submit" class="btn btn-block btn-primary" >Perbaharui KYC</button> 
            </div>
        <?php else : ?>
            <div class="col-md-6">
                <a onclick="window.history.go(-1); return false;" style="cursor: pointer;color: white;" class="btn btn-block btn-warning">Kembali</a>
            </div>
            {{-- <div class='{{ $status == 'verifying' ? 'col-md-6' : 'col-md-12' }}'>
                <a onclick="window.history.go(-1); return false;" style="cursor: pointer;color: white;" class="btn btn-block btn-warning">Kembali</a>
            </div> --}}
            {{-- @if($status == 'verifying')
                <div class="col-md-6">
                    <button type="button" onClick="btnConfirm(<?= $key ?>)" class="btn btn-block btn-info submit-form-kyc">Simpan</button> 
                </div>  
            @endif --}}
            <div class="col-md-6">
                <button type="button" onClick="btnConfirm(<?= $key ?>)" class="btn btn-block btn-info submit-form-kyc">Simpan</button> 
            </div>  

        <?php endif; ?>
    <?php else: ?>
        <div class='<?= ($status == 'verifying') ? 'col-md-6' : 'col-md-12' ?> '>
            <a onclick="window.history.go(-1); return false;" style="cursor: pointer;color: white;" class="btn btn-block btn-warning">Kembali</a>
        </div>
    <?php endif; ?>
</div>