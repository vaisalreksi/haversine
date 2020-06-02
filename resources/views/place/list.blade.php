@extends('pages.main')

@section('content')
  <div class="map-container fw-map">
      <div id="map-main"></div>
      <ul class="mapnavigation">
          <li><a href="#" class="prevmap-nav">Prev</a></li>
          <li><a href="#" class="nextmap-nav">Next</a></li>
      </ul>
     <div class="scrollContorl mapnavbtn" title="Enable Scrolling"><span><i class="fa fa-lock"></i></span></div>
  </div>
  <!-- Map end -->
  <!-- section -->
  <section class="gray-bg no-pading no-top-padding">
      <div class="col-list-wrap fh-col-list-wrap  left-list">
          <div class="container">
              <div class="row">
                  <div class="col-md-4">
                      <div class="fl-wrap">
                          <!-- listsearch-input-wrap  -->
                          <div class="listsearch-input-wrap fl-wrap">
                              <div class="listsearch-input-item">
                                  <i class="mbri-key single-i"></i>
                                  <input type="text" placeholder="Keywords?" value="{{$key}}" id="keyword"/>
                              </div>
                              <div class="listsearch-input-text" id="autocomplete-container">
                                <label><i class="mbri-map-pin"></i> Enter Addres </label>
                                <input type="text" placeholder="Destination , Area , Street" id="autocomplete-input" class="qodef-archive-places-search" value=""/>
                                <a  href="#"  class="loc-act qodef-archive-current-location"><i class="fa fa-dot-circle-o"></i></a>
                              </div>
                              <input type="hidden" id="param_lat">
                              <input type="hidden" id="param_long">
                              <div class="distance-input fl-wrap">
                                  <div class="distance-title"> Radius around selected destination <span></span> km</div>
                                  <div class="distance-radius-wrap fl-wrap">
                                      <input class="distance-radius rangeslider--horizontal" id="range-distance" type="range" min="1" max="100" step="1" value="{{$distance}}" data-title="Radius around selected destination">
                                  </div>
                              </div>
                              <!-- Checkboxes -->
                              <div class=" fl-wrap filter-tags">

                              </div>
                              <!-- hidden-listing-filter end -->
                              <button class="button fs-map-btn" onclick="sendData()">Update</button>
                          </div>
                          <!-- listsearch-input-wrap end -->
                      </div>
                  </div>
                  <div class="col-md-8">
                      <div class="listsearch-header fl-wrap">
                          <h3>Recommendation : <span>Hotel and Restaurant</span></h3>
                          <div class="listing-view-layout">
                              <ul>
                                  <li><a class="grid active" href="#"><i class="fa fa-th-large"></i></a></li>
                                  <li><a class="list" href="#"><i class="fa fa-list-ul"></i></a></li>
                              </ul>
                          </div>
                      </div>
                      <!-- list-main-wrap-->
                      <div class="list-main-wrap fl-wrap card-listing" id="content-list">
                          <!-- listing-item -->
                          @if(!empty($data))
                            <?php $i=1;?>
                            @foreach($data as $value)
                              <div class="listing-item">
                                  <article class="geodir-category-listing fl-wrap">
                                      <div class="geodir-category-img">
                                          <img src="{{$value['image']}}" alt="">
                                          <div class="overlay"></div>
                                          <div class="list-post-counter"><i class="fa fa-heart"></i></div>
                                      </div>
                                      <div class="geodir-category-content fl-wrap">
                                          <a class="listing-geodir-category" href="{{$value['link']}}">{{$value['type']}}</a>
                                          <div class="listing-avatar"><a href="{{$value['link']}}"><img src="{{$value['image']}}" alt=""></a>
                                          </div>
                                          <h3><a href="{{$value['link']}}">{{$value['title']}}</a></h3>
                                          <p>{{$value['desc']}}</p>
                                          <div class="geodir-category-options fl-wrap">
                                              <div class="listing-rating card-popup-rainingvis" >
                                                <span>({{$value['view']}} KM)</span>
                                              </div>
                                              <div class="geodir-category-location"><a href="#0" class="map-item scroll-top-map"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$value['address']}}</a></div>
                                          </div>
                                      </div>
                                  </article>
                              </div>
                              @if($i % 2 == 0)
                                <div class="clearfix"></div>
                              @endif
                              <?php $i++;?>
                            @endforeach
                          @else
                            <div class="listing-item">
                                <article class="geodir-category-listing fl-wrap">
                                    <div class="geodir-category-content fl-wrap">
                                      Data Not Found
                                    </div>
                                </article>
                            </div>
                            <div class="clearfix"></div>
                          @endif

                          <!-- listing-item end-->
                          <!-- pagination-->
                          <!-- <div class="pagination">
                              <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                              <a href="#" class="blog-page transition">1</a>
                              <a href="#" class="blog-page current-page transition">2</a>
                              <a href="#" class="blog-page transition">3</a>
                              <a href="#" class="blog-page transition">4</a>
                              <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                          </div> -->
                      </div>
                      <!-- list-main-wrap end-->
                  </div>

                  <!-- sidebar filters end -->
              </div>
          </div>
      </div>
  </section>
  <!-- section end -->
  <div class="limit-box fl-wrap"></div>
@endsection
