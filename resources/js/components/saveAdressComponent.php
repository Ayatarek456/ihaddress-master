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
                                    <form class="saveAddress px-3" @submit.prevent="submit_form">
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Address name:"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Note:"></textarea>
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
                },
                imageUploadFrom : {
                    image1: '',
                    image2: '',
                    image3: '',
                    image4: '',
                },
                result: true,
                countries : [],
                my_address : [],
                has_address : true,
                setaddress : true,
            }
        },
        methods:{

            submit_form()
            {
                let vm = this;
                const setaddressFormData = new FormData();

                setaddressFormData.append("streetname1", this.setaddressForm.street1);
                setaddressFormData.append("streetname2", this.setaddressForm.street2);

                setaddressFormData.append("save_location", this.setaddressForm.save_location);

                axios.post('/set_address', setaddressFormData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function (response)
                {
                    if (response.data.message == "success" && response.data.percentage == 100)
                    {
                        /**** if store success move to next form ****/
                        next_form();
                    }
                })
            },

            save_address()
            {
                let vm = this;
                axios.get('/save-address',{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function (response) {
                    vm.my_address = response.data.data

                    if (response.data.message == "ok")
                    {
                        vm.has_address = true;
                        vm.setaddressForm['street1'] = vm.my_address.streetname1;
                        vm.setaddressForm['street2'] = vm.my_address.streetname2;

                    }

                    if (response.data.percentage == 100)
                    {
                        vm.setaddress = false;
                    }
                })
            }
        },
        created() {
            bus.$on('result', obj => {
                this.result = obj
            });



            this.get_country()
            this.get_address()

        }
    }
</script>

<style scoped>

</style>
