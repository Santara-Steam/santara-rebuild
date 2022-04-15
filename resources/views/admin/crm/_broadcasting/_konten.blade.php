<fieldset>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="text" class="form-control" name="konten_date"
                    value="<?= isset($broadcast['date']) ? $broadcast['date'] : '' ?>" id="konten_date"
                    maxlength="20" />
                <span id="konten_date_error" class="font-danger"></span>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="tanggal">Jam</label>
                <input type="text" class="form-control" name="konten_time"
                    value="<?= isset($broadcast['time']) ? $broadcast['time'] : '' ?>" id="konten_time"
                    maxlength="20" />
                <span id="konten_date_error" class="font-danger"></span>
            </div>
        </div>
    </div>

    <?php if(false): ?>
    <div class="row">
        <div class="col-6">
            <label class="d-flex">
                <input type="checkbox" nvalue="1" id="konten_type" name="konten_type" value="1"
                    class="col-1">Aktifkan Split Testing
            </label>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="name">Nama Broadcast</label>
                <input type="text" class="form-control" name="konten_title" id="konten_title"
                    value="<?= isset($broadcast['name']) ? $broadcast['name'] : '' ?>" maxlength="50"
                    placeholder="Penerbit Baru PT. ABC" />
                <span id="konten_title_error" class="font-danger"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="konten_broadcast_categories_id">Kategori</label>
                <select name="konten_broadcast_categories_id" id="category" class="form-control">
                    <?php if($type == 'update') : ?>
                    <option selected value="<?= $broadcast['broadcast_category_id'] ?>">
                        <?= $broadcast['broadcast_category_name'] ?> </option>
                    <?php else: ?>
                    <option disabled selected>Pilih</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
    </div>
    <hr />

    <div class="row">
        <div class="col-6" id="split_1">
            <input type="hidden" class="broadcast_target_group_id" name="data[0][broadcast_target_group_id]"
                value="<?= isset($broadcast['list'][0]) ? $broadcast['list'][0]['broadcast_target_group_id'] : '' ?>" />
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">Judul Konten</label>
                        <input type="text" class="form-control" name="data[0][title]" id="data_title" maxlength="50"
                            value="<?= isset($broadcast['list'][0]) ? $broadcast['list'][0]['title'] : '' ?>"
                            placeholder="Penawaran saham PT. ABC telah dibuka" />
                        <span id="data_title_error" class="font-danger"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="konten">Konten</label>
                        <textarea class="form-control" rows="7" cols="50" name="data[0][content]" id="data_content"
                            placeholder="Hi @call @user, Penawaran saham PT. ABC telah dibuka"><?= isset($broadcast['list'][0]) ? $broadcast['list'][0]['content'] : '' ?></textarea>
                        <span id="data_content_error" class="font-danger"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="foto">Foto ( Optional )</label>
                        <input type="hidden" name="data[0][filename]" id="filename_0"
                            value="<?= isset($broadcast['list'][0]) ? $broadcast['list'][0]['file_name'] : '' ?>" />
                        <?php if($type == 'update') : ?>
                        <div class="row col-12 p-1">
                            <img src="<?= isset($broadcast['list'][0]) ? $broadcast['list'][0]['image'] : '' ?>"
                                onerror="this.onerror=null;this.src='<?= STORAGE_GOOGLE ?>token/avatar.png';"
                                class="img-thumbnail" width="200" />
                        </div>
                        <?php endif; ?>
                        <input type="file" class="form-control-file" name="data_image[]" id="data_image_0"
                            accept="image/*" />
                        <div id="errorBlockFoto" class="help-block" style="padding:10px; margin: 10px 0"></div>
                        <br />
                        <p style="font-size: 11px;"><i class="la la-info-circle"></i> Pastikan file dalam bentuk PNG,
                            JPG, JPEG atau GIF</p>
                        <p style="font-size: 11px;"><i class="la la-info-circle"></i> Ukuran file maksimal 10 Mb</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="redirection">Redirection</label>
                        <input type="text" class="form-control" name="data[0][redirection]" id="data_redirection"
                            maxlength="50"
                            value="<?= isset($broadcast['list'][0]) ? $broadcast['list'][0]['redirection'] : '' ?>"
                            placeholder="Masukan Link" />
                        <span id="redirection_error" class="font-danger"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 hidden" id="split_2">
            <input type="hidden" class="broadcast_target_group_id" name="data[1][broadcast_target_group_id]" />
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">Judul Konten</label>
                        <input type="text" class="form-control" name="data[1][title]" id="data_title" maxlength="50"
                            placeholder="Penawaran saham PT. ABC telah dibuka" />
                        <span id="data_title_error" class="font-danger"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="konten">Konten</label>
                        <textarea class="form-control" rows="7" cols="50" name="data[1][content]" id="data_content"
                            placeholder="Hi @call @user, Penawaran saham PT. ABC telah dibuka"></textarea>
                        <span id="data_content_error" class="font-danger"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="foto">Foto ( Optional )</label>
                        <input type="hidden" name="data[1][filename]" id="filename_1"
                            value="<?= isset($broadcast['list'][1]) ? $broadcast['list'][1]['file_name'] : '' ?>" />
                        <?php if($type == 'update') : ?>
                        <div class="row col-12 p-1">
                            <img src="<?= isset($broadcast['list'][1]) ? $broadcast['list'][1]['image'] : '' ?>"
                                onerror="this.onerror=null;this.src='<?= STORAGE_GOOGLE ?>token/avatar.png';"
                                class="img-thumbnail" width="200" />
                        </div>
                        <?php endif; ?>

                        <input type="file" class="form-control-file" name="data_image[]" id="data_image_1"
                            accept="image/*" />
                        <div id="errorBlockFoto" class="help-block" style="padding:10px; margin: 10px 0"></div>
                        <br />
                        <p style="font-size: 11px;"><i class="la la-info-circle"></i> Pastikan file dalam bentuk PNG,
                            JPG, JPEG atau GIF</p>
                        <p style="font-size: 11px;"><i class="la la-info-circle"></i> Ukuran file maksimal 10 Mb</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="redirection">Redirection</label>
                        <input type="text" class="form-control" name="data[1][redirection]" id="data_redirection"
                            maxlength="50" placeholder="Masukan Link" />
                        <span id="redirection_error" class="font-danger"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>

<script>
    $("#category").select2({
        placeholder: "Contoh: Nama Kategori",
        closeOnSelect: false,
        allowClear: true,
        delay: 250, // wait 250 milliseconds before triggering the request
        ajax: {
            type: 'GET',
            url: '{{ url('admin/crm/get-category') }}',
            dataType: "json",
            processResults: function(data) {
                var results = [];
                $.each(data, function(index, item) {
                    results.push({
                        id: item.id,
                        text: item.name,
                        value: item.id
                    })
                })
                return {
                    results: results
                };
            }
        }
    });

    $("#konten_date").flatpickr({
        enableTime: false,
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d",
        minDate: "today"
    });

    $("#konten_time").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });

    $("#data_image_0").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'showPreview': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'elErrorContainer': "#errorBlockImages"
    });

    $("#data_image_1").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'showPreview': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'elErrorContainer': "#errorBlockImages"
    });

    $("#konten_type").change(function() {
        const split_2 = document.getElementById('split_2');

        if ($(this).is(":checked")) {
            split_2.classList.remove('hidden');
        } else {
            split_2.classList.add('hidden');
        }
    });
</script>
