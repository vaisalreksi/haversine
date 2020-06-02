@extends('pages.main')

@section('content')
<section class="scroll-con-sec hero-section" data-scrollax-parent="true" id="sec1">
    <div class="bg"  data-bg="images/33.jpg" data-scrollax="properties: { translateY: '200px' }"></div>
    <div class="overlay"></div>
    <div class="hero-section-wrap fl-wrap">
        <div class="container">
            <div class="intro-item fl-wrap">
                <h2>We will help you to find all</h2>
                <h3>Find great places , hotels , restourants.</h3>
            </div>
            <div class="main-search-input-wrap">
                <div class="main-search-input fl-wrap">
                    <div class="main-search-input-item">
                        <input type="text" placeholder="What are you looking for?" value="" id="text_search"/>
                    </div>
                    <div class="main-search-input-item location" id="autocomplete-container">
                        <input type="text" placeholder="Location" id="autocomplete-input" value=""/>
                        <a href="#"><i class="fa fa-dot-circle-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bubble-bg"> </div>
</section>
@endsection
