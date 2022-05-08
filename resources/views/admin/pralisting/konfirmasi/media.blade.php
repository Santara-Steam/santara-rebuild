<fieldset>
    <div class="row">
        <label for="pictures">Media *</label>
        <?php if( $type == 'konfirmasi' || $type == 'edit') : ?>
        <div class="col-md-12 row">
            <?php 
            $pictures = $emiten->pictures;
            foreach ( $pictures as $key => $value ) : ?>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card text-white">
                    <img src="<?= config('global.BASE_API_FILE') . '/uploads/emiten_picture/' . $value ?>"
                        class="d-block w-100 media-image"
                        onerror="this.onerror=null;this.src='<?= config('global.STORAGE_GOOGLE')  ?>token/avatar.png';">

                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if( $type == 'edit' ) : ?>
        <div class="col-md-12 mt-2" ?>
            <div class="form-group">
                <input type="file" class="form-control-file" name="pictures[]" id="pictures" accept="image/*" multiple />
                <div id="errorBlockPictures" class="help-block" style="padding:10px; margin: 10px 0"></div>
                <br />
                <p style="font-size: 11px;"><i class="la la-info-circle"></i> Pastikan file dalam bentuk PNG, JPG, JPEG
                    atau GIF</p>
                <p style="font-size: 11px;"><i class="la la-info-circle"></i> Ukuran file maksimal 20 Mb</p>
            </div>
        </div>
        <?php endif; ?>

        <?php else: ?>
        <div class="col-md-12">
            <div class="form-group">
                <input type="file" class="form-control-file" name="pictures[]" id="pictures" accept="image/*" multiple
                    required />
                <label id="pictures_error" class="font-danger" for="pictures_error" style="display:none;">Mohon pilih
                    gambar terlebih dahulu</label>
                <div id="errorBlockPictures" class="help-block" style="padding:10px; margin: 10px 0"></div>
                <br />
                <p style="font-size: 11px;"><i class="la la-info-circle"></i> Pastikan file dalam bentuk PNG, JPG, JPEG
                    atau GIF</p>
                <p style="font-size: 11px;"><i class="la la-info-circle"></i> Ukuran file maksimal 20 Mb</p>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="video_url">Video Tentang Usaha Anda *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                <?php if ( isset($emiten) && ($emiten->video_url) ) : ?>
                <a href="<?= $emiten->video_url ?>" class="btn btn-sm btn-info btn-block mt-0 mr-0 mb-0"
                    target="_blank">
                    <i class="la la-play-circle"></i><span style="position: relative; top: -2px; left: 5px;">Lihat
                        Video</span>
                </a>
                <?php else: ?>
                <a class="btn btn-info-ghost btn-block disabled">Tidak ada file video</a>
                <?php endif; ?>

                <?php else: ?>
                <br />
                <small>Masukan link video tentang usaha Anda ( Youtube )</small>
                <input type="text" class="form-control" name="video_url" id="video_url"
                    value="<?= isset($emiten) ? $emiten->video_url : '' ?>" placeholder="Masukan link video">
                <label id="video_link_url_error" class="font-danger" for="video_link_url_error"
                    style="display:none;">Mohon masukan url youtube yang valid</label>
                <span id="video_url_error" class="font-danger"></span>
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
                onclick="updatePraListing('<?= $emiten->uuid ?>','update-media')"> Simpan Perubahan </a>
        </div>
    </div>
    <?php endif; ?>
</fieldset>

<div id="profileVideoModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content modal-detail">
            <div class="modal-body">
                <iframe id="profileVideo" width="100%" height="315"
                    src="<?= isset($emiten) ? $emiten->video_url : '' ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="modal-footer" style="border-top: none;padding-top: 0;">
                <a class="btn btn-sm btn-info btn-block mt-0 mr-0 mb-0" data-dismiss="modal"
                    aria-hidden="true">Tutup</a>
            </div>
        </div>
    </div>
</div>
