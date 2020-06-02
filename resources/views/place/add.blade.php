@extends('pages.main')

@section('content')
<section id="sec1">
    <!-- container -->
    <div class="container">
        <!-- profile-edit-wrap -->
        <div class="profile-edit-wrap">
            <div class="profile-edit-page-header">
                <h2>Add Location</h2>
                <div class="breadcrumbs"><a href="/">Home</a><span>Add Location</span></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="fixed-bar fl-wrap">
                        <div class="user-profile-menu-wrap fl-wrap">
                            <div class="col-md-12">
                                <!-- profile-edit-container-->
                                <form action="{{ url('add-location') }}" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="hidden" name="_requestToken" value="{{ bcrypt(csrf_token().time()) }}">
                                  <div class="profile-edit-container add-list-container">
                                    <div class="profile-edit-header fl-wrap">
                                        <h4>Basic Informations</h4>
                                    </div>
                                    <div class="custom-form">
                                        <label>Listing Title <i class="fa fa-briefcase"></i></label>
                                        <input type="text" placeholder="Name of your business" value="" name="name" required />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Category</label>
                                                <select data-placeholder="All Categories" class="chosen-select" name="type" >
                                                    <option value="0">tourist attraction</option>
                                                    <option value="1">Hotels</option>
                                                    <option value="2">Restaurants</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Keywords <i class="fa fa-key"></i></label>
                                                <input type="text" placeholder="should be separated by commas" value="" name="keyword"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class="profile-edit-container add-list-container">
                                    <div class="profile-edit-header fl-wrap">
                                        <h4>Location /  Contacts</h4>
                                    </div>
                                    <div class="custom-form">
                                        <label>Address<i class="fa fa-map-marker"></i></label>
                                        <input type="text" placeholder="Address of your business" value="" name="address"/>
                                        <div class="row">

                                          <div class="col-md-4">
                                                <label>Search:<i class="fa fa-map-marker"></i></label>
                                                <div class="main-search-input-item location" id="autocomplete-container" style="width:100%;">
                                                    <input type="text" placeholder="Location" id="autocomplete-input" value=""/>
                                                </div>
                                          </div>
                                          <div class="col-md-4">
                                                <label>Latitude:<i class="fa fa-map-marker"></i></label>
                                                <input type="text" id="lat" name="latitude" placeholder="" value="" required/>
                                          </div>
                                          <div class="col-md-4">
                                                <label>Longitude:<i class="fa fa-map-marker"></i></label>
                                                <input type="text" id="long" name="longitude" placeholder="" value="" required/>
                                            </div>
                                        </div>
                                        <div class="map-container">
                                            <div id="singleMap" data-latitude="-2.275139" data-longitude="99.4050643"></div>
                                        </div>
                                        <label>Phone<i class="fa fa-phone"></i></label>
                                        <input type="text" placeholder="Your Phone" value="" name="phone"/>
                                        <label>Email<i class="fa fa-envelope-o"></i></label>
                                        <input type="text" placeholder="Your Email" value="" name="email"/>
                                        <label>Website<i class="fa fa-globe"></i></label>
                                        <input type="text" placeholder="Your Website" value="" name="website"/>
                                    </div>
                                </div>
                                  <div class="profile-edit-container add-list-container">
                                    <div class="profile-edit-header fl-wrap" style="padding-bottom:0;">
                                        <h4>Image</h4>
                                    </div>
                                    <div class="custom-form">
                                        <div class="row">
                                            <!--col -->
                                            <div class="col-md-4">
                                                <div class="add-list-media-wrap">
                                                    <div   class="fuzone">
                                                        <div class="fu-text">
                                                            <span><i class="fa fa-picture-o"></i> Click here or drop files to upload</span>
                                                        </div>
                                                        <input type="file" id="file" class="upload" name="file" accept="image/png, image/jpeg, image/jpg">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--col end-->
                                            <!--col end-->
                                        </div>
                                    </div>
                                </div>
                                  <div class="profile-edit-container add-list-container">
                                    <div class="profile-edit-header fl-wrap">
                                        <h4>Detailed Information</h4>
                                    </div>
                                    <div class="custom-form">
                                        <label>Description</label>
                                        <textarea cols="40" rows="3" placeholder="" name="description"></textarea>
                                        <!-- Checkboxes -->
                                    </div>
                                </div>
                                  <div class="profile-edit-container">
                                    <div class="profile-edit-header fl-wrap" style="margin-top:30px">
                                        <h4>Socials</h4>
                                    </div>
                                    <div class="custom-form">
                                        <label>Facebook <i class="fa fa-facebook"></i></label>
                                        <input type="text" placeholder="https://www.facebook.com/" value="" name="facebook"/>
                                        <label>Twitter<i class="fa fa-twitter"></i>  </label>
                                        <input type="text" placeholder="https://twitter.com/" value="" name="twitter"/>
                                        <label>Video url :  <i class="fa fa-youtube"></i></label>
                                        <input type="text" placeholder="https://www.youtube.com/" value="" name="youtube"/>
                                        <label> Instagram <i class="fa fa-instagram"></i>  </label>
                                        <input type="text" placeholder="https://www.instagram.com/" value="" name="instagram"/>
                                        <label> Whatsapp <i class="fa fa-whatsapp"></i>  </label>
                                        <input type="text" placeholder="https://www.whatsapp.com" value="" name="whatsapp"/>
                                        <button class="btn  big-btn  color-bg flat-btn">Save Changes<i class="fa fa-angle-right"></i></button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--profile-edit-wrap end -->
    </div>
    <!--container end -->
</section>

<div class="limit-box fl-wrap"></div>
@endsection
