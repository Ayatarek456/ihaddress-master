<template>
    <div>
        <!---------------------map options ----------------------->
        <nav class="mapOptions">
            <div class="mapMenu">
                <ul class='menuNav'>
                    <li class="satelliteView"><a href="" class="iconItem"><img src="images/ih-satellite.png" alt="satellite view"></a></li>
                    <li class="locationView"><a href="#" v-on:click="emitGlobalClickEvent" class="iconItem" ><img src="images/ih-crosshairs.png" alt="track ur location"></a></li>
                    <li class="searchMap">
                        <form class="formSearch" @submit.prevent="search">
                            <div class='form-group'>
                                <input type="text" id="searchInput" class="form-control searchInput" v-model="searchForm.ih">
                                <a href="#" class="iconItem search"><img src="images/ih-search.png" alt="search"></a>
                                <a href="#" class="iconItem cancel" style="display: none;"><img src="images/ih-cancel.png"
                                                                                                alt="search"></a>
                            </div>
                        </form>
                    </li>
                    <li class="setAddress setAddressLarge test" v-on:click="change_result" id ="login_soicel" data-trigger="#navbar_main">
                        <a href="#"><img alt="logo" src="images/ih-logo.png">
                            Set your IH address </a>
                    </li>
                    <li class="menuGroupCont">
                        <div class="btn-group">
                            <button type="button" class="btn navbar-toggler dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                            </button>
                            <div class="dropdown-menu">
                                <ul class="list-unstyled">
                                    <li class="nav-item">
                                        <a class="nav-link"  data-toggle="modal" data-target="#aboutIH">About IH</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" nav-link" href="#">Developers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" nav-link" data-toggle="modal" data-target="#contact">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </li>
                </ul>
            </div>
            <!-----------------the offCanvas - left side bar------------------->
        </nav>

        <!-----------------the offCanvas - left side bar------------------->
        <div class="mobile-offcanvas sideFullHeight" v-if="result" id='navbar_main' v-bind:class="{ 'showCanvas': flip }">
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
                                <img class="d-block w-100" v-if="imag1" v-bind:src=" imag1_path" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" v-if="imag2" v-bind:src="imag2_path" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" v-if="imag3" v-bind:src="imag3_path" alt="Third slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" v-if="imag4" v-bind:src="imag4_path" alt="forth slide">
                            </div>
                        </div>
                        <ol class="carousel-indicators">
                            <img data-target="#carouselExampleIndicators" data-slide-to="0" class="active"
                                 v-bind:src=" imag1_path" v-if="imag1" alt="first slide">
                            <img data-target="#carouselExampleIndicators" data-slide-to="1" v-if="imag2" width="30" v-bind:src=" imag2_path"
                                 alt="second slide">
                            <img data-target="#carouselExampleIndicators" data-slide-to="2" v-if="imag3" width="30" v-bind:src=" imag3_path"
                                 alt="Third slide">
                            <img data-target="#carouselExampleIndicators" data-slide-to="3" v-if="imag4" width="30" v-bind:src=" imag4_path"
                                 alt="forth slide">
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="mapSideWrapper buildingSocial">
                    <div class="ihNumber">
                        <p>{{ ih }} <span class=" ml-1"><img src="images/ih-check.png" alt='Accurate address'> (95%)</span>
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
                        <p>Apartment: <span v-html="address"></span>.</p>
                    </div>
                    <hr>
                    <div class="landmark">
                        <h5>landmark</h5>
                        <p>Opposite: {{ landmark }}.</p>
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
</template>

<script>
import { bus } from "../app";
import { EventBus } from '../app';

export default {
    name: "SearchComponent",
    props:{

    },
    data(){
        return{
            searchForm: {
                ih: '',
            },
            flip: false,
            result: false,
            ih: '',
            address: '',
            landmark: '',
            imag1: '',
            imag2: '',
            imag3: '',
            imag4: '',
            imag1_path: '',
            imag2_path: '',
            imag3_path: '',
            imag4_path: '',
        }
    },
    methods:{
        search() {
            let vm = this;
            const searchFormData = new FormData();
            searchFormData.append("ih", this.searchForm.ih);

            axios.post('/search', searchFormData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (response) {
                vm.flip = true;
                vm.result = true;

                vm.ih = response.data.data.ih
                vm.address = response.data.data.full_address
                vm.landmark = response.data.data.landmark
                vm.imag1_path = response.data.data.image1_path
                vm.imag2_path = response.data.data.image2_path
                vm.imag3_path = response.data.data.image3_path
                vm.imag4_path = response.data.data.image4_path

                vm.imag1 = response.data.data.image1
                vm.imag2 = response.data.data.image2
                vm.imag3 = response.data.data.image3
                vm.imag4 = response.data.data.image4

                bus.$emit('lat',response.data.data.latitude)
                bus.$emit('lan',response.data.data.longitude)
                bus.$emit('result',true)
            })},
        change_result()
        {
            this.result =  false;
            bus.$emit('result',false)
        },
        emitGlobalClickEvent() {
            EventBus.$emit('i-got-clicked', 'extra data');
        }
    },
    created() {

    }
}
</script>

<style scoped>

</style>
