<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="company_name">Nama Perusahaan *</label>
                <input type="text" class="form-control alpha-space-only" name="company_name" id="company_name" maxlength="40" value="<?= ( isset($emiten) ) ? $emiten->company_name : '' ?>" placeholder="Contoh: PT. SANTARA">
                <span id="company_name_error" class="font-danger"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="trademark">Merk Dagang *</label>
                <input type="text" class="form-control" name="trademark" id="trademark" value="<?= ( isset($emiten) ) ? $emiten->trademark : '' ?>" placeholder="SANTARA">
                <span id="trademark_error" class="font-danger"></span>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="category">Jenis Usaha *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                    <input type="text" class="form-control" name="company_name" id="company_name" value="<?= ( isset($emiten) ) ? $emiten->category : '' ?>" placeholder="Contoh: PT. SANTARA">
                <?php else: ?>
                    <select name="category" id="category" class="form-control">
                    <option selected disabled value="">Pilih</option>
                    <?php foreach ( $categories as $c ) : ?>
                        <option value="<?= $c->id ?>" <?= ( isset($emiten) && ($emiten->category_id == $c->id) ) ? 'selected' : '' ?>><?= $c->category ?></option>
                    <?php endforeach; ?>
                    </select>
                    <span id="category_error" class="font-danger"></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="category">Sub Jenis Usaha *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                    <input type="text" class="form-control" name="subcategory" id="subcategory" value="<?= ( isset($emiten) ) ? $emiten->subcategory : '' ?>">
                <?php else: ?>            
                    <select name="subcategory" id="subcategory" class="form-control">
                        <?php if( $type == 'edit' ) : ?>
                            <?php foreach ( $subcategories as $k => $v ) : ?>
                                <option value="<?= $v->id ?>" <?= ( isset($emiten) && ($emiten->sub_category_id == $v->id) ) ? 'selected' : '' ?>><?= $v->sub_category ?></option>
                            <?php endforeach; ?>
                        <?php else: ?> 
                            <option selected disabled value="">Pilih</option>           
                        <?php endif; ?>
                    </select>
                    <span id="category_error" class="font-danger"></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="regency">Kota Lokasi Usaha *</label>
                <?php if( $type == 'konfirmasi' ) : ?>
                    <input type="text" class="form-control" name="regency" id="regency" value="<?= ( isset($emiten) ) ? $emiten->regency : '' ?>">
                <?php else: ?>                     
                    <select name="regency" id="regency" class="form-control">
                    <option selected disabled value="">Pilih</option>
                    <?php foreach ( $regencies as $r ) : ?>
                        <option value="<?= $r->id ?>" <?= ( isset($emiten) && ($emiten->regency_id == $r->id) ) ? 'selected' : '' ?>><?= $r->name ?></option>
                    <?php endforeach; ?>
                    </select>
                    <span id="regency_error" class="font-danger"></span>
                <?php endif; ?>    
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="address">Alamat Lengkap Perusahaan *</label>
                <textarea class="form-control" rows="7" cols="50" name="address" id="address" placeholder="Contoh: Jl Pasir No.35, Patuk, Banyuraden, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta"><?= ( isset($emiten) ) ? $emiten->address : '' ?></textarea>
                <span id="address_error" class="font-danger"></span>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="business_entity">Bentuk Badan Usaha *</label>       
                <?php if( $type == 'konfirmasi' ) : ?>
                    <input type="text" class="form-control" name="business_entity" id="business_entity" value="<?= ( isset($emiten) ) ? $emiten->business_entity : '' ?>">
                <?php else: ?>         
                    <select name="business_entity" id="business_entity" class="form-control">
                    <?php foreach ( $option->business_entity as $k => $v ) : ?>
                        <option <?= ( isset($emiten) && $emiten->business_entity == $v) ? 'selected' : '' ?>  value="<?= $k?>"><?= $v ?></option>
                    <?php endforeach; ?>
                    </select>   
                <?php endif; ?>       
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="business_lifespan">Lama Usaha (Bulan) *</label>
                <input type="text" class="form-control" name="business_lifespan" id="business_lifespan" value="<?= ( isset($emiten) ) ? $emiten->business_lifespan : '' ?>" onkeypress="return isNumberKey(event)" placeholder="Contoh: 2">
                <span id="business_lifespan_error" class="font-danger"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="branch_company">Jumlah Cabang *</label>
                <input type="text" class="form-control" name="branch_company" id="branch_company" value="<?= ( isset($emiten) ) ? $emiten->branch_company : '' ?>" onkeypress="return isNumberKey(event)" placeholder="Contoh: 30">
                <span id="branch_company_error" class="font-danger"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="employee">Jumlah Karyawan *</label>
                <input type="text" class="form-control" name="employee" id="employee" value="<?= ( isset($emiten) ) ? $emiten->employee : '' ?>" onkeypress="return isNumberKey(event)" placeholder="Contoh: 70">
                <span id="employee_error" class="font-danger"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="business_description">Deskripsi Singkat Perusahaan (Maksimal input 500 karakter) *</label>
                <textarea class="form-control" rows="5" cols="50" name="business_description" id="business_description" placeholder="Santara adalah platform urun dana atau lebih dikenal dengan istilah Equity Crowdfunding."><?= ( isset($emiten) ) ? $emiten->business_description : '' ?></textarea>
                <span id="business_description_error" class="font-danger"></span>                                                    
            </div>
        </div>
    </div>
    
    <?php if(false) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>No Telp</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" minlength="10" placeholder="Contoh: 0858123XXXXXXXX"/>
                <span id="no_telp_error" class="text-danger"></span>    
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" id="email" minlength="5" placeholder="Contoh: nama@email.com"/>
                <span id="email_error" class="text-danger"></span>    
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>No Fax</label>
                <input type="text" class="form-control" name="no_fax" id="no_fax" minlength="5" placeholder="Contoh: 123123123"/>
                <span id="email_error" class="text-danger"></span>    
            </div>
        </div>
    </div>

    <h1 class="card-title text-left"><b>Profile Team</b></h1>
    <div id='profile_team_box'>
        <div class="row" id="profile_team_1">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama_team" id="nama_team_1" minlength="5" placeholder="Contoh: Nama Satu"/>
                    <span id="nama_team_error" class="text-danger"></span>    
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="jabatan_team" id="jabatan_team_1" minlength="5" placeholder="Contoh: Jabatan Satu"/>
                    <span id="jabatan_team_error" class="text-danger"></span>    
                </div>
            </div>
        </div>
    </div>
    <div>
        <button type="button" id="addTeam" class="btn btn-primary btn-sm pull-left" title="Tambah Team">Tambah Team</button>
        <button type="button" id="removeTeam" class="btn btn-primary btn-sm pull-right" title="Hapus Team">Hapus Team</button>
    </div>
    <br/>
    <br/>
    <br/>

    <h1 class="card-title text-left"><b>Social Media ( Link Social Media )</b></h1>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Facebook</label>
                <input type="text" class="form-control" name="facebook" id="facebook" minlength="5" placeholder="Contoh: facebook.com/usernamefacebook"/>
                <span id="facebook_error" class="text-danger"></span>    
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Twitter</label>
                <input type="text" class="form-control" name="twitter" id="twitter" minlength="5" placeholder="Contoh: twitter.com/usernametwitter"/>
                <span id="twitter_error" class="text-danger"></span>    
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Youtube</label>
                <input type="text" class="form-control" name="youtube" id="youtube" minlength="5" placeholder="Contoh: youtube.com/usernameyoutube"/>
                <span id="youtube_error" class="text-danger"></span>    
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Instagram</label>
                <input type="text" class="form-control" name="instagram" id="instagram" minlength="5" placeholder="Contoh: instagram.com/usernameinstagram"/>
                <span id="instagram_error" class="text-danger"></span>    
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if( $type == "edit") : ?>
        <div class="row my-2">    
            <div class="col-md-6 col-12">
                <a class="btn btn-block btn-danger-ghost" href="<?= site_url( 'user/pralisting/list' ) ?>"> Kembali </a>
            </div>
            <div class="col-md-6 col-12">
                <a class="btn btn-block btn-danger font-link-white" onclick="updatePraListing('<?= $emiten->uuid ?>','update-identity')" > Simpan Perubahan </a>
            </div>        
        </div>
    <?php endif; ?>
</fieldset>   