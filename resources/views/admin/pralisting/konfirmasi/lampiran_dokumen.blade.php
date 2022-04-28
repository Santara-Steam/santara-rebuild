<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="prospektus">Prospektus (PDF) *</label>
                <?php if( $type == 'konfirmasi' ||  $type == 'edit' ) : ?>
                <a href="<?= config('global.BASE_API_FILE') . '/uploads/prospektus/' . $emiten->prospektus ?>"
                    class="btn btn-info-ghost btn-block <?= !$emiten->prospektus ? 'disabled' : '' ?>" title="Download"
                    target="_blank">
                    <?= $emiten->prospektus ? 'Download' : 'File tidak tersedia' ?>
                </a>
                <?php if( $type == 'edit' ) : ?>
                <div class="mt-2" ?>
                    <input type="file" class="form-control-file" name="prospektus" id="prospektus"
                        accept="application/pdf" />
                    <label id="prospektus_error" class="font-danger" for="prospektus_error"
                        style="display:none;">Mohon pilih dokumen prospektus terlebih dahulu</label>
                    <div id="errorBlockProspektus" class="help-block" style="padding:10px; margin: 10px 0"></div>
                    <br />
                    <p style="font-size: 11px;"><i class="la la-info-circle"></i> Tulisan harus berbahasa Indonesia dan
                        terbaca dengan jelas</p>
                    <p style="font-size: 11px;"><i class="la la-info-circle"></i> Pastikan file dalam bentuk PDF</p>
                    <p style="font-size: 11px;"><i class="la la-info-circle"></i> Ukuran file maksimal 25 Mb</p>
                </div>
                <?php endif; ?>

                <?php else: ?>
                <input type="file" class="form-control-file" name="prospektus" id="prospektus" accept="application/pdf"
                    required />
                <label id="prospektus_error" class="font-danger" for="prospektus_error" style="display:none;">Mohon
                    pilih dokumen prospektus terlebih dahulu</label>
                <div id="errorBlockProspektus" class="help-block" style="padding:10px; margin: 10px 0"></div>
                <br />
                <p style="font-size: 11px;"><i class="la la-info-circle"></i> Tulisan harus berbahasa Indonesia dan
                    terbaca dengan jelas</p>
                <p style="font-size: 11px;"><i class="la la-info-circle"></i> Pastikan file dalam bentuk PDF</p>
                <p style="font-size: 11px;"><i class="la la-info-circle"></i> Ukuran file maksimal 25 Mb</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if( $type == "edit") : ?>
    <div class="row my-2">
        <div class="col-md-6 col-12">
            <a class="btn btn-block btn-danger-ghost" href="<?= site_url('user/pralisting/list') ?>"> Kembali </a>
        </div>
        <div class="col-md-6 col-12">
            <a class="btn btn-block btn-danger font-link-white"
                onclick="updatePraListing('<?= $emiten->uuid ?>','update-prospektus')"> Simpan Perubahan </a>
        </div>
    </div>
    <?php endif; ?>

</fieldset>
