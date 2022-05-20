<fieldset>
    <form id="formOther" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= ($data['other'] != null) ?  'update' : 'create'; ?>" />
        <input type="hidden" name="tab" value='other' />
        <input type="hidden" name="id" value='<?= ($data['other']) ? $data['other']['data']['id'] : null; ?>' />
        <!-- <input type="hidden" name="uuid" value='<?= $uuid; ?>' /> -->

        <div class="card">
            <div class="card-content">
                <div class="card-body p-1">
                    @include('user.emiten.periode_laporan', [
                        'month'         => isset($data['other']['data']['month']) ? $data['other']['data']['month'] : '',
                        'year'          => isset($data['other']['data']['year']) ? $data['other']['data']['year'] : '',
                        'version'       => isset($data['other']['data']['version']) ? $data['other']['data']['version'] : '',
                        'version_desc'  => isset($data['other']['data']['version_desc']) ? $data['other']['data']['version_desc'] : ''
                    ])
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body p-3">
                    <div class="mb-5">
                        <div class="mb-2">
                            <h4><b>A. Pencatatan Pemodal Dalam Akta Perusahaan</b></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proposalTitle1"><b>Tampilkan pencatatan pemodal dalam akta perusahaan dalam laporan ?</b></label>
                                    <div class="radio d-block">
                                        <input type="radio" id="show_deed_yes" name="show_deed" class="show_deed" value="1" <?= (($data['other']) && $data['other']['data']['show_deed'] == 1) ? 'checked' : '' ?>>
                                        <label>Ya, Tampilkan dalam laporan</label>
                                        <br />
                                        <input type="radio" id="show_deed_no" name="show_deed" class="show_deed" value="0" <?= (($data['other']) && $data['other']['data']['show_deed'] == 0) ? 'checked' : '' ?>>
                                        <label>Tidak, Jangan tampilkan dalam laporan</label>
                                    </div>
                                </div>

                                <div class="show_deed_content">
                                    <?php if ((!isset($data['other']['data']['id'])) || $data['other']['data']['id'] == null) : ?>
                                        <div class="mb-2">
                                            <div class="alert alert-info-dashboard penerbit-info-report col-md-12">
                                                <h4><b>Anda belum membuat laporan keuangan</b></h4>
                                                <p>Mohon melengkapi data Laporan Keuangan </p>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <?php if (isset($data['other']['data']['deeds']) && (count($data['other']['data']['deeds']) > 0)) : ?>
                                            <?php foreach ($data['other']['data']['deeds'] as $key => $value) : ?>
                                                <input type="hidden" name="file_deed_name[]" value="<?= $value['file_name']; ?>" />

                                                <div class="p-1 content-center mb-1" style="border:1px dashed #cacfe7 !important">
                                                    <div class="col-2">
                                                        <img src="<?= $value['image'] ?>" onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';" class="w-100 h-100 media-image">
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="form-group row">
                                                            <div class="col-10">
                                                                <input type="file" class="file-input file-image w-100" name="deeds_image[]" accept="image/*">
                                                            </div>
                                                            <div class="col-2 row" style="display: flex;align-items: flex-end;">
                                                                <label class="checkbox-container">Hapus
                                                                    <input type="checkbox" name="image_deed_delete[]" value="<?= $value['file_name'] ?>">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-1 mb-0 w-100">
                                                            <textarea class="form-control required-form" rows="4" cols="50" name="deeds_desc[]" placeholder="Tuliskan deskripsi"><?= $value['desc'] ?></textarea>
                                                        </div>
                                                        <small><i>* Deskripsi hanya bisa di ubah jika disertai upload file gambar</i></small>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <div class="deeds_row_new row" id="deeds_row_new"></div>

                                        <div class="row mb-1">
                                            <div class="form-group col-12">
                                                <a id="deeds_image_add" class="btn btn-santara-white pull-left">Tambah</a>
                                            </div>
                                        </div>

                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <div class="mb-2">
                            <h4><b>B. Distribusi Efek Melalui KSEI</b></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proposalTitle1"><b>Tampilkan distribusi efek melalui KSEI dalam laporan ?</b></label>
                                    <div class="radio d-block">
                                        <input type="radio" id="show_ksei_yes" name="show_ksei" class="show_ksei" value="1" <?= (($data['other']) && $data['other']['data']['show_ksei'] == 1) ? 'checked' : '' ?>>
                                        <label>Ya, Tampilkan dalam laporan</label>
                                        <br />
                                        <input type="radio" id="show_ksei_no" name="show_ksei" class="show_ksei" value="0" <?= (($data['other']) && $data['other']['data']['show_ksei'] == 0) ? 'checked' : '' ?>>
                                        <label>Tidak, Jangan tampilkan dalam laporan</label>
                                    </div>
                                </div>

                                <div class="show_ksei_content">
                                    <?php if ((!isset($data['other']['data']['id'])) || $data['other']['data']['id'] == null) : ?>
                                        <div class="mb-2">
                                            <div class="alert alert-info-dashboard penerbit-info-report col-md-12">
                                                <h4><b>Anda belum membuat laporan keuangan</b></h4>
                                                <p>Mohon melengkapi data Laporan Keuangan </p>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <?php if (isset($data['other']['data']['kseis']) && (count($data['other']['data']['kseis']) > 0)) : ?>
                                            <?php foreach ($data['other']['data']['kseis'] as $key => $value) : ?>
                                                <input type="hidden" name="file_ksei_name[]" value="<?= $value['file_name']; ?>" />

                                                <div class="p-1 content-center mb-1" style="border:1px dashed #cacfe7 !important">
                                                    <div class="col-2">
                                                        <img src="<?= $value['image'] ?>" onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';" class="w-100 h-100 media-image">
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="form-group row">
                                                            <div class="col-10">
                                                                <input type="file" class="file-input file-image w-100" name="kseis_image[]">
                                                            </div>
                                                            <div class="col-2 row" style="display: flex;align-items: flex-end;">
                                                                <label class="checkbox-container">Hapus
                                                                    <input type="checkbox" name="image_ksei_delete[]" value="<?= $value['file_name'] ?>">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-1 mb-0 w-100">
                                                            <textarea class="form-control required-form" rows="4" cols="50" name="kseis_desc[]" placeholder="Tuliskan deskripsi"><?= $value['desc'] ?></textarea>
                                                        </div>
                                                        <small><i>* Deskripsi hanya bisa di ubah jika disertai upload file gambar</i></small>
                                                    </div>
                                                </div>

                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <div class="kseis_row_new row" id="kseis_row_new"></div>

                                        <div class="row mb-1">
                                            <div class="form-group col-12">
                                                <a id="kseis_image_add" class="btn btn-santara-white pull-left">Tambah</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="row">
                            <div class="text-left col-md-6 mb-1">
                                <a href="{{url("penerbit/bisnisdetail")}}/?= $uuid; ?>" class="btn btn-santara-white btn-block">Kembali</a>
                            </div>
                            <div class="text-right col-md-6 mb-1">
                                <button type="button" class="btn btn-santara-red btn-block" onClick="submitReport('formOther', null, '<?= $uuid; ?>')">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</fieldset>