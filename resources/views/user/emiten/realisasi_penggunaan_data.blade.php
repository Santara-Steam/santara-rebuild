<fieldset>
    <form id="formFundRealizationPlans" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= (isset($data['fund_realization_plans']['data']['id']))  ?  'update' : 'create'; ?>" />
        <input type="hidden" name="tab" value='fund_realization_plans' />
        <input type="hidden" name="id" value='<?= isset($data['fund_realization_plans']['data']['id']) ? $data['fund_realization_plans']['data']['id'] : null; ?>' />
        <!-- <input type="hidden" name="uuid" value='<?= $uuid; ?>' /> -->

        <div class="card">
            <div class="card-content">
                <div class="card-body p-1">
                    @include('user.emiten.periode_laporan', [
                        'month'         => isset($data['fund_realization_plans']['data']['month']) ? $data['fund_realization_plans']['data']['month'] : '',
                        'year'          => isset($data['fund_realization_plans']['data']['year']) ? $data['fund_realization_plans']['data']['year'] : '',
                        'version'       => isset($data['fund_realization_plans']['data']['version']) ? $data['fund_realization_plans']['data']['version'] : '',
                        'version_desc'  => isset($data['fund_realization_plans']['data']['version_desc']) ? $data['fund_realization_plans']['data']['version_desc'] : ''
                    ])
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body p-3">
                    <div class="mb-5">
                        <div class="mb-2">
                            <h4><b>A. Rencana Penggunaan Dana</b></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proposalTitle1"><b>Tampilkan rencana penggunaan dana dalam laporan ?</b></label>
                                    <div class="radio d-block">
                                        <input type="radio" id="show_fund_plan_yes" name="show_fund_plan" class="show_fund_plan" value="1" <?= (isset($data['fund_realization_plans']['data']['show_fund_plan']) && $data['fund_realization_plans']['data']['show_fund_plan'] == 1) ? 'checked' : '' ?>>
                                        <label>Ya, Tampilkan dalam laporan</label>
                                        <br />
                                        <input type="radio" id="show_fund_plan_no" name="show_fund_plan" class="show_fund_plan" value="0" <?= (isset($data['fund_realization_plans']['data']['show_fund_plan']) &&  $data['fund_realization_plans']['data']['show_fund_plan'] == 0) ? 'checked' : '' ?>>
                                        <label>Tidak, Jangan tampilkan dalam laporan</label>
                                    </div>
                                </div>
                                <div class="show_fund_plan_content">
                                    <div class="form-group">
                                        <?php if (isset($data['fund_realization_plans']['data']['list_fund_plans'])) : ?>
                                            <?php foreach ($data['fund_realization_plans']['data']['list_fund_plans'] as $key => $value) : ?>
                                                <label><b><?= $value['name'] ?></b></label>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="tab_rencana">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Keterangan</th>
                                                                <th scope="col">Nilai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($value['sublist'] as $k => $v) : ?>
                                                                <tr>
                                                                    <td width="85%"><?= $v['desc']; ?></td>
                                                                    <td width="15%"> <?= number_format($v['amount'], 0, ',', '.') ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-4 offset-8">
                                                        <label for="staticEmail" class="col-form-label">Subtotal</label>
                                                        <input type="text" class="form-control-plaintext" value="<?= (isset($data['fund_realization_plans']['data']['id']))  ? number_format($value['subtotal'], 0, ',', '.') : number_format($value['total'], 0, ',', '.'); ?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="staticEmail" class="col-form-label">Deskripsi</label>
                                                    <p class="mb-3"><?= $value['desc']; ?></p>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <a href="/user/penerbit/bisnisdetail/<?= $uuid; ?>#rencana" class="btn btn-santara-white pull-left">Edit Rencana Penggunaan Dana</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="mb-2">
                            <h4><b>B. Realisasi Penggunaan Dana</b></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proposalTitle1"><b>Tampilkan rencana penggunaan dana dalam laporan ?</b></label>
                                    <div class="radio d-block">
                                        <input type="radio" id="show_fund_realization_yes" name="show_fund_realization" class="show_fund_realization" value="1" <?= (isset($data['fund_realization_plans']['data']['show_fund_realization']) && $data['fund_realization_plans']['data']['show_fund_realization'] == 1) ? 'checked' : '' ?>>
                                        <label>Ya, Tampilkan dalam laporan</label>
                                        <br />
                                        <input type="radio" id="show_fund_realization_no" name="show_fund_realization" class="show_fund_realization" value="0" <?= (isset($data['fund_realization_plans']['data']['show_fund_realization']) && $data['fund_realization_plans']['data']['show_fund_realization'] == 0) ? 'checked' : '' ?>>
                                        <label>Tidak, Jangan tampilkan dalam laporan</label>
                                    </div>
                                </div>

                                <div class="show_fund_realization_content">
                                    <div class="mb-5">
                                        <label><b>Table Rincian Realisasi Pengguna Dana</b></label>

                                        <div class="table-responsive">
                                            <table class="table" id="tab_realisasi">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Keterangan</th>
                                                        <th scope="col">Nilai</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <input type="hidden" id="row_count" value="<?= isset($data['fund_realization_plans']['data']['list_fund_realization']) ? count($data['fund_realization_plans']['data']['list_fund_realization']) : 1; ?>" />

                                                    <?php if (isset($data['fund_realization_plans']['data']['list_fund_realization'])) :
                                                        $no = 0;
                                                        foreach ($data['fund_realization_plans']['data']['list_fund_realization'] as $key => $value) :
                                                    ?>
                                                            <tr id='realisasi_addr_<?= $key ?>'>
                                                                <td width="85%">
                                                                    <input type="text" name='list_fund_realization[<?= $key ?>][desc]' class="form-control" value="<?= $value['desc']; ?>" />
                                                                </td>
                                                                <td width="15%">
                                                                    <input type="text" name='list_fund_realization[<?= $key ?>][amount]' class="form-control realisasi_amount" value="<?= number_format($value['amount'], 0, ',', '.'); ?>" onkeyup='total()' />
                                                                </td>
                                                                <td width='5%'><a class='pull-right btn btn-santara-white' onclick='removeRow(<?= $key ?>)'><i class='las la-times'></i></a></td>
                                                            </tr>
                                                        <?php
                                                            $no = $key + 1;
                                                        endforeach; ?>
                                                    <?php endif; ?>
                                                    {{-- <tr id='realisasi_addr_<?= $no ?>'></tr> --}}
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-4 offset-8">
                                                <label for="staticEmail" class="col-form-label">Total</label>
                                                <input type="text" name='fund_realization_total' id="fund_realization_total" class="form-control-plaintext" value="<?= isset($data['fund_realization_plans']['data']['fund_realization_total']) ? number_format($data['fund_realization_plans']['data']['fund_realization_total'], 0, ',', '.') : 0; ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <a id="realisasi_add_row" class="btn btn-santara-white pull-left">Tambah Baris</a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label><b>Deskripsi (Optional)</b></label>
                                        <textarea name="fund_realization_desc" class="form-control" cols="30" rows="5" placeholder="Deskripsi tentang realisasi penggunaan dana"><?= isset($data['fund_realization_plans']['data']['fund_realization_desc']) ? $data['fund_realization_plans']['data']['fund_realization_desc'] : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="row">
                            <div class="text-left col-md-6 mb-1">
                                <a href="/user/penerbit/bisnisdetail/<?= $uuid; ?>" class="btn btn-santara-white btn-block">Kembali</a>
                            </div>
                            <div class="text-right col-md-6 mb-1">
                                <button type="button" class="btn btn-santara-red btn-block" onClick="submitReport('formFundRealizationPlans', null, '<?= $uuid; ?>')">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</fieldset>