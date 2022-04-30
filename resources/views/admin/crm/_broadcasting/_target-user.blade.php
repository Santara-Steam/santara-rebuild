<fieldset>
    <input type="hidden" name="id" id="id" value="<?= isset($target['id']) ? $target['id'] : '' ?>" />
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="form-group">
                <input type="text" class="<?= isset($target['id']) ? 'form-control-plaintext' : 'form-control' ?> "
                    name="target_name" id="target_name" maxlength="40"
                    value="<?= isset($target['name']) ? $target['name'] : '' ?>" placeholder="Target User Baru">
                <span id="name_error" class="font-danger"></span>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="form-group">
                <select id="kondisi" onchange="changeKondisi()" class="form-control">
                    <option disabled selected value="">Tambah Kondisi</option>
                    <option value="1">Status KYC</option>
                    <option value="2">Gender</option>
                    <option value="3">Umur</option>
                    <option value="4">Pendapatan Per Tahun</option>
                    <option value="5">Kota / Kabupaten</option>
                    <option value="6">Provinsi</option>
                    <option value="7">Kepemilikan Saham</option>
                    <option value="8">Jumlah Saham (Rp)</option>
                    <option value="9">Jumlah Saham (Count)</option>
                    <option value="10">Sisa Limit Investasi</option>
                    <option value="11">Rata-rata Pembelian</option>
                    <option value="12">Deposit</option>
                    <option value="13">SID</option>
                    <option value="14">Versi Android</option>
                    <option value="15">Versi IOS</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <a type="button" href="{{ url('admin/crm/target-user-tersedia') }}"
                class="btn btn-block btn-santara-red">Buat target berdasar target tersedia</a>
        </div>
    </div>

    <div class="row">
        <div id="container_target" style="height: auto" class="col-12">
            <div class="row my-3">
                <div class="col-12 <?= isset($target['list'][1]) ? '' : 'hidden' ?>" id="kondisi_1">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Status KYC</h4>
                            <div class="my-1 hidden" id="input_1">
                                <div><input style="width: auto;margin-right: 1rem;" type="radio" class="input_1"
                                        name="status" value="1"
                                        <?= isset($target['list'][1]) ? ($target['list'][1] == 1 ? 'checked' : '') : '' ?>><label>Sudah
                                        KYC</label></div>
                                <div><input style="width: auto;margin-right: 1rem;" type="radio" class="input_1"
                                        name="status" value="0"
                                        <?= isset($target['list'][1]) ? ($target['list'][1] == 0 ? 'checked' : '') : '' ?>><label>Belum
                                        KYC</label> </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(1)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(1, 'radio')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][1]) ? '' : 'hidden' ?>" id="result_1">
                                <input type="hidden" id="target_1" name="target[1]"
                                    value="<?= isset($target['list'][1]) ? $target['list'][1] : '' ?>" />
                                <p><b
                                        id="el_1"><?= isset($target['list'][1]) ? ($target['list'][1] == 1 ? 'Sudah KYC' : 'Belum KYC') : '' ?></b>
                                </p>
                                <a href="#" class="card-link" onClick="editKondisi(1)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(1)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][2]) ? '' : 'hidden' ?>" id="kondisi_2">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Gender</h4>
                            <div class="my-1 hidden" id="input_2">
                                <div><input style="width: auto;margin-right: 1rem;" type="radio" class="input_2"
                                        name="gender" value="m"
                                        <?= isset($target['list'][2]) ? ($target['list'][2] == 'm' ? 'checked' : '') : '' ?>><label>Laki-laki</label>
                                </div>
                                <div><input style="width: auto;margin-right: 1rem;" type="radio" class="input_2"
                                        name="gender" value="f"
                                        <?= isset($target['list'][2]) ? ($target['list'][2] == 'f' ? 'checked' : '') : '' ?>><label>Perempuan</label>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(2)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(2, 'radio')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][2]) ? '' : 'hidden' ?>" id="result_2">
                                <input type="hidden" id="target_2" name="target[2]"
                                    value="<?= isset($target['list'][2]) ? $target['list'][2] : '' ?>" />
                                <p><b
                                        id="el_2"><?= isset($target['list'][2]) ? ($target['list'][2] == 'f' ? 'Perempuan' : 'Laki-laki') : '' ?></b>
                                </p>
                                <a href="#" class="card-link" onClick="editKondisi(2)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(2)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][3]) ? '' : 'hidden' ?>" id="kondisi_3">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Umur</h4>
                            <div class="my-1 hidden" id="input_3">
                                <div class="pr-1"><input type="text" id="input_3_start"
                                        class="form-control input_3"
                                        value="<?= isset($target['list'][3]) ? explode('-', $target['list'][3])[0] : '' ?>">
                                </div>
                                <div class="pr-1"><h4>Sampai</h4></div>
                                <div class="pr-1"><input type="text" id="input_3_end"
                                        class="form-control input_3"
                                        value="<?= isset($target['list'][3]) ? explode('-', $target['list'][3])[1] : '' ?>">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(3)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(3, 'range')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][3]) ? '' : 'hidden' ?>" id="result_3">
                                <input type="hidden" id="target_3" name="target[3]"
                                    value="<?= isset($target['list'][3]) ? $target['list'][3] : '' ?>" />
                                <p><b id="el_3"><?= isset($target['list'][3]) ? $target['list'][3] : '' ?></b> Tahun</p>
                                <a href="#" class="card-link" onClick="editKondisi(3)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(3)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][4]) ? '' : 'hidden' ?>" id="kondisi_4">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Pendapatan Pertahun</h4>
                            <div class="my-1 hidden" id="input_4">
                                <div class="pr-1"><input type="text" id="input_4_start"
                                        class="form-control value="
                                        <?= isset($target['list'][4]) ? explode('-', $target['list'][4])[0] : '' ?>">
                                </div>
                                <div class="pr-1"><h4>Sampai</h4></div>
                                <div class="pr-1"><input type="text" id="input_4_end"
                                        class="form-control value="
                                        <?= isset($target['list'][4]) ? explode('-', $target['list'][4])[1] : '' ?>">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(4)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(4, 'range')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][4]) ? '' : 'hidden' ?>" id="result_4">
                                <input type="hidden" id="target_4" name="target[4]"
                                    value="<?= isset($target['list'][4]) ? $target['list'][4] : '' ?>" />
                                <p><b id="el_4"><?= isset($target['list'][4]) ? $target['list'][4] : '' ?></b></p>
                                <a href="#" class="card-link" onClick="editKondisi(4)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(4)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][5]) ? '' : 'hidden' ?>" id="kondisi_5">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Kota / Kabupaten</h4>
                            <div class="my-1 hidden" id="input_5">
                                <div class="my-1 col-6">
                                    <select multiple id="input_select_5" style="width: 100%"></select>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(5)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(5, 'select')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][5]) ? '' : 'hidden' ?>" id="result_5">
                                <input type="hidden" id="target_5" name="target[5]"
                                    value="<?= isset($target['list'][5]) ? $target['list'][5] : '' ?>" />
                                <p><b id="el_5"><?= isset($target['list'][5]) ? $target['list'][5] : '' ?></b></p>
                                <a href="#" class="card-link" onClick="editKondisi(5)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(5)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][6]) ? '' : 'hidden' ?>" id="kondisi_6">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Provinsi</h4>
                            <div class="my-1 hidden" id="input_6">
                                <div class="my-1 col-6">
                                    <select multiple id="input_select_6" style="width: 100%"></select>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(6)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(6, 'select')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][6]) ? '' : 'hidden' ?>" id="result_6">
                                <input type="hidden" id="target_6" name="target[6]"
                                    value="<?= isset($target['list'][6]) ? $target['list'][6] : '' ?>" />
                                <p><b id="el_6"><?= isset($target['list'][6]) ? $target['list'][6] : '' ?></b></p>
                                <a href="#" class="card-link" onClick="editKondisi(6)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(6)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][7]) ? '' : 'hidden' ?>" id="kondisi_7">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Kepemilikan Saham</h4>
                            <div class="my-1 hidden" id="input_7">
                                <div class="content-center justify-content-between my-1 input_7">
                                    <div><input style="width: auto;margin-right: 1rem;" type="radio"
                                            class="input_7" name="kepemilikan" value="1"><label>Sudah Memiliki
                                            Saham</label> </div>
                                    <div><input style="width: auto;margin-right: 1rem;" type="radio"
                                            class="input_7" name="kepemilikan" value="0"><label>Belum Memiliki
                                            Saham</label> </div>
                                    <div>
                                        <button type="button" class="btn btn-danger" id="input_7_radio_delete"
                                            onClick="removeKondisi(7)">Hapus</button>
                                        <button type="button" class="btn btn-primary" id="input_7_radio"
                                            onClick="submitKondisi(7, 'radio')">Terapkan</button>
                                    </div>
                                </div>

                                <div class="my-1 row hidden" id="input_7_select">
                                    <span class="col-6">
                                        <select multiple id="input_select_7"></select>
                                    </span>
                                    <span class="col-6">
                                        <div class="content-center justify-content-between">
                                            <input type="checkbox" id="select_perusahaan" value="1"
                                                class="col-1">Pilih Semua
                                            <button type="button" class="btn btn-danger"
                                                onClick="removeKondisi(7)">Hapus</button>
                                            <button type="button" class="btn btn-primary"
                                                onClick="submitKondisi(7, 'select')">Terapkan</button>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][7]) ? '' : 'hidden' ?>" id="result_7">
                                <input type="hidden" id="target_7" name="target[7]"
                                    value="<?= isset($target['list'][7]['id']) ? $target['list'][7]['id'] : '' ?>" />
                                <p><b
                                        id="el_7"><?= isset($target['list'][7]['text']) ? $target['list'][7]['text'] : '' ?></b>
                                </p>
                                <a href="#" class="card-link" onClick="editKondisi(7)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(7)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][8]) ? '' : 'hidden' ?>" id="kondisi_8">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Jumlah Saham (Rp)</h4>
                            <div class="my-1 hidden" id="input_8">
                                <div class="pr-1"><input type="text" id="input_8_start"
                                        class="form-control value="
                                        <?= isset($target['list'][8]) ? explode('-', $target['list'][8])[0] : '' ?>">
                                </div>
                                <div class="pr-1"><h4>Sampai</h4></div>
                                <div class="pr-1"><input type="text" id="input_8_end"
                                        class="form-control value="
                                        <?= isset($target['list'][8]) ? explode('-', $target['list'][8])[1] : '' ?>">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(8)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(8, 'range')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][8]) ? '' : 'hidden' ?>" id="result_8">
                                <input type="hidden" id="target_8" name="target[8]"
                                    value="<?= isset($target['list'][8]) ? $target['list'][8] : '' ?>" />
                                <p><b id="el_8"><?= isset($target['list'][8]) ? $target['list'][8] : '' ?></b></p>
                                <a href="#" class="card-link" onClick="editKondisi(8)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(8)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][9]) ? '' : 'hidden' ?>" id="kondisi_9">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Jumlah Saham (Count)</h4>
                            <div class="my-1 hidden" id="input_9">
                                <div class="pr-1"><input type="text" id="input_9_start"
                                        class="form-control value="
                                        <?= isset($target['list'][9]) ? explode('-', $target['list'][9])[0] : '' ?>">
                                </div>
                                <div class="pr-1"><h4>Sampai</h4></div>
                                <div class="pr-1"><input type="text" id="input_9_end"
                                        class="form-control value="
                                        <?= isset($target['list'][9]) ? explode('-', $target['list'][9])[1] : '' ?>">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(9)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(9, 'range')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][9]) ? '' : 'hidden' ?>" id="result_9">
                                <input type="hidden" id="target_9" name="target[9]"
                                    value="<?= isset($target['list'][9]) ? $target['list'][9] : '' ?>" />
                                <p><b id="el_9"><?= isset($target['list'][9]) ? $target['list'][9] : '' ?></b></p>
                                <a href="#" class="card-link" onClick="editKondisi(9)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(9)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][10]) ? '' : 'hidden' ?>" id="kondisi_10">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Sisa Limit Kepemlikan Investasi</h4>
                            <div class="my-1 hidden" id="input_10">
                                <div class="content-center justify-content-between my-1 input_10">
                                    <div><input style="width: auto;margin-right: 1rem;" type="radio"
                                            class="input_10" name="limit" value="Unlimited"
                                            <?= isset($target['list'][10]) ? ($target['list'][10]['id'] == '999999999999' ? 'checked' : '') : '' ?>><label>Unlimited</label>
                                    </div>
                                    <div><input style="width: auto;margin-right: 1rem;" type="radio"
                                            class="input_10" name="limit" value="Range"
                                            <?= isset($target['list'][10]) ? ($target['list'][10]['id'] != '999999999999' ? 'checked' : '') : '' ?>><label>Range</label>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-danger"
                                            onClick="removeKondisi(10)">Hapus</button>
                                        <button type="button" class="btn btn-primary" id="input_10_radio"
                                            onClick="submitKondisi(10, 'radio')">Terapkan</button>
                                    </div>
                                </div>
                                <div class="<?= isset($target['list'][10]['id']) && $target['list'][10]['id'] == '999999999999' ? 'hidden' : '' ?>"
                                    id="input_10_range">
                                    <div class="content-center justify-content-between">
                                        <div class="pr-1"><input type="text" id="input_10_start"
                                                class="form-control"
                                                value="<?= isset($target['list'][10]['id']) && $target['list'][10]['id'] != '999999999999' ? explode('-', $target['list'][10]['text'])[0] : '' ?>">
                                        </div>
                                        <div class="pr-1"><h4>Sampai</h4></div>
                                        <div class="pr-1"><input type="text" id="input_10_end"
                                                class="form-control"
                                                value="<?= isset($target['list'][10]['id']) && $target['list'][10]['id'] != '999999999999' ? explode('-', $target['list'][10]['text'])[1] : '' ?>">
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger"
                                                onClick="removeKondisi(10)">Hapus</button>
                                            <button type="button" class="btn btn-primary"
                                                onClick="submitKondisi(10, 'range')">Terapkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][10]) ? '' : 'hidden' ?>" id="result_10">
                                <input type="hidden" id="target_10" name="target[10]"
                                    value="<?= isset($target['list'][10]['id']) ? $target['list'][10]['id'] : '' ?>" />
                                <p><b
                                        id="el_10"><?= isset($target['list'][10]['text']) ? ($target['list'][10]['text'] == '999999999999' ? 'Unlimited' : $target['list'][10]['text']) : '' ?></b>
                                </p>
                                <a href="#" class="card-link" onClick="editKondisi(10)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(10)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][11]) ? '' : 'hidden' ?>" id="kondisi_11">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Rata-Rata Pembelian</h4>
                            <div class="hidden my-1" id="input_11">
                                <div class="pr-1"><input type="text" id="input_11_start"
                                        class="form-control value="
                                        <?= isset($target['list'][11]) ? explode('-', $target['list'][11])[0] : '' ?>">
                                </div>
                                <div class="pr-1"><h4>Sampai</h4></div>
                                <div class="pr-1"><input type="text" id="input_11_end"
                                        class="form-control value="
                                        <?= isset($target['list'][11]) ? explode('-', $target['list'][11])[1] : '' ?>">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(11)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(11, 'range')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][11]) ? '' : 'hidden' ?>" id="result_11">
                                <input type="hidden" id="target_11" name="target[11]"
                                    value="<?= isset($target['list'][11]) ? $target['list'][11] : '' ?>" />
                                <p><b id="el_11"><?= isset($target['list'][11]) ? $target['list'][11] : '' ?></b></p>
                                <a href="#" class="card-link" onClick="editKondisi(11)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(11)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][12]) ? '' : 'hidden' ?>" id="kondisi_12">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Deposit</h4>
                            <div class="hidden my-1" id="input_12">
                                <div class="pr-1"><input type="text" id="input_12_start"
                                        class="form-control" value="
                                        <?= isset($target['list'][12]) ? explode('-', $target['list'][12])[0] : '' ?>">
                                </div>
                                <div class="pr-1"><h4>Sampai</h4></div>
                                <div class="pr-1"><input type="text" id="input_12_end"
                                        class="form-control" value="
                                        <?= isset($target['list'][12]) ? explode('-', $target['list'][12])[1] : '' ?>">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(12)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(12, 'range')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][12]) ? '' : 'hidden' ?>" id="result_12">
                                <input type="hidden" id="target_12" name="target[12]"
                                    value="<?= isset($target['list'][12]) ? $target['list'][12] : '' ?>" />
                                <p><b id="el_12"><?= isset($target['list'][12]) ? $target['list'][12] : '' ?></b></p>
                                <a href="#" class="card-link" onClick="editKondisi(12)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(12)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][13]) ? '' : 'hidden' ?>" id="kondisi_13">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">SID</h4>
                            <div class="hidden my-1" id="input_13">
                                <div><input style="width: auto;margin-right: 1rem;" type="radio" class="input_13"
                                        name="sid" value="IS NOT NULL"><label>Sudah Upload</label> </div>
                                <div><input style="width: auto;margin-right: 1rem;" type="radio" class="input_13"
                                        name="sid" value="IS NULL"><label>Belum Upload</label> </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(13)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(13, 'radio')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][13]) ? '' : 'hidden' ?>" id="result_13">
                                <input type="hidden" id="target_13" name="target[13]"
                                    value="<?= isset($target['list'][13]) ? $target['list'][13] : '' ?>" />
                                <p><b id="el_13"><?= isset($target['list'][13]) ? $target['list'][13] : '' ?></b></p>
                                <a href="#" class="card-link" onClick="editKondisi(13)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(13)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][14]) ? '' : 'hidden' ?>" id="kondisi_14">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Versi Android</h4>
                            <div class="my-1 hidden" id="input_14">
                                <div class="my-1 col-6">
                                    <select multiple id="input_select_14" style="width: 100%"></select>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(14)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(14, 'select')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][14]) ? '' : 'hidden' ?>" id="result_14">
                                <input type="hidden" id="target_14" name="target[14]"
                                    value="<?= isset($target['list'][14]) ? $target['list'][14] : '' ?>" />
                                <p><b id="el_14"><?= isset($target['list'][14]) ? $target['list'][14] : '' ?></b></p>
                                <a href="#" class="card-link" onClick="editKondisi(14)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(14)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 <?= isset($target['list'][15]) ? '' : 'hidden' ?>" id="kondisi_15">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                            <h4 class="card-title">Versi IOS</h4>
                            <div class="my-1 hidden" id="input_15">
                                <div class="my-1 col-6">
                                    <select multiple id="input_select_15" style="width: 100%"></select>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger"
                                        onClick="removeKondisi(15)">Hapus</button>
                                    <button type="button" class="btn btn-primary"
                                        onClick="submitKondisi(15, 'select')">Terapkan</button>
                                </div>
                            </div>
                            <div class="<?= isset($target['list'][15]) ? '' : 'hidden' ?>" id="result_15">
                                <input type="hidden" id="target_15" name="target[15]"
                                    value="<?= isset($target['list'][15]) ? $target['list'][15] : '' ?>" />
                                <p><b id="el_15"><?= isset($target['list'][15]) ? $target['list'][15] : '' ?></b></p>
                                <a href="#" class="card-link" onClick="editKondisi(15)">Edit</a>
                                <a href="#" class="card-link" onClick="removeKondisi(15)">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php if( !isset($target['id']) ): ?>
    <div class="row">
        <div class="col-12">
            <label class="d-flex">
                <input type="checkbox" name="target_is_save" value="1" class="col-1">Simpan Target User
            </label>
        </div>
    </div>
    <?php endif; ?>
