<template>
    <section class="userlocation">
        <div class="col-4 test">
            <form>
                <div class="alert alert-primary" role="alert"></div>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    <span class="input-group-text" id="basic-addon1" @click="locatorButtonPressed">@</span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
</template> 

<script>

import axios from 'axios';

export default {
    methods: {
        locatorButtonPressed() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    position => {
                        this.getAddressFrom(position.coords.latitude, position.coords.longitude)
                },
                error => {
                    console.log(error.message);
                }
            );
            } else {
                console.log("Not supported by the browser")
            }
        }, 
        getAddressFrom(lat, long) {
            axios.get("https://maps.googleapis.com/maps/api/geocode/json?latlng=" 
            + lat + 
            "," 
            + long 
            + "&key=AIzaSyDzxpTa8OlMCdMgfVqIUsP252tIxjlfxgg")
            .then(response => {
                if(response.data.error_message) {
                    console.log(response.data.error_message);
                } else {
                    console.log(response.data.results[0].formatted_address);
                }
            })
            .catch(error => {
                console.log(error.message);
            })
        }
     }
};
</script>