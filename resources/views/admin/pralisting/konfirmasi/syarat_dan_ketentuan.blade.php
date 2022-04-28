<fieldset>
    <div class="row">
        <div class="col-md-12">
            <h3>Pernyataan Informasi</h3>
            <p>
                1. Dengan ini saya menyatakan, bahwa informasi yang saya sampaikan didalam form daftarkan bisnis ini
                adalah sesuai dengan keadaan yang sebenar-benarnya.
            </p>
            <p>
                2. Bahwa saya menerima setiap hasil yang dikeluarkan oleh menu daftarkan bisnis ini dengan penuh
                kesadaran.
            </p>
            <p>
                3. Dengan disetujuinya surat pernyataan ini, maka saya tunduk pada ketentuan internal perihal seleksi
                calon penerbit yang dijalankan oleh platform Santara.
            </p>

            <h5>Apakah Anda setuju dengan Syarat dan Ketentuan diatas ?</h5>
            <div class="form-group">
                <label class="pr-5">
                    <input type="checkbox" name="tnc" id="tnc" value="1"
                        <?= isset($emiten) && $emiten->tnc == 1 ? 'checked' : '' ?>>Saya setuju
                </label>
                <label id="tnc_error" class="font-danger" for="tnc_error" style="display:none;">Harus disetujui untuk
                    melanjutkan</label>
            </div>
        </div>
    </div>
</fieldset>
