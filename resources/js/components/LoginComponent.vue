<template>
    <!-----------------the offCanvas - left side bar------------------->
    <div>
        <!-- Login sidebar -->
        <div class="mobile-offcanvas" v-if="!result && !userId" id='navbar_main'>
            <div class="mapSideMenu">
                <div class="offcanvas-header">
                    <!-------mobile view-------->
                    <li class="setAddress setAddressSmall" id ="login_soicel" data-trigger="#navbar_main">
                        <a href="#"><img alt="logo" src="images/ih-logo.png">
                            Set your IH address </a>
                        <span class="fa arrow"></span>
                    </li>
                    <!-------END mobile view-------->
                    <button class="float-right d-none d-md-block toggleSideMenu"><i class="las la-ellipsis-v"></i></button>
                </div>
                <div class="mapSideWrapper setAddressForm h-100">
                    <div class="align-items-center">
                        <div class="col-12 p-5 socialCont">
                            <div class="text-center my-5 d-none d-lg-block">
                                <img src="images/ih-logo.png" class="img-fluid"><br>
                                <p class="text-logo">international home address</p>
                            </div>
                            <div class="social-media">
                                <a v-bind:href="facebookRoute" aria-label="facebook">
                                    <i class="fab fa-facebook-f"></i>
                                    <span class="pl-2">CONTINUE WITH FACEBOOK</span>
                                </a>
                            </div>
                            <div class="social-media">
                                <a v-bind:href="googleRoute" aria-label="google">
                                    <i class="fab fa-google"></i>
                                    <span class="pl-2">CONTINUE WITH GMAIL</span>
                                </a>
                            </div>
                            <div class="social-media">
                                <a v-bind:href="twitterRoute" aria-label="twitter">
                                    <i class="fab fa-twitter"></i>
                                    <span class="pl-2">CONTINUE WITH twitter</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form sidebar -->
        <div class="mobile-offcanvas showCanvas sideFullHeight" v-if="!result && userId && setaddress" id='navbar_main'>
            <div class="mapSideMenu">
                <div class="offcanvas-header">
                    <!-------mobile view-------->
                    <li class="setAddress setAddressSmall" id="login_soicel" data-trigger="#navbar_main">
                        <a href="#"><img alt="logo" src="images/ih-logo.png">
                            Set your IH address </a>
                        <span class="fa arrow"></span>
                    </li>
                    <!-------END mobile view-------->
                    <button class="float-right d-none d-md-block toggleSideMenu"><i class="las la-ellipsis-v"></i></button>
                </div>
                <div class="mapSideWrapper setAddressForm h-100">


                    <div class='multiStepFormCont'>
                        <!-- multistep form -->
                        <form class="form" style='position: relative;' @submit.prevent="submit_form">
                            <div class="form-step step1 animated fadeIn">
                                <div class="row mx-0">
                                    <div class="col-12 py-3 px-5">
                                        <h5 class="text-uppercase pb-1">set your ih address</h5>
                                        <span class="text-uppercase">address:</span>

                                        <div class="form-group">
                                            <label for="validationCustom04">Country:</label>
                                            <select class="custom-select" id="validationCustom04" :disabled="has_address" required v-model="setaddressForm.country">
                                                <option v-for="country in countries" :value="country.id">{{ country.country_name }} </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">State/Province/Region</label>
                                            <input type="text" class="form-control" id="inputState" v-model="setaddressForm.state">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress">Street Name</label>
                                            <input type="text" class="form-control" id="inputAddress" v-model="setaddressForm.street1">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress2">Street Name 2</label>
                                            <input type="text" class="form-control" id="inputAddress2" v-model="setaddressForm.street2">
                                        </div>
                                        My Home Is :
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" :checked="setaddressForm.myhomeis == 'apartment'"  value="apartment" v-model="setaddressForm.myhomeis">
                                            <label class="custom-control-label" for="customRadioInline1">Apartment</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" :checked="setaddressForm.myhomeis == 'villa'" value="villa" v-model="setaddressForm.myhomeis">
                                            <label class="custom-control-label" for="customRadioInline2">Villa</label>
                                        </div>
                                        <div class="form-group pt-2">
                                            <label for="inputBuilding">Building Name</label>
                                            <input type="text" class="form-control" id="inputBuilding" v-model="setaddressForm.type">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputBuilding">Appartment/Villa No.</label>
                                            <input type="text" class="form-control" id="inputBuilding" v-model="setaddressForm.no">
                                        </div>
                                        <span class="text-uppercase text-dark font-weight-bold">landmark:</span>
                                        <div class="form-group pt-2">
                                            <select class="custom-select" id="validationCustom04" v-model="setaddressForm.landmark1">
                                                <option selected disabled value="">Opposite</option>
                                                <option value="behind">Behind</option>
                                                <option value="near">Near</option>
                                                <option value="some building of">Some Building Of</option>
                                            </select>
                                            <input type="text" class="form-control mt-1" placeholder="Opposite to..." v-model="setaddressForm.landmark2">
                                        </div>
                                        <span class="text-uppercase text-dark font-weight-bold">location:</span><br>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing" v-model="setaddressForm.save_location">
                                            <label class="custom-control-label" for="customControlAutosizing">Current Location</label>
                                        </div>
                                        <div class=" justify-content-center">
                                            <button type="submit" class="btn btn-color nextIH" >Create <img src="images/create-icon.png"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="form-step step2 animated fadeIn" style="display: none;">
                                <div class="mapSideWrapper buildingSlider">
                                    <div class="photoUploadingCont">
                                        <div class="UploadingWrapper">
                                            <div class="getPhotosCont hand-bg hintPhotos">
                                                <div class="howToWrapper">
                                                    <h5>
                                                        How to get photos
                                                    </h5>
                                                    <h2>of your home?</h2>
                                                    <p>You have to take good photos of your home and mark one arrow to your home</p>

                                                    <div class="fileButton">
                                                        <a class=" btn-color btn">next..</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="getPhotosCont uploadPhotos">
                                                <div class='photoSource'>
                                                    <ul>
                                                        <li> <a href="#"><i class="las la-camera"></i> Camera</a></li>
                                                        <li> <a href="#"><i class="las la-paperclip"></i> Upload</a></li>
                                                    </ul>
                                                </div>
                                                <form @submit.prevent="image_upload">
                                                    <div class="photoBoxes">

                                                        <ul>
                                                            <li>
                                                                <button class="buttonFile" type="button"><img class='displayImg' src="" alt=""></button>
                                                                <input type="file" class="hiddenFile" ref="image1" hidden v-on:change="handleFileUpload1()">
                                                                <h6 class="fileDesc"> Photo 1</h6>
                                                            </li>
                                                            <li>
                                                                <button class="buttonFile"><img class='displayImg' src="" alt=""></button>
                                                                <input type="file" class="hiddenFile" ref="image2" hidden v-on:change="handleFileUpload2()">
                                                                <h6 class="fileDesc"> Photo 1</h6>
                                                            </li>
                                                            <li>
                                                                <button class="buttonFile"><img class='displayImg' src="" alt=""></button>
                                                                <input type="file" class="hiddenFile" ref="image3" hidden v-on:change="handleFileUpload3()">
                                                                <h6 class="fileDesc"> Photo 1</h6>
                                                            </li>
                                                            <li>
                                                                <button class="buttonFile"><img class='displayImg' src="" alt=""></button>
                                                                <input type="file" class="hiddenFile" hidden ref="image4" v-on:change="handleFileUpload4()">
                                                                <h6 class="fileDesc"> Photo 1</h6>
                                                            </li>
                                                        </ul>

                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn-color btn">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mapSideWrapper buildingSocial">
                                    <div class="bg-opacity">
                                        <div class="ihNumber">
                                            <p>{{ my_address.ih }}</p>
                                            <!--<span class="text-muted ml-1"><i class="fas fa-check-circle"></i> 6557</span>
                                            <span class="text-muted ml-1"><i class="fas fa-times-circle"></i> 45</span>-->
                                        </div>
                                        <hr class="">
                                        <div class="shareOptions d-flex justify-content-center">
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
                                </div>
                                <div class="mapSideWrapper buildingAddress">
                                    <div class="address">
                                        <h5>Address</h5>
                                        <p>{{ my_address.myhomeis }}: <span v-html="my_address.full_address"></span>.</p>
                                    </div>
                                    <hr class="">
                                    <div class="landmark">
                                        <h5>landmark</h5>
                                        <p>{{ my_address.landmark }}.</p>
                                    </div>

                                    <div class="checkAddress text-center mt-4">
                                        <a class="btn  btn-outline-dark btn-outline-pink backIH">
                                            <small>
                                                <i class="fas fa-chevron-left"></i>
                                                Back
                                            </small>
                                        </a>
                                       <!-- <button type="submit" class="btn btn-color btn-pink createIH">
                                            <small> Create</small>
                                            <img src="images/create-icon.png" alt="ih-logo">
                                        </button>-->
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Own Location -->
        <div class="mobile-offcanvas sideFullHeight" v-if="!result && userId && has_address && !setaddress" id='navbar_main' v-bind:class="{ 'showCanvas': !setaddress }">
            <div class="mapSideMenu">
                <div class="offcanvas-header">
                    <!-------mobile view-------->
                    <li class="setAddress setAddressSmall"  id ="login_soicel" data-trigger="#navbar_main">
                        <a href="#"><img alt="logo" src="images/ih-logo.png">
                            Set your IH address </a>
                        <span class="fa arrow"></span>
                    </li>
                    <!-------END mobile view-------->
                    <button class="float-right d-none d-md-block toggleSideMenu"><i class="las la-ellipsis-v"></i></button>
                </div>
                <div class="mapSideWrapper buildingSlider">
                    <div id="ihAddressCarousel" class="carousel slide" data data-pause="true">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" v-if="my_address.image1" v-bind:src=" my_address.image1_path" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" v-if="my_address.image2" v-bind:src="my_address.image2_path" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" v-if="my_address.image3" v-bind:src="my_address.image3_path" alt="Third slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" v-if="my_address.image4" v-bind:src="my_address.image4_path" alt="forth slide">
                            </div>
                        </div>
                        <ol class="carousel-indicators">
                            <img data-target="#carouselExampleIndicators" data-slide-to="0" class="active"
                                 v-bind:src=" my_address.image1_path" v-if="my_address.image1" alt="first slide">
                            <img data-target="#carouselExampleIndicators" data-slide-to="1" v-if="my_address.image2" width="30" v-bind:src=" my_address.image2_path"
                                 alt="second slide">
                            <img data-target="#carouselExampleIndicators" data-slide-to="2" v-if="my_address.image3" width="30" v-bind:src=" my_address.image3_path"
                                 alt="Third slide">
                            <img data-target="#carouselExampleIndicators" data-slide-to="3" v-if="my_address.image4" width="30" v-bind:src=" my_address.image4_path"
                                 alt="forth slide">
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="mapSideWrapper buildingSocial">
                    <div class="ihNumber">
                        <p>{{ my_address.ih }} <span class=" ml-1"><img src="images/ih-check.png" alt='Accurate address'> (95%)</span>
                        </p>
                    </div>
                    <hr>
                    <div class="shareOptions d-flex justify-content-center">
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
                            <a href="#"  id="IHShare">
                                <li class="collapsed" data-toggle="collapse" data-target="#collapseIHShare" aria-expanded="false" aria-controls="collapseIHShare">
                                    <i class="fas fa-share-alt"></i><small>share</small></li>
                            </a>
                            <a href="#">
                                <li><i class="fas fa-directions"></i><small>direction</small></li>
                            </a>
                        </ul>
                    </div>

                    <div class="IHShareGroup">
                        <div id="collapseIHShare" class="collapse" aria-labelledby="IHShare">
                            <div class="card-body bg-light">
                                <p>This is an example of what you'll share</p>
                                <div class="bg-white IHShareView">971.34.344.7777 <a href="#"><i class="far fa-copy"></i></a></div>
                                <ul class="socialIcons">
                                    <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href=""><i class="fab fa-google"></i></a></li>
                                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="mapSideWrapper buildingAddress">
                    <div class="address">
                        <h5>Address</h5>
                        <p>{{ my_address.myhomeis }}: <span v-html="my_address.full_address"></span>.</p>
                    </div>

                    <hr class="">
                    <div class="landmark">
                        <h5>landmark</h5>
                        <p>{{ my_address.landmark }}.</p>
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

    </div>
    <!-- Own Location -->
    <div class="mobile-offcanvas sideFullHeight" v-if="!result && userId && has_address && !setaddress" id='navbar_main' v-bind:class="{ 'showCanvas': !setaddress }">
        <div class="mapSideMenu">
            <div class="offcanvas-header">
                <!-------mobile view-------->
                <li class="setAddress setAddressSmall"  id ="login_soicel" data-trigger="#navbar_main">
                    <a href="#"><img alt="logo" src="images/ih-logo.png">
                        Set your IH address </a>
                    <span class="fa arrow"></span>
                </li>
                <!-------END mobile view-------->
                <button class="float-right d-none d-md-block toggleSideMenu"><i class="las la-ellipsis-v"></i></button>
            </div>
            <div class="mapSideWrapper buildingSlider">
                <div id="ihAddressCarousel" class="carousel slide" data data-pause="true">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" v-if="my_address.image1" v-bind:src=" my_address.image1_path" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" v-if="my_address.image2" v-bind:src="my_address.image2_path" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" v-if="my_address.image3" v-bind:src="my_address.image3_path" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" v-if="my_address.image4" v-bind:src="my_address.image4_path" alt="forth slide">
                        </div>
                    </div>
                    <ol class="carousel-indicators">
                        <img data-target="#carouselExampleIndicators" data-slide-to="0" class="active"
                             v-bind:src=" my_address.image1_path" v-if="my_address.image1" alt="first slide">
                        <img data-target="#carouselExampleIndicators" data-slide-to="1" v-if="my_address.image2" width="30" v-bind:src=" my_address.image2_path"
                             alt="second slide">
                        <img data-target="#carouselExampleIndicators" data-slide-to="2" v-if="my_address.image3" width="30" v-bind:src=" my_address.image3_path"
                             alt="Third slide">
                        <img data-target="#carouselExampleIndicators" data-slide-to="3" v-if="my_address.image4" width="30" v-bind:src=" my_address.image4_path"
                             alt="forth slide">
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="mapSideWrapper buildingSocial">
                <div class="ihNumber">
                    <p>{{ my_address.ih }} <span class=" ml-1"><img src="images/ih-check.png" alt='Accurate address'> (95%)</span>
                    </p>
                </div>
                <div>
                    <form class="saveAddress px-3" @submit.prevent="submit_form2">
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Address name:"  v-model=" saveaddressForm.name"></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Note:" v-model=" saveaddressForm.note" ></textarea>
                        </div>
                        <div class="saveButtons text-center mt-4">
                            <div class="btn btn-outline-pink back">
                                <small><i class="fas fa-chevron-left"></i> Back</small>
                            </div>
                            <div class="btn  btn-color btn-pink save">
                                <small>
                                    <i class="fas fa-bookmark"></i> Save
                                </small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-offcanvas sideFullHeight" v-if="!result && userId && has_address && !setaddress" id='navbar_main' v-bind:class="{ 'showCanvas': !setaddress }">
        <div class="mapSideMenu">
            <div class="offcanvas-header">
                <!-------mobile view-------->
                <li class="setAddress setAddressSmall"  id ="login_soicel" data-trigger="#navbar_main">
                    <a href="#"><img alt="logo" src="images/ih-logo.png">
                        Set your IH address </a>
                    <span class="fa arrow"></span>
                </li>
    <div id="myModal" class="modal fade pt-5 mt-5" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body text-center pt-5">
                    <p>Are you shre you wnat remove this IH address</p>
                </div>
                <div class="modal-footer text-center justify-content-center">
                    <button class="btn  btn-outline-dark btn-outline-pink">Cancel</small></button>
                    <button class="btn btn-dark btn-pink"> <i class="fas fa-times pr-1"></i>Remove</button>
                </div>
            </div>

        </div>
    </div>
    <!-----------------the offCanvas - left side bar------------------->
    <div class="mobile-offcanvas" id='navbar_main'>
        <div class="offcanvas-header">
            <button class="float-right"><i class="las la-ellipsis-v"></i></button>
        </div>
        <div class="mapSideMenu">
            <div class="mapSideWrapper buildingAddress">
                <h4 class="text-uppercase pt-3">Saved Address</h4>

                <hr class="row">
                <div class="ihNumber">
                    <div class="btn-group dropleft float-right">
                        <button type="button" class="btn dropdown-toggle saved-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="las la-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"><i class="fas fa-share-alt pr-3"></i>share</a>
                            <hr class="my-0">
                            <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt pr-3"></i>edit</a>
                            <hr class="my-0">
                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#myModal"><i class="fas fa-times pr-3"></i>remove</a>
                        </div>
                    </div>
                    <p>{{ my_address.ih }} <span class=" ml-1"><img src="images/ih-check.png" alt='Accurate address'> (95%)</span>
                    </p>
                    <h5 class="text-uppercase mt-n3">{{my_address.name}}</h5>
                    <p class="saved-address"><span v-html="my_address.full_address"></span>.</p>
                </div>
                <hr class="row">
                <div class="ihNumber">
                    <div class="btn-group dropleft float-right">
                        <button type="button" class="btn dropdown-toggle saved-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="las la-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"><i class="fas fa-share-alt pr-3"></i>share</a>
                            <hr class="my-0">
                            <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt pr-3"></i>edit</a>
                            <hr class="my-0">
                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#myModal"><i class="fas fa-times pr-3"></i>remove</a>
                        </div>
                    </div>
                    <p><img src="images/ih-logo-saved.png" alt='Accurate address'><span class="saved-num">971.34.344.7777 </span><span class=" ml-1 saved-per"><img src="images/ih-check-saved.png" alt='Accurate address'> (95%)</span>
                    </p>

    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</template>

