<fieldset>
    <form id="formProfitLoss" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= ($data['profit_loss'] != null) ?  'update' : 'create'; ?>" />
        <input type="hidden" name="tab" value='profit_loss' />
        <input type="hidden" name="id" value='<?= ($data['profit_loss']) ? $data['profit_loss']['data']['id'] : null; ?>' />
        <!-- <input type="hidden" name="uuid" value='<?= $uuid; ?>' /> -->

        <div class="card">
            <div class="card-content">
                <div class="card-body p-1">
                    @include('user.emiten.periode_laporan', [
                        'month'         => isset($data['profit_loss']['data']['month']) ? $data['profit_loss']['data']['month'] : '',
                        'year'          => isset($data['profit_loss']['data']['year']) ? $data['profit_loss']['data']['year'] : '',
                        'version'       => isset($data['profit_loss']['data']['version']) ? $data['profit_loss']['data']['version'] : '',
                        'version_desc'  => isset($data['profit_loss']['data']['version_desc']) ? $data['profit_loss']['data']['version_desc'] : ''
                    ])
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body p-3">

                    <div class="mb-2">
                        <h4><b>Laporan Laba Rugi</b></h4>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="proposalTitle1"><b>Tampilkan laporan laba rugi dana dalam laporan ?</b></label>
                                <div class="radio d-block">
                                    <input type="radio" id="show_profit_loss_yes" name="show_profit_loss" class="show_profit_loss" value="1" <?= (($data['profit_loss']) && $data['profit_loss']['data']['show_profit_loss'] == 1) ? 'checked' : '' ?>>
                                    <label>Ya, Tampilkan dalam laporan</label>
                                    <br />
                                    <input type="radio" id="show_profit_loss_no" name="show_profit_loss" class="show_profit_loss" value="0" <?= (($data['profit_loss']) && $data['profit_loss']['data']['show_profit_loss'] == 0) ? 'checked' : '' ?>>
                                    <label>Tidak, Jangan tampilkan dalam laporan</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="show_profit_loss_content">

                        <?php if (isset($data['profit_loss']['data']['profit_loss_total'])) : ?>
                            <div class="row my-2">
                                <div class="col-md-12">
                                    <b>
                                        <div class="card-body total-labarugi">
                                            <div><span>Total Laba Bersih Seluruh Cabang</span></div>
                                            <div class="total-labarugi-text"><?= 'Rp. ' . number_format($data['profit_loss']['data']['profit_loss_total'], 0, ',', '.') ?></div>
                                        </div>
                                    </b>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="card-content m-0">
                            <div class="col-md-12">
                                <?php if ((!isset($data['profit_loss']['data']['profit_loss'])) || $data['profit_loss']['data']['profit_loss'] == null) : ?>
                                    <input type="hidden" id="tabID" value="1" />
                                    <!-- Nav tabs -->
                                    <div class="row">
                                        <ul id="tab-list" class="nav nav-tabs" role="tablist" style="border-radius: unset;">
                                            <li class="nav-item active">
                                                <a class="nav-link tab-labarugi active" id="profil-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab" aria-selected="true">
                                                    <div>nama cabang <button class="close" type="button" title="Remove this page">×</button> </div>
                                                    <div style="line-height:1;">
                                                        <div><small>Total laba bersih</small></div>
                                                        <div>Rp. 0</div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <button id="btn-add-tab" type="button" class="btn btn-santara-white pull-right ml-1" style="font-size: 3rem;padding: 0;border: none;" onClick="addTabPlan()"><i class="la la-plus-square"></i></button>
                                    </div>

                                    <!-- Tab panes -->
                                    <div id="tab-content" class="tab-content">
                                        <div class="tab-pane fade show active row" id="tab1">
                                            <div class="row my-1">
                                                <div class="form-group col-md-4">
                                                    <label>Nama Cabang</label>
                                                    <input type="text" class="form-control" name="profit_loss[1][name]" maxlength="40" placeholder="Masukan nama rencana" />
                                                </div>
                                            </div>
                                            <div class="row col-md-12 my-3">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="tab_sales_1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Rincian Penjualan</th>
                                                                <th scope="col">Biaya ( Rp. )</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id='sales_1_1'></tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_sales_1" name="profit_loss[1][sales][total]" />
                                                        <a class="btn btn-santara-white pull-left" onclick="addReport(1, 1, 'sales')">Tambah Baris</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-md-12 my-3">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="tab_cogs_1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Rincian HPP</th>
                                                                <th scope="col">Biaya ( Rp. )</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id='cogs_1_1'></tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_cogs_1" name="profit_loss[1][cogs][total]" />
                                                        <a class="btn btn-santara-white pull-left" onclick="addReport(1, 1, 'cogs')">Tambah Baris</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-md-12 my-3">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="tab_cost_1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Biaya Sales General dan Admin</th>
                                                                <th scope="col">Biaya ( Rp. )</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id='cost_1_1'>
                                                                <td width="65%">
                                                                    <input type="text" name='profit_loss[1][cost][list][1][desc]' value="Amortisasi" class="form-control" readonly />
                                                                </td>
                                                                <td width="30%">
                                                                    <input type="text" name='profit_loss[1][cost][list][1][amount]' value="0" class="form-control profit_loss_amount_cost_1" onkeyup="subTotal('cost',1)" />
                                                                </td>
                                                                <td width='5%'><a class='pull-right btn btn-santara-white'><i class="la la-check-circle"></i></a></td>
                                                            </tr>
                                                            <tr id='cost_1_2'>
                                                                <td width="65%">
                                                                    <input type="text" name='profit_loss[1][cost][list][2][desc]' value="Depresiasi" class="form-control" readonly />
                                                                </td>
                                                                <td width="30%">
                                                                    <input type="text" name='profit_loss[1][cost][list][2][amount]' value="0" class="form-control profit_loss_amount_cost_1" onkeyup="subTotal('cost',1)" />
                                                                </td>
                                                                <td width='5%'><a class='pull-right btn btn-santara-white'><i class="la la-check-circle"></i></a></td>
                                                            </tr>
                                                            <tr id='cost_1_3'></tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control-plaintext pull-right" style="width:30%" value="0" id="profit_loss_total_cost_1" name="profit_loss[1][cost][total]" />
                                                        <a class="btn btn-santara-white pull-left" onclick="addReport(1, 3, 'cost')">Tambah Baris</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-md-12 my-3">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="tab_other_1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Pendapatan atau beban Lain</th>
                                                                <th scope="col">Biaya ( Rp. )</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id='other_1_1'></tr>
                                                        </tbody>
                                                    </table>
                                                    <small class="row mb-2 mx-1">Apabila ingin mencantumkan beban, maka dapat diisikan dengan bilangan negatif ( Contoh : -1.000.000)</small>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_other_1" name="profit_loss[1][other][total]" />
                                                        <a class="btn btn-santara-white pull-left" onclick="addReport(1, 1, 'other')">Tambah Baris</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row col-md-12 my-3">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="tab_tax_1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Rincian Pajak</th>
                                                                <th scope="col">Biaya ( Rp. )</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id='tax_1_1'></tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_tax_1" name="profit_loss[1][tax][total]" />
                                                        <a class="btn btn-santara-white pull-left" onclick="addReport(1, 1, 'tax')">Tambah Baris</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php else : ?>
                                    <input type="hidden" id="tabID" value="<?= count($data['profit_loss']['data']['profit_loss']); ?>" />
                                    <!-- Nav tabs -->
                                    <div class="row">
                                        <ul id="tab-list" class="nav nav-tabs" role="tablist" style="border-radius: unset;">
                                            <?php foreach ($data['profit_loss']['data']['profit_loss'] as $key => $value) : ?>
                                                <li class="nav-item active">
                                                    <a class="nav-link tab-labarugi <?= ($key == 0) ? 'active' : '' ?>" id="profil-tab" data-toggle="tab" href="#tab<?= $key ?>" role="tab" aria-controls="tab" aria-selected="true">
                                                        <div><b><?= $value['name'] ?> <button class="close" type="button" title="Remove this page">×</button> </b></div>
                                                        <div style="line-height:1;">
                                                            <div><small>Total laba bersih</small></div>
                                                            <div><?= 'Rp. ' . number_format($value['total'], 0, ',', '.') ?></div>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <button id="btn-add-tab" type="button" class="btn btn-santara-white pull-right ml-1" style="font-size: 3rem;padding: 0;border: none;" onClick="addTabPlan()"><i class="la la-plus-square"></i></button>
                                    </div>
                                    <!-- Tab panes -->
                                    <div id="tab-content" class="tab-content">
                                        <?php foreach ($data['profit_loss']['data']['profit_loss'] as $key => $value) :
                                        ?>

                                            <div class="tab-pane fade row <?= ($key == 0) ? 'show active' : '' ?>" id="tab<?= $key ?>">
                                                <div class="row my-1">
                                                    <div class="form-group col-md-4">
                                                        <label>Nama Cabang</label>
                                                        <input type="text" class="form-control" name="profit_loss[<?= $key; ?>][name]" maxlength="40" value="<?= $value['name']; ?>" />
                                                    </div>
                                                </div>
                                                <div class="row col-md-12 my-3">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="tab_sales_<?= $key; ?>">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Rincian Penjualan</th>
                                                                    <th scope="col">Biaya ( Rp. )</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no_sales = 0;
                                                                foreach ($value['sales']['list'] as $k => $v) :
                                                                ?>
                                                                    <tr id='sales_<?= $key; ?>_<?= $k; ?>'>
                                                                        <td width="65%">
                                                                            <input type="text" name='profit_loss[<?= $key; ?>][sales][list][<?= $k; ?>][desc]' value="<?= $v['desc']; ?>" class="form-control" />
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" name='profit_loss[<?= $key; ?>][sales][list][<?= $k; ?>][amount]' value="<?= number_format($v['amount'], 0, ',', '.'); ?>" class="form-control profit_loss_amount_sales_<?= $key ?>" onkeyup="subTotal('sales', <?= $key ?>)" onkeypress="return numberOnlyMinus(event)" />
                                                                        </td>
                                                                        <td width='5%'><a class='pull-right btn btn-santara-white' onclick='removeReport("<?= $key ?>","<?= $no_sales ?>", "sales")'><i class='la la-times'></i></a></td>
                                                                    </tr>
                                                                <?php
                                                                    $no_sales = $k + 1;
                                                                endforeach; ?>
                                                                <tr id='sales_<?= $key; ?>_<?= $no_sales; ?>'></tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_sales_<?= $key ?>" name="profit_loss[<?= $key ?>][sales][total]" value="<?= number_format($value['sales']['total'], 0, ',', '.'); ?>" />
                                                            <a class="btn btn-santara-white pull-left" onclick="addReport('<?= $key ?>','<?= $no_sales ?>', 'sales')">Tambah Baris</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row col-md-12 my-3">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="tab_cogs_<?= $key; ?>">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Rincian HPP</th>
                                                                    <th scope="col">Biaya ( Rp. )</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no_cogs = 0;
                                                                foreach ($value['cogs']['list'] as $k => $v) :
                                                                ?>
                                                                    <tr id='cogs_<?= $key; ?>_<?= $k; ?>'>
                                                                        <td width="65%">
                                                                            <input type="text" name='profit_loss[<?= $key; ?>][cogs][list][<?= $k; ?>][desc]' value="<?= $v['desc']; ?>" class="form-control" />
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" name='profit_loss[<?= $key; ?>][cogs][list][<?= $k; ?>][amount]' value="<?= number_format($v['amount'], 0, ',', '.'); ?>" class="form-control profit_loss_amount_cogs_<?= $key ?>" onkeyup="subTotal('cogs', <?= $key ?>)" onkeypress="return numberOnlyMinus(event)" />
                                                                        </td>
                                                                        <td width='5%'><a class='pull-right btn btn-santara-white' onclick='removeReport("<?= $key ?>","<?= $k ?>", "cogs")'><i class='la la-times'></i></a></td>
                                                                    </tr>
                                                                <?php
                                                                    $no_cogs = $k + 1;
                                                                endforeach; ?>
                                                                <tr id='cogs_<?= $key; ?>_<?= $no_cogs; ?>'></tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_cogs_<?= $key ?>" name="profit_loss[<?= $key ?>][cogs][total]" value="<?= number_format($value['cogs']['total'], 0, ',', '.'); ?>" />
                                                            <a class="btn btn-santara-white pull-left" onclick="addReport('<?= $key ?>','<?= $no_cogs ?>', 'cogs')">Tambah Baris</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row col-md-12 my-3">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="tab_cost_<?= $key; ?>">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Biaya Sales General dan Admin</th>
                                                                    <th scope="col">Biaya ( Rp. )</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no_cost = 0;
                                                                foreach ($value['cost']['list'] as $k => $v) :
                                                                ?>
                                                                    <tr id='cost_<?= $key; ?>_<?= $k; ?>'>
                                                                        <td width="65%">
                                                                            <input type="text" name='profit_loss[<?= $key; ?>][cost][list][<?= $k; ?>][desc]' value="<?= $v['desc']; ?>" class="form-control" <?= ($v['desc'] == 'Amortisasi' || $v['desc'] == 'Depresiasi') ? 'readonly' : ''; ?> />
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" name='profit_loss[<?= $key; ?>][cost][list][<?= $k; ?>][amount]' value="<?= number_format($v['amount'], 0, ',', '.'); ?>" class="form-control profit_loss_amount_cost_<?= $key ?>" onkeyup="subTotal('cost',<?= $key ?>)" onkeypress="return numberOnlyMinus(event)" />
                                                                        </td>
                                                                        <td width='5%'>
                                                                            <?php if ($v['desc'] == 'Amortisasi' || $v['desc'] == 'Depresiasi') : ?>
                                                                                <a class='pull-right btn btn-santara-white'><i class="la la-check-circle"></i></a>
                                                                            <?php else : ?>
                                                                                <a class='pull-right btn btn-santara-white' onclick='removeReport("<?= $key ?>","<?= $k ?>", "cost")'><i class='la la-times'></i></a>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                    $no_cost = $k + 1;
                                                                endforeach; ?>
                                                                <tr id='cost_<?= $key; ?>_<?= $no_cost; ?>'></tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_cost_<?= $key ?>" name="profit_loss[<?= $key ?>][cost][total]" value="<?= number_format($value['cost']['total'], 0, ',', '.'); ?>" />
                                                            <a class="btn btn-santara-white pull-left" onclick="addReport('<?= $key ?>','<?= $no_cost ?>', 'cost')">Tambah Baris</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row col-md-12 my-3">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="tab_other_<?= $key; ?>">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Pendapatan atau beban Lain</th>
                                                                    <th scope="col">Biaya ( Rp. )</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no_other = 0;
                                                                foreach ($value['other']['list'] as $k => $v) :
                                                                ?>
                                                                    <tr id='other_<?= $key; ?>_<?= $k; ?>'>
                                                                        <td width="65%">
                                                                            <input type="text" name='profit_loss[<?= $key; ?>][other][list][<?= $k; ?>][desc]' value="<?= $v['desc']; ?>" class="form-control" />
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" name='profit_loss[<?= $key; ?>][other][list][<?= $k; ?>][amount]' value="<?= number_format($v['amount'], 0, ',', '.'); ?>" class="form-control profit_loss_amount_other_<?= $key ?>" onkeyup="subTotal('other',<?= $key ?>)" onkeypress="return numberOnlyMinus(event)" />
                                                                        </td>
                                                                        <td width='5%'><a class='pull-right btn btn-santara-white' onclick='removeReport("<?= $key ?>","<?= $k ?>", "other")'><i class='la la-times'></i></a></td>
                                                                    </tr>
                                                                <?php
                                                                    $no_other = $k + 1;
                                                                endforeach; ?>
                                                                <tr id='other_<?= $key; ?>_<?= $no_other; ?>'></tr>
                                                            </tbody>
                                                        </table>
                                                        <small class="row mb-2 mx-1">Apabila ingin mencantumkan beban, maka dapat diisikan dengan bilangan negatif ( Contoh : -1.000.000)</small>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_other_<?= $key ?>" name="profit_loss[<?= $key ?>][other][total]" value="<?= number_format($value['other']['total'], 0, ',', '.'); ?>" />
                                                            <a class="btn btn-santara-white pull-left" onclick="addReport('<?= $key ?>','<?= $no_other ?>', 'other')">Tambah Baris</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row col-md-12 my-3">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="tab_tax_<?= $key; ?>">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Rincian Pajak</th>
                                                                    <th scope="col">Biaya ( Rp. )</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no_tax = 0;
                                                                foreach ($value['tax']['list'] as $k => $v) :
                                                                ?>
                                                                    <tr id='tax_<?= $key; ?>_<?= $k; ?>'>
                                                                        <td width="65%">
                                                                            <input type="text" name='profit_loss[<?= $key; ?>][tax][list][<?= $k; ?>][desc]' value="<?= $v['desc']; ?>" class="form-control" />
                                                                        </td>
                                                                        <td width="30%">
                                                                            <input type="text" name='profit_loss[<?= $key; ?>][tax][list][<?= $k; ?>][amount]' value="<?= number_format($v['amount'], 0, ',', '.'); ?>" class="form-control profit_loss_amount_tax_<?= $key ?>" onkeyup="subTotal('tax',<?= $key ?>)" onkeypress="return numberOnlyMinus(event)" />
                                                                        </td>
                                                                        <td width='5%'><a class='pull-right btn btn-santara-white' onclick='removeReport("<?= $key ?>","<?= $k ?>", "tax")'><i class='la la-times'></i></a></td>
                                                                    </tr>
                                                                <?php
                                                                    $no_tax = $k + 1;
                                                                endforeach; ?>
                                                                <tr id='tax_<?= $key; ?>_<?= $no_tax; ?>'></tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_tax_<?= $key ?>" name="profit_loss[<?= $key ?>][tax][total]" value="<?= number_format($value['tax']['total'], 0, ',', '.'); ?>" />
                                                            <a class="btn btn-santara-white pull-left" onclick="addReport('<?= $key ?>','<?= $no_tax ?>', 'tax')">Tambah Baris</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="form-group col-md-12">
                            <label>Deskripsi</label>
                            <textarea class="form-control required-form" rows="7" cols="50" name="profit_loss_desc" id="profit_loss_desc" placeholder="Tuliskan biografi singkat pemilik usaha"><?= ($data['profit_loss']) ? $data['profit_loss']['data']['profit_loss_desc'] : '' ?></textarea>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="row">
                            <div class="text-left col-md-6 mb-1">
                                <a href="{{url("penerbit/bisnisdetail")}}/<?= $uuid; ?>" class="btn btn-santara-white btn-block">Kembali</a>
                            </div>
                            <div class="text-right col-md-6 mb-1">
                                <button type="button" class="btn btn-santara-red btn-block" onClick="submitReport('formProfitLoss', null, '<?= $uuid; ?>')">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</fieldset>

