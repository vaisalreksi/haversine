@extends('pages.main')

@section('content')
    <section class="parallax-section single-par list-single-section" data-scrollax-parent="true" id="sec1">
        <!-- <div class="bg par-elem "  data-bg="images/detail-restaurant.jpg" data-scrollax="properties: { translateY: '30%' }"></div> -->
        <div class="media-container video-parallax">
            <div class="bg mob-bg" style="background-image: url({{ asset($data['img']) }})"></div>
            <div class="video-container">
                <video autoplay  loop muted  class="bgvid">
                    <source src="{{ asset($data['video']) }}" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="overlay"></div>
        <div class="bubble-bg"></div>
        <div class="list-single-header absolute-header fl-wrap">
            <div class="container">
                <div class="list-single-header-item">
                    <div class="list-single-header-item-opt fl-wrap">
                        <div class="list-single-header-cat fl-wrap">
                            <a href="#">{{$data['type']}}</a>
                        </div>
                    </div>
                    <h2>{{$data['title']}}</h2>
                    <span class="section-separator"></span>
                    <div class="listing-rating card-popup-rainingvis">
                        <span>({{$data['distance']}} KM)</span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="list-single-header-contacts fl-wrap">
                                <ul>
                                    @if(!empty($data['phone'])) <li><i class="fa fa-phone"></i><a  href="#">{{$data['phone']}}</a></li> @endif
                                    @if(!empty($data['email'])) <li><i class="fa fa-envelope-o"></i><a  href="#">{{$data['email']}}</a></li> @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fl-wrap list-single-header-column">
                                <div class="share-holder hid-share">
                                    <a href="{{$data['direction']}}" target="_blank"><div class="showshare"><span>Direction </span><i class="fa fa-share"></i></div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  section end -->
    <div class="scroll-nav-wrapper fl-wrap">
        <div class="container">
            <nav class="scroll-nav scroll-init">
                <ul>
                    <li><a class="act-scrlink" href="#sec1">Top</a></li>
                    <li><a href="#sec2">Details</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!--  section  -->
    <section class="gray-section no-top-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="list-single-main-wrapper fl-wrap" id="sec2">
                        <div class="list-single-main-media fl-wrap">
                            <img src="{{asset($data['image'])}}" class="respimg" alt="">
                        </div>
                        <div class="list-single-main-item fl-wrap">
                            <div class="list-single-main-item-title fl-wrap">
                                <h3>About</h3>
                            </div>
                            <p>{{$data['description']}}</p>
                            <span class="fw-separator"></span>
                            <div class="list-single-main-item-title fl-wrap">
                                <h3>Tags</h3>
                            </div>
                            <div class="list-single-tags tags-stylwrap">
                                <?php
                                  $key = explode(',',$data['keyword']);
                                  if(!empty($key)){
                                    foreach ($key as $value) {
                                      echo '<a href="#">'.$value.'</a>';
                                    }
                                  }
                                ?>
                            </div>
                        </div>
                        <!-- list-single-main-item end -->
                    </div>
                </div>
                <!--box-widget-wrap -->
                <div class="col-md-4">
                    <div class="box-widget-wrap">
                        <div class="box-widget-item fl-wrap">
                            <div class="box-widget-item-header">
                                <h3>Location / Contacts : </h3>
                            </div>
                            <div class="box-widget">
                                <div class="map-container">
                                    <div id="singleMap" data-latitude="{{$data['latitude']}}" data-longitude="{{$data['longitude']}}" data-mapTitle="Out Location"></div>
                                </div>
                                <div class="box-widget-content">
                                    <div class="list-author-widget-contacts list-item-widget-contacts">
                                        <ul>
                                            <li><span><i class="fa fa-map-marker"></i> Adress :</span> <a href="#">{{$data['address']}}</a></li>
                                            <li><span><i class="fa fa-phone"></i> Phone :</span> <a href="#">{{$data['phone']}}</a></li>
                                            <li><span><i class="fa fa-envelope-o"></i> Mail :</span> <a href="#">{{$data['email']}}</a></li>
                                            <li><span><i class="fa fa-globe"></i> Website :</span> <a href="#">{{$data['website']}}</a></li>
                                        </ul>
                                    </div>
                                    <div class="list-widget-social">
                                        <ul>
                                            @if(!empty($data['facebook']))
                                              <li><a href="{{$data['facebook']}}" target="_blank" ><i class="fa fa-facebook"></i></a></li>
                                            @endif
                                            @if(!empty($data['twitter']))
                                              <li><a href="{{$data['twitter']}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                            @endif
                                            @if(!empty($data['youtube']))
                                              <li><a href="{{$data['youtube']}}" target="_blank" ><i class="fa fa-youtube"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--box-widget-wrap end -->

                <div class="col-md-12">
                      <div class="listsearch-header fl-wrap">
                          <h3>Recommendation : <span>Hotel and Restaurant</span></h3>
                      </div>
                      <!-- list-main-wrap-->
                      <div class="list-main-wrap fl-wrap card-listing" id="content-list">
                          <!-- listing-item -->
                          @if(!empty($data['recommendation']))
                            <?php $i=1; ?>
                            @foreach($data['recommendation'] as $value)
                                  <!-- listing-item -->
                                  <div class="listing-item" style="width:25%;">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <img src="{{asset($value['image'])}}" alt="">
                                            <div class="overlay"></div>
                                            <div class="list-post-counter"><i class="fa fa-heart"></i></div>
                                        </div>
                                        <div class="geodir-category-content fl-wrap">
                                            <a class="listing-geodir-category" href="{{url($value['link'])}}">{{$value['type']}}</a>
                                            <div class="listing-avatar"><a href="{{url($value['link'])}}"><img src="{{asset($value['image'])}}" alt=""></a>
                                            </div>
                                            <h3><a href="{{url($value['link'])}}">{{$value['title']}}</a></h3>
                                            <p></p>
                                            <div class="geodir-category-options fl-wrap">
                                                <div class="listing-rating card-popup-rainingvis">
                                                  <span>({{$value['distance']}} KM)</span>
                                                </div>
                                                <div class="geodir-category-location"><a href="#0" class="map-item scroll-top-map"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$value['address']}}</a></div>
                                            </div>
                                        </div>
                                    </article>
                                  </div>

                              @if($i % 4==0) <div class="clearfix"></div> @endif
                              <?php $i++; ?>
                            @endforeach
                          @endif
                      </div>
                      <!-- list-main-wrap end-->
                  </div>
            </div>
        </div>
    </section>
    <!--  section end -->

    <div class="limit-box fl-wrap"></div>

@endsection
