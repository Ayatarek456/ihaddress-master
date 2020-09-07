@extends('website.layouts.layout')



@section('content')
    <!------------------the map element--------------------->
    <div class="map">
        <!-- <iframe
          src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d55306.73397503105!2d30.938824844379333!3d29.960144228369224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2seg!4v1593018615850!5m2!1sen!2seg"
          width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
          tabindex="0"></iframe> -->
    </div>
    <!------------------end the map element------------------->
    <!---------------------map options ----------------------->
    <nav class="mapOptions">
        <div class="mapMenu">
            <form class="formSearch">
                <ul class='menuNav'>
                    <li><a href="#" class="iconItem"><img src="images/ih-satellite.png" alt="satellite view"></a></li>
                    <li><a href="#" class="iconItem"><img src="images/ih-crosshairs.png" alt="track ur location"></a></li>
                    <li class="searchMap">
                        <div class='form-group'>
                            <input type="text" id="searchInput" name="searchInput" class="form-control">
                            <a href="#" class="iconItem search">
                                <img src="images/ih-search.png" alt="search">
                            </a>
                            <a href="#" class="iconItem cancel" style="display: none;">
                                <img src="images/ih-cancel.png" alt="search">
                            </a>
                        </div>
                    </li>
                    <li class="setAddress" data-trigger="#navbar_main">
                        <a href="#"><img alt="logo" src="images/ih-logo.png">
                            Set your IH address </a>
                    </li>
                    <li>
                        <button class="navbar-toggler navbar-toggler-right bg-color" type="button" data-toggle="collapse"
                                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                        </button>
                        <div class="collapse navbar-collapse text-left bg-light" id="navbarResponsive">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">About IH</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#">Developers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
        <!-----------------the offCanvas - left side bar------------------->
        <div class="mobile-offcanvas" id='navbar_main'>
            <div class="offcanvas-header">
                <button class="float-right"><i class="las la-ellipsis-v"></i></button>
            </div>
            <div class="mapSideMenu">
                <div class="mapSideWrapper buildingSlider">
                    <div id="carouselExampleIndicators" class="carousel slide" data data-pause="true">
                        <div class="carousel-inner" id="slider">

                        </div>
                        <ol class="carousel-indicators" id="slider-carousel">

                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="mapSideWrapper buildingSocial">
                    <div class="ihNumber">
                        <p>971.34.344.7777 <span class=" ml-1"><img src="images/ih-check.png" alt='Accurate address'> (95%)</span>
                        </p>
                    </div>
                    <hr class="row">
                    <div class="shareOptions row d-flex justify-content-center">
                        <ul>
                            <a href="#">
                                <li><i class="fas fa-clone"></i><small>copy link</small></li>
                            </a>
                            <a href="#">
                                <li><img src='images/ih-logo.png' alt="ih" width="45"><small>copy no.</small></li>
                            </a>
                            <a href="#">
                                <li><i class="fas fa-bookmark"></i><small>save</small></li>
                            </a>
                            <a href="#">
                                <li><i class="fas fa-share-alt"></i><small>share</small></li>
                            </a>
                            <a href="#">
                                <li><i class="fas fa-directions"></i><small>direction</small></li>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="mapSideWrapper buildingAddress">
                    <div class="address">
                        <h5>Address</h5>
                        <p id="get-address">Apartment: 210, El-Ewis bldg, Ammar Bin Yasser road, Elmowahiat 3 ,Ajman.</p>
                    </div>
                    <hr class="row">
                    <div class="landmark">
                        <h5>landmark</h5>
                        <p id="landmark">Opposite: Ajman Academy. Opposite: Ajman Academy.Opposite: Ajman Academy.</p>
                    </div>

                    <div class="checkAddress text-center mt-4">
              <span class="btn"> Is it correct address?
                <a class="checkedYes" href=""><i class="las la-check"></i>YES</a>
                <a class="checkedNo" href=""><i class="las la-times"></i>NO</a>
              </span>

                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection

