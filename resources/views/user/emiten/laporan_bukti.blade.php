<fieldset>
    <form id="formManual" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= ($data['manual'] != null) ?  'update' : 'create'; ?>" />
        <input type="hidden" name="tab" value='manual' />
        <input type="hidden" name="id" value='<?= ($data['manual']) ? $data['manual']['data']['id'] : null; ?>' />
        <!-- <input type="hidden" name="uuid" value='<?= $uuid; ?>' /> -->

        <div class="card">
            <div class="card-content">
                <div class="card-body p-1">
                    @include('user.emiten.periode_laporan', [
                        'month'         => isset($data['manual']['data']['month']) ? $data['manual']['data']['month'] : '',
                        'year'          => isset($data['manual']['data']['year']) ? $data['manual']['data']['year'] : '',
                        'version'       => isset($data['manual']['data']['version']) ? $data['manual']['data']['version'] : '',
                        'version_desc'  => isset($data['manual']['data']['version_desc']) ? $data['manual']['data']['version_desc'] : ''
                    ])
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body p-3">
                    <?php if ((!isset($data['manual']['data']['id'])) || $data['manual']['data']['id'] == null) : ?>
                        <div class="mb-2">
                            <div class="alert alert-info-dashboard penerbit-info-report col-md-12">
                                <h4><b>Anda belum membuat laporan keuangan</b></h4>
                                <p>Mohon melengkapi data Laporan Keuangan </p>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php if (isset($data['manual']['data']['logo'])) : ?>
                            <input type="hidden" name="file_logo_name" value="<?= $data['manual']['data']['logo_file_name']; ?>" />
                            <div class="col-md-12 mt-3 mb-1 p-0">
                                <img src="<?= $data['manual']['data']['logo'] ?>" onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';" class="w-10 h-10 media-image">
                            </div>
                        <?php endif; ?>
                        <div class="row mb-5">
                            <div class="form-group col-md-12">
                                <label><b>Logo</b></label>
                                <input type="file" class="custom-file-input file-image" name="logo" placeholder="Upload logo" accept=".png" />
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="form-group col-md-12">
                                <label><b>Laporan Keuangan Manual</b></label>
                                <p><small>Dimohon untuk melampirkan laporan keuangan perusahaan Anda. Laporan keuangan diunggah dalam format PDF, ukuran maksimal file 5MB.</small></p>
                                <?php if (isset($data['manual']['data']['manual']) && (count($data['manual']['data']['manual']) > 0)) : ?>
                                    <div class="col-md-12 mb-1 row">
                                        <p>
                                            <a href="<?= end($data['manual']['data']['manual'])['image']; ?>" title="unduh" class="btn btn-santara-white" target="_blank">Lihat Laporan Keuangan</a>
                                            <a type="button" class="btn btn-santara-white" onClick="deleteDocument(<?= $data['manual']['data']['id']; ?>,'<?= end($data['manual']['data']['manual'])['file_name']; ?>')"><i class="la la-trash"></i></a>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="file-document" id="manual_report" name="manual_report" accept="application/pdf" />
                            </div>
                        </div>

                        <div class="form-group col-md-12 row">
                            <label><b>Foto Operasional & Bukti Transaksi (Screenshot dari POS)</b></label>
                        </div>

                        <?php if (isset($data['manual']['data']['pos']) && (count($data['manual']['data']['pos']) > 0)) : ?>
                            <?php foreach ($data['manual']['data']['pos'] as $key => $value) : ?>
                                <input type="hidden" name="file_pos_name[]" value="<?= $value['file_name']; ?>" />
                                <div class="p-1 content-center mb-1" style="border:1px dashed #cacfe7 !important">
                                    <div class="col-2">
                                        <img src="<?= $value['image'] ?>" onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';" class="w-100 h-100 media-image">
                                    </div>
                                    <div class="col-10">
                                        <div class="form-group row">
                                            <div class="col-10">
                                                <input type="file" class="file-input file-image w-100" name="pos_image[]" accept="image/*">
                                            </div>
                                            <div class="col-2 row" style="display: flex;align-items: flex-end;">
                                                <label class="checkbox-container">Hapus
                                                    <input type="checkbox" name="image_pos_delete[]" value="<?= $value['file_name'] ?>">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1 mb-0 w-100">
                                            <textarea class="form-control required-form" rows="4" cols="50" name="pos_desc[]" placeholder="Tuliskan deskripsi"><?= $value['desc'] ?></textarea>
                                        </div>
                                        <small><i>* Deskripsi hanya bisa di ubah jika disertai upload file gambar</i></small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <div class="pos_row_new row" id="pos_row_new"></div>

                        <div class="row mb-1">
                            <div class="form-group col-12">
                                <a id="pos_image_add" class="btn btn-santara-white pull-left">Tambah</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mt-0">
                        <div class="row">
                            <div class="text-left col-md-6 mb-1">
                                <a href="{{url("penerbit/bisnisdetail")}}/<?= $uuid; ?>" class="btn btn-santara-white btn-block">Kembali</a>
                            </div>
                            <div class="text-right col-md-6 mb-1">
                                <button type="button" class="btn btn-santara-red btn-block" onClick="submitReport('formManual', null, '<?= $uuid; ?>')">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</fieldset>