</fieldset>

<script>

    var input_10_start = document.getElementById('input_10_start');
    input_10_start.addEventListener('keyup', function(e) {
        input_10_start.value = formatRupiah(this.value, '');
    });


    var input_11_start = document.getElementById('input_11_start');
    input_11_start.addEventListener('keyup', function(e) {
        input_11_start.value = formatRupiah(this.value, '');
    });

    var input_4_start = document.getElementById('input_4_start');
    input_4_start.addEventListener('keyup', function(e) {
        input_4_start.value = formatRupiah(this.value, '');
    });

    var input_4_end = document.getElementById('input_4_end');
    input_4_end.addEventListener('keyup', function(e) {
        input_4_end.value = formatRupiah(this.value, '');
    });

    
    var input_8_start = document.getElementById('input_8_start');
    input_8_start.addEventListener('keyup', function(e) {
        input_8_start.value = formatRupiah(this.value, '');
    });

    var input_8_end = document.getElementById('input_8_end');
    input_8_end.addEventListener('keyup', function(e) {
        input_8_end.value = formatRupiah(this.value, '');
    });

    var input_11_end = document.getElementById('input_11_end');
    input_11_end.addEventListener('keyup', function(e) {
        input_11_end.value = formatRupiah(this.value, '');
    });

    var input_12_start = document.getElementById('input_12_start');
    input_12_start.addEventListener('keyup', function(e) {
        input_12_start.value = formatRupiah(this.value, '');
    });

    var input_12_end = document.getElementById('input_12_end');
    input_12_end.addEventListener('keyup', function(e) {
        input_12_end.value = formatRupiah(this.value, '');
    });

    var input_10_end = document.getElementById('input_10_end');
    input_10_end.addEventListener('keyup', function(e) {
        input_10_end.value = formatRupiah(this.value, '');
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
</script>
