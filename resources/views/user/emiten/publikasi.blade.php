<fieldset>
    <form id="formPublication" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= ($data['publication'] != null)  ?  'update' : 'create'; ?>" />
        <input type="hidden" name="tab" value='publication' />
        <input type="hidden" name="id" value='<?= ($data['publication']) ? $data['publication_id'] : null; ?>' />
        <!-- <input type="hidden" name="uuid" value='<?= $uuid; ?>' /> -->

        <div class="card">
            <div class="card-content">
                <div class="card-body p-3">
                    <div class="mb-5">
                        <div class="row">
                            <div class="col-md-12 text-left">
                                <p>Pastikan data yang Anda input adalah data yang valid, benar, dan bisa dipertanggung jawabkan. Santara akan dengan tegas menindaklanjuti apabila ada penemuan data yang tidak sesuai. Pastikan juga bahwa data yang Anda input telah lengkap sesuai dengan persyaratan calon penerbit di Santara. </p>
                            </div>
                            <div class="col-md-12 text-center mt-3" style="height: 1000px;">
                                <iframe src="<?= ($data['publication']); ?>" style="width: 100%;height: 100%;border: none;"></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="mt-0">
                        <div class="row">
                            <div class="text-left col-md-6 mb-1">
                                <a href="{{url("user/penerbit/bisnisdetail")}}/<?= $uuid; ?>" class="btn btn-santara-white btn-block">Kembali</a>
                            </div>
                            <div class="text-right col-md-6 mb-1">
                                <button type="button" class="btn btn-santara-red btn-block" onClick="submitReport('formPublication', 'publication', '<?= $uuid; ?>')" <?= ($data['publication']) ? '' : 'disabled'; ?>>Publikasikan Laporan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</fieldset>