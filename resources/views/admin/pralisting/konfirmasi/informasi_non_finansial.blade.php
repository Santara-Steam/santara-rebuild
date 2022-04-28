<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="financial_recording_system">Sistem Pencatatan Keuangan *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                <input type="text" class="form-control" name="financial_recording_system"
                    value="<?= isset($emiten) ? $emiten->financial_recording_system : '' ?>">
                <?php else: ?>
                <select name="financial_recording_system" id="financial_recording_system" class="form-control">
                    <?php foreach ( $option->financial_recording_system as $k => $v ) : ?>
                    <option <?= isset($emiten) && $emiten->financial_recording_system == $v ? 'selected' : '' ?>
                        value="<?= $k ?>"><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="financial_recording_system_error" class="font-danger"></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="bank_loan_reputation">Reputasi Pinjaman Bank/Lainya *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                <input type="text" class="form-control" name="bank_loan_reputation"
                    value="<?= isset($emiten) ? $emiten->bank_loan_reputation : '' ?>">
                <?php else: ?>
                <select name="bank_loan_reputation" id="bank_loan_reputation" class="form-control">
                    <?php foreach ( $option->bank_loan_reputation as $k => $v ) : ?>
                    <option <?= isset($emiten) && $emiten->bank_loan_reputation == $v ? 'selected' : '' ?>
                        value="<?= $k ?>"><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="bank_loan_reputation_error" class="font-danger"></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="market_position_for_the_product">Posisi Pasar atas Produk / Jasa *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                <input type="text" class="form-control" name="market_position_for_the_product"
                    value="<?= isset($emiten) ? $emiten->market_position_for_the_product : '' ?>">
                <?php else: ?>
                <select name="market_position_for_the_product" id="market_position_for_the_product"
                    class="form-control">
                    <?php foreach ( $option->market_position_for_the_product as $k => $v ) : ?>
                    <option <?= isset($emiten) && $emiten->market_position_for_the_product == $v ? 'selected' : '' ?>
                        value="<?= $k ?>"><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="market_position_for_the_product_error" class="font-danger"></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="strategy_emiten">Strategi Kedepan *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                <input type="text" class="form-control" name="strategy_emiten"
                    value="<?= isset($emiten) ? $emiten->strategy_emiten : '' ?>">
                <?php else: ?>
                <select name="strategy_emiten" id="strategy_emiten" class="form-control">
                    <?php foreach ( $option->strategy_emiten as $k => $v ) : ?>
                    <option <?= isset($emiten) && $emiten->strategy_emiten == $v ? 'selected' : '' ?> value="<?= $k ?>">
                        <?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="strategy_emiten_error" class="font-danger"></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="office_status">Status Lokasi / Kantor / Tempat Usaha *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                <input type="text" class="form-control" name="office_status"
                    value="<?= isset($emiten) ? $emiten->office_status : '' ?>">
                <?php else: ?>
                <select name="office_status" id="office_status" class="form-control">
                    <?php foreach ( $option->office_status as $k => $v ) : ?>
                    <option <?= isset($emiten) && $emiten->office_status == $v ? 'selected' : '' ?> value="<?= $k ?>">
                        <?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="office_status_error" class="font-danger"></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="level_of_business_competition">Tingkat Persaingan *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                <input type="text" class="form-control" name="level_of_business_competition"
                    value="<?= isset($emiten) ? $emiten->level_of_business_competition : '' ?>">
                <?php else: ?>
                <select name="level_of_business_competition" id="level_of_business_competition" class="form-control">
                    <?php foreach ( $option->level_of_business_competition as $k => $v ) : ?>
                    <option <?= isset($emiten) && $emiten->level_of_business_competition == $v ? 'selected' : '' ?>
                        value="<?= $k ?>"><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="level_of_business_competition_error" class="font-danger"></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="managerial_ability">Kemampuan Manajerial *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                <input type="text" class="form-control" name="managerial_ability"
                    value="<?= isset($emiten) ? $emiten->managerial_ability : '' ?>">
                <?php else: ?>
                <select name="managerial_ability" id="managerial_ability" class="form-control">
                    <?php foreach ( $option->managerial_ability as $k => $v ) : ?>
                    <option <?= isset($emiten) && $emiten->managerial_ability == $v ? 'selected' : '' ?>
                        value="<?= $k ?>"><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="managerial_ability_error" class="font-danger"></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="technical_ability">Kemampuan Teknis *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                <input type="text" class="form-control" name="technical_ability"
                    value="<?= isset($emiten) ? $emiten->technical_ability : '' ?>">
                <?php else: ?>
                <select name="technical_ability" id="technical_ability" class="form-control">
                    <?php foreach ( $option->technical_ability as $k => $v ) : ?>
                    <option <?= isset($emiten) && $emiten->technical_ability == $v ? 'selected' : '' ?>
                        value="<?= $k ?>"><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="technical_ability" class="font-danger"></span>
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
                onclick="updatePraListing('<?= $emiten->uuid ?>','update-non-financial')"> Simpan Perubahan </a>
        </div>
    </div>
    <?php endif; ?>

</fieldset>