<script>
import { bus } from "../app";

export default {
    name: "LoginComponent",
    props:{
        userId: Number ,
        facebookRoute: String ,
        googleRoute: String ,
        twitterRoute: String ,
    },
    data(){
        return {
            setaddressForm: {
                country: '',
                state: '',
                street1: '',
                street2: '',
                myhomeis: '',
                no: '',
                landmark1: '',
                landmark2: '',
                save_location: '',
                type: '',
                current_lat: Number,
                current_lan: Number,
                name:'',
                note:' ',
            },
            imageUploadFrom : {
                image1: '',
                image2: '',
                image3: '',
                image4: '',
            },
            result: false,
            countries : [],
            my_address : [],
            has_address : false,
            setaddress : true,
            save_address: true,
        }
    },
    methods: {
        get_country() {
            let vm = this;
            axios.get('/get-country', {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (response) {
                vm.countries = response.data.data
            })
        },

        submit_form() {
            let vm = this;
            const setaddressFormData = new FormData();
            setaddressFormData.append("country_id", this.setaddressForm.country);
            setaddressFormData.append("state", this.setaddressForm.state);
            setaddressFormData.append("streetname1", this.setaddressForm.street1);
            setaddressFormData.append("streetname2", this.setaddressForm.street2);
            setaddressFormData.append("streetname1", this.setaddressForm.street1);
            setaddressFormData.append("streetname2", this.setaddressForm.street2);
            setaddressFormData.append("myhomeis", this.setaddressForm.myhomeis);
            setaddressFormData.append("number", this.setaddressForm.no);
            setaddressFormData.append("landmark1", this.setaddressForm.landmark1);
            setaddressFormData.append("landmark2", this.setaddressForm.landmark2);
            setaddressFormData.append("type", this.setaddressForm.type);
            setaddressFormData.append("save_location", this.setaddressForm.save_location);
            setaddressFormData.append("current_lat", this.setaddressForm.current_lat);
            setaddressFormData.append("current_lan", this.setaddressForm.current_lan);


            axios.post('/set_address', setaddressFormData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (response) {
                if (response.data.message == "success" && response.data.percentage == 100) {
                    /**** if store success move to next form ****/
                    next_form();

                }
            })
        },
        handleFileUpload1() {
            this.imageUploadFrom['image1'] = this.$refs.image1.files[0];
        },
        handleFileUpload2() {
            this.imageUploadFrom['image2'] = this.$refs.image2.files[0];
        },
        handleFileUpload3() {
            this.imageUploadFrom['image3'] = this.$refs.image3.files[0];
        },
        handleFileUpload4() {
            this.imageUploadFrom['image4'] = this.$refs.image4.files[0];
        },
        image_upload() {
            let vm = this;
            const imageUploadFromData = new FormData();
            imageUploadFromData.append("image1", this.imageUploadFrom.image1);
            imageUploadFromData.append("image2", this.imageUploadFrom.image2);
            imageUploadFromData.append("image3", this.imageUploadFrom.image3);
            imageUploadFromData.append("image4", this.imageUploadFrom.image4);

            axios.post('/upload_image', imageUploadFromData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (response) {
                if (response.data.message == "success") {
                    /**** if store success move to next form ****/
                    // next_form();
                    vm.setaddress = false;
                }
            })

        },
        get_address() {
            let vm = this;
            axios.get('/get-address', {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (response) {
                vm.my_address = response.data.data

                if (response.data.message == "ok") {
                    vm.has_address = true;
                    var landmark = vm.my_address.landmark.split(',');
                    var landmark1 = landmark[0];
                    var landmark2 = landmark[1];

                    vm.setaddressForm['country'] = vm.my_address.country_id;
                    vm.setaddressForm['state'] = vm.my_address.state;
                    vm.setaddressForm['street1'] = vm.my_address.streetname1;
                    vm.setaddressForm['street2'] = vm.my_address.streetname2;
                    vm.setaddressForm['myhomeis'] = vm.my_address.myhomeis;
                    vm.setaddressForm['no'] = vm.my_address.number;
                    vm.setaddressForm['landmark1'] = landmark1;
                    vm.setaddressForm['landmark2'] = landmark2;
                    vm.setaddressForm['type'] = vm.my_address.type;
                }

                if (response.data.percentage == 100) {
                    vm.setaddress = false;
                }
            })
        }
//this form for save adress where he enter Adressb and note
        submit_form2(){
            let vm = this;
            const saveaddressFormData = new FormData();


            saveaddressFormData.append("name", this. saveaddressForm.name);
            saveaddressFormData.append("note", this.saveaddressForm.note);


            axios.post('/save_address', saveaddressFormData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (response) {
                if (response.data.message == "success") {
                    /**** if store success move to next page show all save address ****/

                    vm.save_address= false;
                }
            })

        },

    created() {
        bus.$on('result', obj => {
            this.result = obj
        });

        bus.$on('current_lat', obj => {
            this.setaddressForm.current_lat = obj;
        });
        bus.$on('current_lan', obj => {
            this.setaddressForm.current_lan = obj;
        });

        this.get_country()
        this.get_address()

    }
}}
</script>

<style scoped>

</style>
