<div class="form-grup row col-md-12">
    <div class="col-2 col-form-label"><b>Periode Laporan</b></div>
    <div class="col-2">
        <?php
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ]
        ?>

        <select name="month" class="form-control" required>
            <option disabled>Pilih Bulan</option>
            <?php foreach ($bulan as $k => $v) { ?>
                <option value="<?= $k ?>" <?= $k == $month ? 'selected' : '' ?>><?= $v ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-2">
        <select name="year" class="form-control" required>
            <option value="2019" <?= $year == '2019' ? 'selected' : '' ?>>2019</option>
            <option value="2020" <?= $year == '2020' ? 'selected' : '' ?>>2020</option>
            <option value="2021" <?= $year == '2021' ? 'selected' : '' ?>>2021</option>
            <option value="<?= date('Y') ?>" <?= $year == date('Y') ? 'selected' : '' ?>><?= date('Y') ?></option>
        </select>
    </div>
</div>
<br />
<?php if ($version > 0) : ?>
    <div class="form-grup row col-md-12">
        <div class="col-sm-2 col-form-label"><b>Keterangan Revisi</b></div>
        <div class="col-10">
            <textarea name="version_desc" class="form-control" cols="30" rows="5" placeholder="Deskripsi..."><?= $version_desc ?></textarea>
        </div>
    </div>
    <br />

    <div class="form-grup row col-md-12">
        <div class="col-sm-2 col-form-label"><b>Status Revisi Ke</b></div>
        <div class="col-10">
            <input type="text" readonly class="form-control-plaintext" id="version" value="<?= $version ?>">
        </div>
    </div>
<?php endif; ?>