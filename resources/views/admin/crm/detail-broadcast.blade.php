@extends('admin.layout.master')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2><strong>Detail Broadcast</strong></h2>
                        </div>
                        <div class="card-body">
                            @if (isset($broadcast) && $broadcast['list'])
                                @foreach ($broadcast['list'] as $k => $v)
                                    <div class="preview-broadcast row"
                                        style="height: 80px;background: #FFFFFF;border: 1px solid #8C8C8C;width: 40%;text-align: left;margin: 0 auto;padding: .5rem;">
                                        <div class="col-10">
                                            <div style="font-size: 14px;"><b><span
                                                        id="preview_title_0"><?= isset($broadcast['list'][0]) ? $broadcast['list'][0]['title'] : '' ?></span></b>
                                            </div>
                                            <div style="font-size: 11px;"><span
                                                    id="preview_content_0"><?= isset($broadcast['list'][0]) ? $broadcast['list'][0]['content'] : '' ?></span>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <img id="preview_image_0" src=""
                                                nerror="this.onerror=null;this.src='{{ config('global.STORAGE_GOOGLE') }}images/error/no-image.png';"
                                                width="80%" style="width: auto; height: 65px; float: right;">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="preview-broadcast row"
                                    style="height: 80px;background: #FFFFFF;border: 1px solid #8C8C8C;width: 40%;text-align: left;margin: 0 auto;padding: .5rem;">
                                    <div class="col-10">
                                        <div style="font-size: 14px;"><b><span id="preview_title_0"></span></b></div>
                                        <div style="font-size: 11px;"><span id="preview_content_0"></span></div>
                                    </div>
                                    <div class="col-2">
                                        <img id="preview_image_0" src=""
                                            nerror="this.onerror=null;this.src='{{ config('global.STORAGE_GOOGLE') }}images/error/no-image.png';"
                                            width="80%" style="width: auto; height: 65px; float: right;">
                                    </div>
                                </div>
                            @endif

                            @if (isset($broadcast) && $broadcast['target'])
                                <div class="col-12 my-3 row">
                                    <div id="target_list_preview" class="row col-12">
                                        @foreach ($broadcast['target'] as $k => $v)
                                            <div class="col-4">
                                                <div class="card border border-light rounded">
                                                    <div class="card-body">
                                                        <h4 class="card-title"><?= $v['name'] ?></h4>
                                                        @if($v['name'] == 'Pendapatan Per Tahun' || 
                                                            $v['name'] == 'Jumlah Saham (Rp)' || 
                                                            $v['name'] == 'Sisa Limit Investasi' ||
                                                            $v['name'] == 'Rata-rata Pembelian' || 
                                                            $v['name'] == 'Deposit' )
                                                            <p class="card-text">
                                                                <?php $money = explode(" ", $v['params']); ?>
                                                                <?= rupiahBiasa($money[0]).' - '.rupiahBiasa($money[2])?>
                                                            </p>
                                                        @else 
                                                            <p class="card-text"><?= $v['params'] ?></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="col-12 my-3">
                                    <div id="target_list_preview" class="row col-12"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
