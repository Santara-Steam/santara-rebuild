<div class="col-md-6 mb-3">
    <div class="form-group">
        <label><small><b><?= $title ?> <?= ($optional == 1) ? '( Optional )' : '' ?> :</b></small></label>
        <?php if ($type == 'text') : ?>
        <input type="text" 
               class="<?= $class ?> <?= ($data == '' && $optional == 0) ? 'invalid' : '' ?>" 
               id="<?= $column ?>" 
               value="<?= $data ?>" <?= $readonly ?>>
        <?php elseif($type == 'textarea') : ?>
        <textarea class="<?= $class ?> <?= $data == '' ? 'invalid' : '' ?>"
                  rows="5" 
                  style="padding: 10px;"
                  id="<?= $column ?>" <?= $readonly ?>><?= $data ?></textarea>
        <?php elseif($type == 'list') : ?>
            <ul>
            <?php 
            $dataArray = explode(',', $data);
            $source = array_map('trim',$dataArray);

            foreach($source as &$value) : ?>
                <li><?= $value ?></li>
            <?php endforeach; ?>
            </ul>
        <?php elseif($type == 'document') : ?>   
            <?php if ( $data ) : ?>
                <div class="form-row">
                    <a href="<?= $data ?>" 
                        class="btn btn-info-ghost btn-block <?= (!$data) ? 'disabled' : '' ?>" title="Download" target="_blank">
                        <?= ($data) ? 'Lihat Dokumen' : 'File tidak tersedia' ?>
                    </a>
                </div>
            <?php else: ?>
                <label class="py-3 red"><b><?= $title ?> belum diunggah</b></label>
            <?php endif; ?> 
        <?php elseif($type == 'image') : ?>   
            <?php if ( $data ) : ?>
            <div class="form-row text-center">
                <div class="form-group col-md-6 col-xl-12">       
                    <img src="<?= $data ?>"
                        onerror="this.onerror=null;this.src='<?= config('global.STORAGE_GOOGLE') ?>images/error/no-image.png';"
                        width="100%"
                        class="rounded mx-auto d-block"
                        alt="Card image cap" 
                        style="width: 400px;height: 250px;object-fit: contain;">
                </div>
                <?php if ( $action == "konfirmasi" ) : ?>
                <div class="form-group col-md-6 col-xl-12">
                    <button type="button" 
                            class="btn btn-sm btn-primary open-imageDialog" 
                            data-toggle="modal" 
                            data-target="#imageModal" 
                            data-image="<?= $data ?>">Lihat <?= $title ?></button>
                </div>
                <?php endif; ?>                      
            </div>
            <?php else: ?>
                <label class="py-3 red"><b><?= $title ?> belum diunggah</b></label>
            <?php endif; ?> 

            <?php if (false) : ?>
            <div class="row">                                    
                <div class="form-group col-md-12">
                    <label>Upload Foto Profile</label>
                    <input id="photo" 
                        type="file" <?= $data ? '' : 'required' ?>"
                        class="form-control-file"
                        value="<?= $data ?>"
                        accept="image/*" />
                    <div id="errorBlockPhoto" class="help-block" style="padding:10px; margin: 10px 0"></div>
                </div>
            </div>
            <?php endif ?>
        <?php elseif($type == 'photo') : ?>   
            <div class="form-row">
                <div class="form-group col-md-12 text-center">
                    <?php if ( $data ) : ?>
                        <img src="<?= $data ?>" 
                            width="50%"
                            class="img-thumbnail rotateimg lazyload"
                            style="width: 180px;height: 180px;object-fit: contain;"
                            alt="Card image cap"
                            onClick='rotateMe()'>        
                            <p class="red" style="font-size:11px; margin-top:5px;">
                                * Klik pada foto untuk memutar posisi
                            </p>
                    <?php else : ?>
                        <label class="py-3 red"><b>Foto Profile belum diunggah</b></label>
                    <?php endif ?>   

                    <?php if ( $action == "edit" ) : ?>
                    <div class="row">                                    
                        <div class="form-group col-md-12">
                            <label>Upload Foto Profile</label>
                            <input id="photo" 
                                type="file" <?= $data ? '' : 'required' ?>"
                                class="form-control-file"
                                value="<?= $data ?>"
                                accept="image/*" />
                            <div id="errorBlockPhoto" class="help-block" style="padding:10px; margin: 10px 0"></div>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php if ($action == 'konfirmasi') : ?>
<div class="col-md-6 content-center mb-3">
    <div class="row">
        <div class="radio-member col-md-12">
            <input class="radioUtama" type="radio" id="<?= $column ?>_yes" name="<?= $column ?>" value="1" <?= ($error) ? 'checked="checked"' : ( ($data == '' && $optional == 0) ? '' : 'checked="checked"' ); ?>>
            <label>Diterima </label>
            <input class="ml-1 radioUtama" type="radio" id="<?= $column ?>_no" name="<?= $column ?>" value="0" <?= ($error) ? 'checked="checked"' : ( ($data == '' && $optional == 0) ? 'checked="checked"' : '' ); ?> >
            <label>Ditolak</label>    
        </div>
        <div class="col-md-12">
            <div id="<?= $column ?>_option_ditolak" class="hidden">      
                @if(count($optionDitolak) > 0) 
                    <strong class="ml-2">Daftar Pilihan Ditolak</strong>
                    @for($i = 0; $i < count($optionDitolak); $i++)
                    <div class="radio-member">
                        <input type="radio" class="radio-tolak" id="<?= $column ?>-<?= $i ?>-option_tolak" 
                            name="error_<?= $column ?>" value="{{ $optionDitolak[$i] }}" />
                        <label>{{ $optionDitolak[$i] }}</label>    
                    </div>
                    @endfor
                @endif
            </div>
            <textarea class="form-control <?= ($data == '' && $optional == 0) ? 'required-form-kyc' : ''; ?>" 
                      rows="2" 
                      name="error_<?= $column ?>" 
                      id="error_<?= $column ?>"
                      <?= ($data == '' && $optional == 0) ? '' : 'disabled'; ?>><?= ($error) ? $error : ( ($data == '' && $optional == 0) ? 'Data '. $title . ' tidak boleh kosong' : ''); ?></textarea>
        </div>
    </div>
</div>
<?php endif; ?>
