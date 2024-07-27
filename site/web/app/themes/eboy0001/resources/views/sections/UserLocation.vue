<template>
    <section class="searchbar">
   
        <form class="location"> 
            <div class="form_wrapper">         
                <div class="input-group">
                    <input type="text" class="form-control" aria-label="Get Address">
                    <button type="button" class="btn btn-primary input-group-text" @click="locatorButtonPressed">Get Address</button>
                </div>
            </div>
        </form>
     
    </section>

</template>

<script>

import axios from 'axios'
    export default {
        methods: {
            locatorButtonPressed() {

                if(navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        position => {
                            this.getAddressFrom(position.coords.latitude, position.coords.longitude);
 
                        },
                        error => {
                            console.log(error.message);
                        }
                    );
                } else {
                    console.log("Your browser does not suppot Geolocation!");
                }
            },
            getAddressFrom(lat, long) {
                axios.get("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + long + "&key=AIzaSyD6fHg6w3sq7t_y5RfpsRJJT2m6OWsrOdw")
                .then(Response => {
                    if(Response.data.error_message) {
                        console.log(Response.data.error_message);
                    } else {
                        console.log(Response.data.results[0].formatted_address);
                    }
                })
                .catch(error => {
                    console.log(error.message);
                })
            }
        }
    }
</script>