<fieldset>
    <div class="row my-3">
        <div class="col-12 text-center">
            <h3 class="my-2">Preview</h3> 
            <?php 
            if(isset($broadcast) && ($broadcast['list']) ):
                foreach ( $broadcast['list'] as $k => $v) : ?>
                <div class="preview-broadcast row" style="height: 80px;background: #FFFFFF;border: 1px solid #8C8C8C;width: 40%;text-align: left;margin: 0 auto;padding: .5rem;"/>
                    <div class="col-10">
                        <div style="font-size: 14px;"><b><span id="preview_title_0"><?= ( isset($broadcast['list'][0]) ) ? $broadcast['list'][0]['title'] : '' ?></span></b></div>
                        <div style="font-size: 11px;"><span id="preview_content_0"><?= ( isset($broadcast['list'][0]) ) ? $broadcast['list'][0]['content'] : '' ?></span></div>
                    </div>
                    <div class="col-2">
                        <img id="preview_image_0" src="" nerror="this.onerror=null;this.src='{{ env('STORAGE_GOOGLE') }}images/error/no-image.png';" width="80%" style="width: auto; height: 65px; float: right;">
                    </div>
                </div>
            <?php 
                endforeach; 
            else:
            ?>
                <div class="preview-broadcast row" style="height: 80px;background: #FFFFFF;border: 1px solid #8C8C8C;width: 40%;text-align: left;margin: 0 auto;padding: .5rem;"/>
                    <div class="col-10">
                        <div style="font-size: 14px;"><b><span id="preview_title_0"></span></b></div>
                        <div style="font-size: 11px;"><span id="preview_content_0"></span></div>
                    </div>
                    <div class="col-2">
                        <img id="preview_image_0" src="" nerror="this.onerror=null;this.src='{{ env('STORAGE_GOOGLE') }}images/error/no-image.png';" width="80%" style="width: auto; height: 65px; float: right;">
                    </div>
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
       
    
    <?php 
        if( isset($broadcast) && ($broadcast['target']) ): ?>
            <div class="col-12 my-3 row">
            <div id="target_list_preview" class="row col-12">
            <?php 
            foreach ( $broadcast['target'] as $k => $v) : ?>
                <div class="col-3">
                    <div class="card border border-light rounded">
                        <div class="card-body">
                        <h4 class="card-title"><?= $v['name'] ?></h4>
                        <p class="card-text"><?= $v['params'] ?></p>
                        </div>
                    </div>
                </div>
            <?php 
            endforeach; ?>
            </div>
            </div>
        <?php 
        else: ?>
            <div class="col-12 my-3">
                <div id="target_list_preview" class="row col-12"></div>
            </div>
    <?php endif; ?>

    <div class="col-12">
        <div class="card border border-light rounded">
            <div class="card-header"><h3><b>Users</b></h3></div>
            <div class="card-body">
            <?php if( isset($broadcast) && ($broadcast['users']) ): ?>
                <ul class="list-group list-group-flush" id="target_user_preview" style="max-height: 300px;overflow:auto;-webkit-overflow-scrolling: touch;">
                <?php foreach ( $broadcast['users'] as $v) : ?>
                        <li class="list-group-item"><?= $v ?></li>
                <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <ul class="list-group list-group-flush" id="target_user_preview" style="max-height: 300px;overflow:auto;-webkit-overflow-scrolling: touch;"></ul>
            <?php endif; ?>   
            </div>
        </div>
    </div>

</fieldset>