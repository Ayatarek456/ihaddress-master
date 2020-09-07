<template>
    <div class="map">
        <gmap-map
            :center="center"
            :zoom="12"
            map-type-id="terrain"
            style="width:100%;  height: 100%;"
            :options="{
               zoomControl: true,
               mapTypeControl: false,
               scaleControl: false,
               streetViewControl: false,
               rotateControl: false,
               fullscreenControl: true,
               disableDefaultUi: false
             }"
        >
            <gmap-marker
                :key="index"
                v-for="(m, index) in markers"
                :position="m.position"
                @click="center=m.position"
            ></gmap-marker>
            <GmapMarker ref="myMarker"
                        :position="google && new google.maps.LatLng(this.lat, this.lang)" />
        </gmap-map>
    </div>
</template>

<script>
import {bus} from "../app";
import { EventBus } from '../app';
import {gmapApi} from 'vue2-google-maps'

export default {
    name: "GoogleMap",
    data() {
        return {
            // default to Montreal to keep it simple
            // change this to whatever makes sense
            center: { lat: this.lat, lng: this.lang },
            markers: [
                {position: {lat: this.lat, lng: this.lang}}
            ],
            places: [],
            default_lat: this.current_lat,
            default_lang: this.current_lang,
            currentPlace: null,
            lat : this.default_lat,
            lang : this.default_lang,
            current_lat: Number,
            current_lang: Number,
        };
    },
    computed: {
        google: gmapApi
    },
    mounted() {
        this.geolocate();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                let pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                this.center.lat = pos.lat;
                this.center.lng = pos.lng;
                this.markers[0].position.lat = pos.lat;
                this.markers[0].position.lng = pos.lng;


            }.bind(this));
        }

    },

    created() {
        bus.$on('lat', obj => {
            this.lat = obj
        });
        bus.$on('lan', obj => {
            this.lang = obj
        });
        EventBus.$on('i-got-clicked', data => {
            console.log(data)
            // You can then call your method attached to this component here
            this.geolocate2();
        });

    },
    methods: {
        // receives a place object via the autocomplete component
        setPlace(place) {
            this.currentPlace = place;
        },
        addMarker() {
            if (this.currentPlace) {
                const marker = {
                    lat: this.currentPlace.geometry.location.lat(),
                    lng: this.currentPlace.geometry.location.lng()
                };
                this.markers.push({ position: marker });
                this.places.push(this.currentPlace);
                this.center = marker;
                this.currentPlace = null;
            }
        },
        geolocate: function() {
            navigator.geolocation.getCurrentPosition(position => {
                this.center = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                this.current_lat = position.coords.latitude;
                this.current_lang = position.coords.longitude;

                bus.$emit('current_lat',this.current_lat)
                bus.$emit('current_lan',this.current_lang)
            });
        },
        geolocate2: function() {
            navigator.geolocation.getCurrentPosition(position => {
                this.center = {
                    lat: this.current_lat,
                    lng: this.current_lang
                };
            });
        },
    }
};
</script>
