<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="capital_needs">Besar kebutuhan dana *</label>
                <input type="text" class="form-control number-only format-number" name="capital_needs" 
                       id="capital_needs" maxlength="20"
                       value="<?= ( isset($emiten) ) ? number_format( $emiten->capital_needs, 0, ',', '.' ) : '' ?>" 
                       placeholder="Contoh: 1.000.000.000">
                <span id="capital_needs_error" class="font-danger"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="monthly_turnover">Rata-rata omset per bulan tahun ini *</label>
                <input type="text" class="form-control number-only format-number" name="monthly_turnover" 
                       id="monthly_turnover" maxlength="20" 
                       value="<?= ( isset($emiten) ) ? number_format( $emiten->monthly_turnover, 0, ',', '.' ) : '' ?>" 
                       placeholder="Contoh: 500.000.000">
                <span id="monthly_turnover_error" class="font-danger"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="monthly_profit">Rata-rata laba per bulan tahun ini *</label>
                <input type="text" class="form-control number-only format-number" name="monthly_profit" 
                       id="monthly_profit" maxlength="20"
                       value="<?= ( isset($emiten) ) ? number_format( $emiten->monthly_profit, 0, ',', '.' ) : '' ?>" 
                       placeholder="Contoh: 200.000.000">
                <span id="monthly_profit_error" class="font-danger"></span>
            </div>
        </div>
    </div>                                             

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="monthly_turnover_previous_year">Rata-rata omset per bulan tahun sebelumnya *</label>
                <input type="text" class="form-control number-only format-number" name="monthly_turnover_previous_year" 
                       id="monthly_turnover_previous_year" maxlength="20" 
                       value="<?= ( isset($emiten) ) ? number_format( $emiten->monthly_turnover_previous_year, 0, ',', '.' ) : '' ?>"  
                       placeholder="Contoh: 5.000.000.000">
                <span id="monthly_turnover_previous_year_error" class="font-danger"></span>
            </div>
        </div>
    </div>        

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="monthly_profit_previous_year">Rata-rata laba per bulan tahun sebelumnya *</label>
                <input type="text" class="form-control number-only format-number" name="monthly_profit_previous_year" 
                       id="monthly_profit_previous_year" maxlength="20"
                       value="<?= ( isset($emiten) ) ? number_format( $emiten->monthly_profit_previous_year, 0, ',', '.' ) : '' ?>" 
                       placeholder="Contoh: 2.000.000.000">
                <span id="monthly_profit_previous_year_error" class="font-danger"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="total_bank_debt">Total hutang bank / lembaga pembiayaan *</label>
                <input type="text" class="form-control number-only format-number" name="total_bank_debt" 
                       id="total_bank_debt" maxlength="20"
                       value="<?= ( isset($emiten) ) ? number_format( $emiten->total_bank_debt, 0, ',', '.' ) : '' ?>" 
                       placeholder="Contoh: 2.000.000.000">
                <span id="total_bank_debt_error" class="font-danger"></span>                                                    
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="bank_name_financing">Nama bank / lembaga pembiayaan *</label>
                <input type="text" class="form-control alpha-space-only" name="bank_name_financing" 
                       id="bank_name_financing" maxlength="20"
                       value="<?= ( isset($emiten) ) ? $emiten->bank_name_financing : '' ?>" 
                       placeholder="Contoh: Bank ABC">
                <span id="bank_name_financing" class="font-danger"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="total_paid_capital">Total modal disetor *</label>
                <input type="text" class="form-control number-only format-number" name="total_paid_capital" 
                       id="total_paid_capital" maxlength="20"
                       value="<?= ( isset($emiten) ) ? number_format( $emiten->total_paid_capital, 0, ',', '.' ) : '' ?>" 
                       placeholder="Contoh: 20.000.000">
                <label id="total_paid_capital_error_value" class="font-danger" for="total_paid_capital_error_value" style="display:none;">Tidak boleh kosong</label>
                <span id="total_paid_capital_error" class="font-danger"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="price">Nilai per lembar saham *</label>
                <input type="text" class="form-control number-only format-number" name="price" 
                       id="price" maxlength="20"
                       value="<?= ( isset($emiten) ) ? number_format( $emiten->price, 0, ',', '.' ) : '' ?>" 
                       placeholder="Contoh: 200.000">
                <label id="price_error_value" class="font-danger" for="price_error_value" style="display:none;">Tidak boleh kosong</label>                       
                <span id="price_error" class="font-danger"></span>
            </div>
        </div>
    </div>

    <?php if( $type == "edit") : ?>
        <div class="row my-2">    
            <div class="col-md-6 col-12">
                <a class="btn btn-block btn-danger-ghost" href="<?= site_url( 'user/pralisting/list' ) ?>"> Kembali </a>
            </div>
            <div class="col-md-6 col-12">
                <a class="btn btn-block btn-danger font-link-white" onclick="updatePraListing('<?= $emiten->uuid ?>','update-financial')" > Simpan Perubahan </a>
            </div>        
        </div>
    <?php endif; ?>
</fieldset> 