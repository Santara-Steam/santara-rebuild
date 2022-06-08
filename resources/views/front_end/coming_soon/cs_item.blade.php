<?php
                                            $picture = explode(',',$cs->pictures);
                                            if(empty($picture[0])){
                                            $picture[0] = 'default1.png';
                                            }else{
                                                $picture[0];
                                            }
                                            if(empty($picture[1])){
                                                $picture[1] = 'default2.png';
                                            }else{
                                                $picture[1];
                                            }
                                            if(empty($picture[2])){
                                                $picture[2] = 'default.png';
                                            }else{
                                                $picture[2];
                                            }
                                            if(empty($picture[3])){
                                                $picture[3] = 'default.png';
                                            }else{
                                                $picture[3];
                                            }
                                            if(empty($picture[4])){
                                                $picture[4] = 'default.png';
                                            }else{
                                                $picture[4];
                                            }
                                            if(empty($picture[5])){
                                                $picture[5] = 'default.png';
                                            }else{
                                                $picture[5];
                                            }
                                            if(empty($picture[6])){
                                                $picture[6] = 'default1.png';
                                            }else{
                                                $picture[6];
                                            }
                                            if(empty($cs->trademark)){
                                                $cs->trademark = $cs->company_name;
                                            }else{
                                                $cs->trademark;
                                            }
                                            ?>

              <div class="col-lg-3 col-sm-6 col-6" style="padding: 5px;">
                <a data-toggle="modal" id="detail" class="mod moldla" style="width: 100%;"
                  data-target="#exampleModalCenter" data-category="<?=$cs->ctg->category?>"
                  data-trademark="<?=$cs->trademark?>" data-company_name="<?=$cs->company_name?>"
                  data-like="<?=$cs->likes?>" data-minat="<?=$cs->vot?>" data-comment="<?=$cs->cmt?>"
                  data-id="<?=$cs->id?>" data-trdlike="<?=$cs->trdlike?>" data-trdvot="<?=$cs->trdvot?>"
                  data-image="<?=$picture[0]?>">
                  <div class="card moldla">
                    <img class="rectangle-2 moldla"
                      src="https://storage.googleapis.com/santara-bucket-prod/{{$picture[0]}}" />
                  </div>
                </a>
                <a href="{{ url('detail-coming-soon') }}/{{$cs->id}}" class="molpli">
                  <div class="card molpli">
                    <img class="rectangle-2" src="https://storage.googleapis.com/santara-bucket-prod/{{$picture[0]}}" />
                    <div class="content">
                      <div class="header-card-dan-progress">
                        <div class="header-and-tags">
                          <span class="tx-t inter-medium-sweet-pink-12px"
                            style="background: var(--falu-red);
                                    border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">
                            <?php echo \Illuminate\Support\Str::limit(strip_tags( $cs->ctg->category ), 20, $end='...') ?>
                          </span>
                          <div class="header">
                            <div class="saka-logistics inter-medium-alabaster-20px">
                              <span class="tx-pt inter-medium-alabaster">
                                <?php echo \Illuminate\Support\Str::limit(strip_tags( $cs->trademark ), 20, $end='...') ?>
                              </span>
                            </div>
                            <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                              <span class="tx-np inter-normal-quill-gray">
                                <?php echo \Illuminate\Support\Str::limit(strip_tags( $cs->company_name ), 30, $end='...') ?>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="icon-card row" style="display: flex;
                                  justify-content: center;
                                  align-items: center;">
                          @guest
                          <a href="{{route('login')}}" style="cursor: pointer">
                            <div class="icon-and-supporting-text">
                              <i class="icon-com iconheart fas fa-heart" style="color: #fff; font-size: 18px;"></i>
                              <div class="address-2 inter-normal-alabaster-10px">
                                <span class="tx-icon inter-normal-alabaster">{{$cs->likes}} Suka</span>
                              </div>
                            </div>
                          </a>
                          @else
                          @if (in_array(Auth::user()->trader->id,[$cs->trdlike]))

                          <a onclick="document.getElementById('sublike{{$cs->id}}').submit();" style="cursor: pointer">
                            @else
                            <a onclick="document.getElementById('like{{$cs->id}}').submit();" style="cursor: pointer">
                              @endif

                              {{-- <a onclick="document.getElementById('like{{$cs->id}}').submit();"
                                style="cursor: pointer"> --}}
                                <div class="icon-and-supporting-text">
                                  <i class="icon-com iconheart fas fa-heart" style="color: #fff; font-size: 18px;"></i>
                                  <div class="address-2 inter-normal-alabaster-10px">
                                    <span class="tx-icon inter-normal-alabaster">{{$cs->likes}} Suka</span>
                                  </div>
                                </div>
                              </a>
                              <form id="like{{$cs->id}}" action="{{url('addLike')}}/{{$cs->id}}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                              </form>

                              <form id="sublike{{$cs->id}}" action="{{url('subLike')}}/{{$cs->id}}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                              </form>
                              @endguest



                              @guest
                              <a href="{{route('login')}}" style="cursor: pointer">
                                <div class="icon-and-supporting-text-1">
                                  <i class="icon-com iconheart fas fa-user" style="color: #fff; font-size: 18px;"></i>
                                  <div class="address-2 inter-normal-alabaster-10px">
                                    <span class="tx-icon inter-normal-alabaster">{{$cs->vot}} Minat</span>
                                  </div>
                                </div>
                              </a>
                              @else
                              @if (in_array(Auth::user()->trader->id,[$cs->trdvote]))

                              <a onclick="document.getElementById('subvote{{$cs->id}}').submit();"
                                style="cursor: pointer">
                                @else
                                <a onclick="document.getElementById('vote{{$cs->id}}').submit();"
                                  style="cursor: pointer">
                                  @endif
                                  <div class="icon-and-supporting-text-1">
                                    <i class="icon-com iconheart fas fa-user" style="color: #fff; font-size: 18px;"></i>
                                    <div class="address-2 inter-normal-alabaster-10px">
                                      <span class="tx-icon inter-normal-alabaster">{{$cs->vot}} Minat</span>
                                    </div>
                                  </div>
                                </a>
                                <form id="vote{{$cs->id}}" action="{{url('addVote')}}/{{$cs->id}}" method="POST"
                                  enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                </form>
                                <form id="subvote{{$cs->id}}" action="{{url('subVote')}}/{{$cs->id}}" method="POST"
                                  enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                </form>

                                @endguest
                                <a style="cursor: pointer" data-id="{{$cs->id}}" data-toggle="modal"
                                  data-target="#modal{{$cs->id}}" class="cmt">
                                  <div class="icon-and-supporting-text-2">
                                    <i class="icon-com iconheart fas fa-comments"
                                      style="color: #fff; font-size: 18px;"></i>
                                    <div class="address-2 inter-normal-alabaster-10px">
                                      <span class="tx-icon inter-normal-alabaster">{{$cs->cmt}} Komentar</span>
                                    </div>
                                  </div>
                                </a>
                                <a style="cursor: pointer" data-id="{{$cs->id}}" data-toggle="modal"
                                  data-target="#modalShareButton{{$cs->id}}">
                                  <div class="icon-and-supporting-text-2">
                                    <i class="icon-com iconheart fas fa-share"
                                      style="color: #fff; font-size: 18px;"></i>
                                    <div class="address-2  inter-normal-alabaster-10px">
                                      <span class="tx-icon inter-normal-alabaster">Share</span>
                                    </div>
                                  </div>
                                </a>
                        </div>
                      </div>
                      <div class="footer-card">
                        <img class="divider" src="{{ asset('assets/images/divider-108@2x.png') }}" />
                        <a href="{{ url('detail-coming-soon') }}/{{$cs->id}}"
                          class="button btn-block btn btn-outline-light inter-medium-white-14px">Dukung Bisnis
                          Ini</a>
                      </div>
                    </div>
                </a>
              </div>
            </div>