<script>
    var button = '<button class="close" type="button" title="Remove this page">×</button>';

    var tab_obj = {};
    $(document).ready(function() {
        $('#tab-list').on('click', '.close', function() {
            var tabID = $(this).parents('a').attr('href');

            $(this).parents('li').remove();
            $(tabID).remove();

            //display first tab
            var tabFirst = $('#tab-list a:first');
            tabFirst.tab('show');
        });

        var list = document.getElementById("tab-list");
    });

    var tabID = document.getElementById("tabID").value;

    function resetTab() {
        var tabs = $("#tab-list li:not(:first)");
        var len = 1
        $(tabs).each(function(k, v) {
            len++;
            $(this).find('a').html(`
        <div>nama cabang <button class="close" type="button" title="Remove this page">×</button> </div>
        <div style="line-height:1;">
            <div><small>Total laba bersih</small></div>
            <div>Rp. 0</div>
        </div>`);
        })
        tabID--;
    };

    function addTabPlan() {
        tabID++;
        tab_obj[tabID] = 0;

        $('#tab-list').append($(`
    <li class="nav-item">
        <a class="nav-link tab-labarugi" 
            id="profil-tab" data-toggle="tab" href="#tab${tabID}" 
            role="tab" aria-controls="tab" aria-selected="true"> 
            <div>nama cabang <button class="close" type="button" title="Remove this page">×</button> </div>
            <div style="line-height:1;">
                <div><small>Total laba bersih</small></div>
                <div>Rp. 0</div>
            </div>
        </a>
    </li>`));

        $('#tab-content').append($(`
    <div class="tab-pane fade row" id="tab${tabID}">
        <div class="row my-1">
            <div class="form-group col-md-4">
                <label>Nama Cabang</label>
                <input type="text" class="form-control" name="profit_loss[${tabID}][name]" maxlength="40" 
                    placeholder="Masukan nama rencana"/>
            </div>
        </div>
        <div class="row col-md-12 my-3">
            <div class="table-responsive">
                <table class="table table-bordered" id="tab_sales_${tabID}">
                <thead>
                    <tr>
                        <th scope="col">Rincian Penjualan</th>
                        <th scope="col">Biaya ( Rp. )</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr id='sales_${tabID}_${tab_obj[tabID]}'></tr>
                </tbody>
                </table>
                <div class="col-md-12">
                    <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_sales_${tabID}" name="profit_loss[${tabID}][sales][total]"/>
                    <a class="btn btn-santara-white pull-left" onclick="addReport(${tabID}, ${tab_obj[tabID]}, 'sales')">Tambah Baris</a>
                </div>
            </div>
        </div>

        <div class="row col-md-12 my-3">
            <div class="table-responsive">
                <table class="table table-bordered" id="tab_cogs_${tabID}">
                <thead>
                    <tr>
                        <th scope="col">Rincian HPP</th>
                        <th scope="col">Biaya ( Rp. )</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr id='cogs_${tabID}_${tab_obj[tabID]}'></tr>
                </tbody>
                </table>
                <div class="col-md-12">
                    <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_cogs_${tabID}" name="profit_loss[${tabID}][cogs][total]"/>
                    <a class="btn btn-santara-white pull-left" onclick="addReport(${tabID}, ${tab_obj[tabID]}, 'cogs')">Tambah Baris</a>
                </div>
            </div>
        </div>

        <div class="row col-md-12 my-3">
            <div class="table-responsive">
                <table class="table table-bordered" id="tab_cost_${tabID}">
                <thead>
                    <tr>
                        <th scope="col">Biaya Sales General dan Admin</th>
                        <th scope="col">Biaya ( Rp. )</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <tr id='cost_1_1'>
                    <td width="65%">
                        <input type="text" name='profit_loss[${tabID}][cost][list][1][desc]' value="Amortisasi" class="form-control" readonly/>
                    </td>
                    <td width="30%">
                        <input type="text" name='profit_loss[${tabID}][cost][list][1][amount]' value="0" class="form-control profit_loss_amount_cost_${tabID}" onkeyup="subTotal('cost',${tabID})" onkeypress="return numberOnlyMinus(event)" />
                    </td>
                    <td width='5%'><a class='pull-right btn btn-santara-white'><i class="la la-check-circle"></i></a></td>
                </tr>  
                <tr id='cost_1_2'>
                    <td width="65%">
                        <input type="text" name='profit_loss[${tabID}][cost][list][2][desc]' value="Depresiasi" class="form-control" readonly/>
                    </td>
                    <td width="30%">
                        <input type="text" name='profit_loss[${tabID}][cost][list][2][amount]' value="0" class="form-control profit_loss_amount_cost_${tabID}" onkeyup="subTotal('cost',${tabID})" onkeypress="return numberOnlyMinus(event)" />
                    </td>
                    <td width='5%'><a class='pull-right btn btn-santara-white'><i class="la la-check-circle"></i></a></td>
                </tr>  
                    <tr id='cost_${tabID}_${tab_obj[tabID]}'></tr>
                </tbody>
                </table>
                <div class="col-md-12">
                    <input type="text" class="form-control-plaintext pull-right" style="width:30%" value="0" id="profit_loss_total_cost_${tabID}" name="profit_loss[${tabID}][cost][total]"/>
                    <a class="btn btn-santara-white pull-left" onclick="addReport(${tabID}, ${tab_obj[tabID]}, 'cost')">Tambah Baris</a>
                </div>
            </div>
        </div>

        <div class="row col-md-12 my-3">
            <div class="table-responsive">
                <table class="table table-bordered" id="tab_other_${tabID}">
                <thead>
                    <tr>
                        <th scope="col">Pendapatan atau beban Lain</th>
                        <th scope="col">Biaya ( Rp. )</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr id='other_${tabID}_${tab_obj[tabID]}'></tr>   
                </tbody>
                </table>
                <small class='row mb-2 mx-1'>Apabila ingin mencantumkan beban, maka dapat diisikan dengan bilangan negatif ( Contoh : -1.000.000)</small>
                <div class="col-md-12">
                    <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_other_${tabID}" name="profit_loss[${tabID}][other][total]"/>
                    <a class="btn btn-santara-white pull-left" onclick="addReport(${tabID}, ${tab_obj[tabID]}, 'other')">Tambah Baris</a>
                </div>
            </div>
        </div>

        <div class="row col-md-12 my-3">
            <div class="table-responsive">
                <table class="table table-bordered" id="tab_tax_${tabID}">
                <thead>
                    <tr>
                        <th scope="col">Rincian Pajak</th>
                        <th scope="col">Biaya ( Rp. )</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr id='tax_${tabID}_${tab_obj[tabID]}'></tr>
                </tbody>
                </table>
                <div class="col-md-12">
                    <input type="text" class="form-control-plaintext pull-right" style="width:30%" id="profit_loss_total_tax_${tabID}" name="profit_loss[${tabID}][tax][total]"/>
                    <a class="btn btn-santara-white pull-left" onclick="addReport(${tabID}, ${tab_obj[tabID]}, 'tax')">Tambah Baris</a>
                </div>
            </div>
        </div>
    </div>`));
    };

    var table_name = null;
    var first_no = null;

    function addReport(tab_id, no, table) {

        if (!tab_obj.hasOwnProperty(tab_id)) {
            first_no = no;
            tab_obj[tab_id] = no;
        }

        var tab_no = tab_obj[tab_id];
        table_name = table;

        $('#' + table + '_' + tab_id + '_' + tab_no).html(
            "<td width='65%'><input name='profit_loss[" + tab_id + "][" + table + "][list][" + tab_no + "][desc]' type='text' class='form-control'/></td>" +
            "<td width='30%'><input name='profit_loss[" + tab_id + "][" + table + "][list][" + tab_no + "][amount]' type='text' class='form-control profit_loss_input profit_loss_amount_" + table + "_" + tab_id + " ' onkeyup='subTotal(" + '"' + table + '"' + ", " + '"' + tab_id + '"' + ")' onkeypress='return numberOnlyMinus(event)'/></td>" +
            "<td width='5%'><a class='pull-right btn btn-santara-white' onclick='removeReport(" + tab_id + "," + tab_no + "," + '"' + table + '"' + ")'><i class='la la-times'></i></a></td>");

        $('#tab_' + table + '_' + tab_id).append('<tr id="' + table + '_' + tab_id + '_' + (Number(tab_no) + Number(1)) + '"></tr>');
        tab_obj[tab_id]++;
        first_no++;
    };


    function removeReport(tab_id, tab_no, table) {
        $("#" + table + "_" + tab_id + "_" + tab_no).html('');
        subTotal(table, tab_id);
    };

    function subTotal(table, tab_id) {
        var subTotal = 0;
        $('.profit_loss_amount_' + table + '_' + tab_id).map(function(e) {
            this.value = this.value.replace(/\./g, '');
            subTotal += Number(this.value);
            if (!isNaN(this.value) && this.value !== '') {
                this.value = formatNumber(Number(this.value));
            }
        }).get();
        document.getElementById("profit_loss_total_" + table + '_' + tab_id).value = (isNaN(subTotal)) ? 0 : formatNumber(Number(subTotal));
    };
</script>