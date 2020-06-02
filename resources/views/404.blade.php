@extends('pages.main')

@section('content')
<section class="scroll-con-sec hero-section" data-scrollax-parent="true" id="sec1">
    <div class="bg"  data-bg="{{asset('images/33.jpg')}}" data-scrollax="properties: { translateY: '200px' }"></div>
    <div class="overlay"></div>
    <div class="hero-section-wrap fl-wrap">
      <div class="container">
          <div class="error-wrap">
              <h2>404</h2>
              <p>We're sorry, but the Page you were looking for, couldn't be found.</p>
              <div class="clearfix"></div>
              <a href="/" class="btn  big-btn  color-bg flat-btn">Back to Home Page<i class="fa fa-angle-right"></i></a>
          </div>
      </div>
    </div>
    <div class="bubble-bg"> </div>
</section>
@endsection
