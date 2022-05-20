<fieldset>
    <form id="formStrategy" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= ($data['strategy'] != null)  ?  'update' : 'create'; ?>" />
        <input type="hidden" name="tab" value='strategy' />
        <input type="hidden" name="id" value='<?= ($data['strategy']) ? $data['strategy']['data']['id'] : null; ?>' />
        <!-- <input type="hidden" name="uuid" value='<?= $uuid; ?>' /> -->

        <div class="card">
            <div class="card-content">
                <div class="card-body p-1">
                @include('user.emiten.periode_laporan', [
                        'month'         => isset($data['strategy']['data']['month']) ? $data['strategy']['data']['month'] : '',
                        'year'          => isset($data['strategy']['data']['year']) ? $data['strategy']['data']['year'] : '',
                        'version'       => isset($data['strategy']['data']['version']) ? $data['strategy']['data']['version'] : '',
                        'version_desc'  => isset($data['strategy']['data']['version_desc']) ? $data['strategy']['data']['version_desc'] : ''
                    ])
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body p-3">
                    <div class="mb-5">
                        <div class="mb-2">
                            <h4><b>A. Strategi Perusahaan</b></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proposalTitle1"><b>Tampilkan strategi perusahaan dalam laporan ?</b></label>
                                    <div class="radio d-block">
                                        <input type="radio" id="show_strategy_yes" name="show_strategy" class="show_strategy" value="1" <?= (isset($data['strategy']['data']['show_strategy']) && $data['strategy']['data']['show_strategy'] == 1) ? 'checked' : '' ?>>
                                        <label>Ya, Tampilkan dalam laporan</label>
                                        <br />
                                        <input type="radio" id="show_strategy_no" name="show_strategy" class="show_strategy" value="0" <?= (isset($data['strategy']['data']['show_strategy']) && $data['strategy']['data']['show_strategy'] == 0) ? 'checked' : '' ?>>
                                        <label>Tidak, Jangan tampilkan dalam laporan</label>
                                    </div>
                                </div>

                                <div class="show_strategy_content">

                                    <?php if ((!isset($data['strategy']['data']['id'])) || $data['strategy']['data']['id'] == null) : ?>
                                        <div class="mb-2">
                                            <div class="alert alert-info-dashboard penerbit-info-report col-md-12">
                                                <h4><b>Anda belum membuat laporan keuangan</b></h4>
                                                <p>Mohon melengkapi data Laporan Keuangan </p>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <?php if (isset($data['strategy']['data']['strategys']) && (count($data['strategy']['data']['strategys']) > 0)) : ?>
                                            <?php foreach ($data['strategy']['data']['strategys'] as $key => $value) : ?>
                                                <input type="hidden" name="file_strategy_name[]" value="<?= $value['file_name']; ?>" />
                                                <div class="p-1 content-center mb-1" style="border:1px dashed #cacfe7 !important">
                                                    <div class="col-2">
                                                        <img src="<?= $value['image'] ?>" onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';" class="w-100 h-100 media-image">
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="form-group row">
                                                            <div class="col-10">
                                                                <input type="file" class="file-input file-image w-100" name="strategy_image[]" accept="image/*">
                                                            </div>
                                                            <div class="col-2 row" style="display: flex;align-items: flex-end;">
                                                                <label class="checkbox-container">Hapus
                                                                    <input type="checkbox" name="image_strategy_delete[]" value="<?= $value['file_name'] ?>">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-1 mb-0 w-100">
                                                            <textarea class="form-control required-form" rows="4" cols="50" name="strategy_desc[]" placeholder="Tuliskan deskripsi"><?= $value['desc'] ?></textarea>
                                                        </div>
                                                        <small><i>* Deskripsi hanya bisa di ubah jika disertai upload file gambar</i></small>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <div class="strategy_row_new row" id="strategy_row_new"></div>

                                        <div class="row mb-1">
                                            <div class="form-group col-12">
                                                <a id="strategy_image_add" class="btn btn-santara-white pull-left">Tambah</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <label><b>Video Profil Tentang Usaha Anda</b></label>
                                        <?php
                                        if (isset($data['strategy']['data']['strategy_video'])) :
                                            $url = $data['strategy']['data']['strategy_video'];
                                            if (strpos($url, 'youtube') > 0) :
                                                preg_match_all('#(?<=v=|v\/|vi=|vi\/|youtu.be\/)[a-zA-Z0-9_-]{11}#', $url, $youtube_id);
                                        ?>
                                                <div class="row mb-1 col-12">
                                                    <img src="https://img.youtube.com/vi/<?= $youtube_id[0][0]; ?>/0.jpg" onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png'" class="w-20 h-20 media-image">
                                                </div>
                                        <?php
                                            endif;
                                        endif; ?>
                                        <input type="text" class="form-control" id="strategy_video" name="strategy_video" placeholder="Masukan link video youtube" value="<?= (isset($data['strategy']['data']['strategy_video']) && $data['strategy']['data']['strategy_video']) ? $data['strategy']['data']['strategy_video'] : '' ?>">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <div class="mb-2">
                            <h4><b>B. Perkembangan Outlet</b></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proposalTitle1"><b>Tampilkan perkembangan outlet dalam laporan ?</b></label>
                                    <div class="radio d-block">
                                        <input type="radio" id="show_growth_yes" name="show_growth" class="show_growth" value="1" <?= ((isset($data['strategy']['data']['show_growth'])) && $data['strategy']['data']['show_growth'] == 1) ? 'checked' : '' ?>>
                                        <label>Ya, Tampilkan dalam laporan</label>
                                        <br />
                                        <input type="radio" id="show_growth_no" name="show_growth" class="show_growth" value="0" <?= ((isset($data['strategy']['data']['show_growth'])) && $data['strategy']['data']['show_growth'] == 0) ? 'checked' : '' ?>>
                                        <label>Tidak, Jangan tampilkan dalam laporan</label>
                                    </div>
                                </div>

                                <div class="show_growth_content">

                                    <?php if ((!isset($data['strategy']['data']['id'])) || $data['strategy']['data']['id'] == null) : ?>
                                        <div class="mb-2">
                                            <div class="alert alert-info-dashboard penerbit-info-report col-md-12">
                                                <h4><b>Anda belum membuat laporan keuangan</b></h4>
                                                <p>Mohon melengkapi data Laporan Keuangan </p>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <?php if (isset($data['strategy']['data']['growths']) && (count($data['strategy']['data']['growths']) > 0)) : ?>
                                            <?php foreach ($data['strategy']['data']['growths'] as $key => $value) : ?>
                                                <input type="hidden" name="file_growth_name[]" value="<?= $value['file_name']; ?>" />
                                                <div class="p-1 content-center mb-1" style="border:1px dashed #cacfe7 !important">
                                                    <div class="col-2">
                                                        <img src="<?= $value['image'] ?>" onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';" class="w-100 h-100 media-image">
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="form-group row">
                                                            <div class="col-10">
                                                                <input type="file" class="file-input file-image w-100" name="growth_image[]" accept="image/*">
                                                            </div>
                                                            <div class="col-2 row" style="display: flex;align-items: flex-end;">
                                                                <label class="checkbox-container">Hapus
                                                                    <input type="checkbox" name="image_growth_delete[]" value="<?= $value['file_name'] ?>">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-1 mb-0 w-100">
                                                            <textarea class="form-control required-form" rows="4" cols="50" name="growth_desc[]" placeholder="Tuliskan deskripsi"><?= $value['desc'] ?></textarea>
                                                        </div>
                                                        <small><i>* Deskripsi hanya bisa di ubah jika disertai upload file gambar</i></small>
                                                    </div>
                                                </div>

                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <div class="growth_row_new row" id="growth_row_new"></div>

                                        <div class="row mb-1">
                                            <div class="form-group col-12">
                                                <a id="growth_image_add" class="btn btn-santara-white pull-left">Tambah</a>
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
                                <a href="{{url("penerbit/bisnisdetail")}}/<?= $uuid; ?>" class="btn btn-santara-white btn-block">Kembali</a>
                            </div>
                            <div class="text-right col-md-6 mb-1">
                                <button type="button" class="btn btn-santara-red btn-block" onClick="submitReport('formStrategy', null, '<?= $uuid; ?>')">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</fieldset>