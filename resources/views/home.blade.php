@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <a href="{{route('logout')}}" class="ml-auto">Logout</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <h1 class="text-center">Welcome to Homepage</h1>
        </div>
    </div>
    <div class="row py-4">
        <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
            <form action="" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Location</label>
                            <input type="text" class="form-control" name="location" id="location" required>
                            <input type="hidden" class="form-control" name="latitude" id="latitude">
                            <input type="hidden" class="form-control" name="longitude" id="longitude">
                            <input type="hidden" class="form-control" name="ip" id="ip">
                            <input type="text" class="form-control" name="city" id="city">
                            <input type="text" class="form-control" name="d_time" id="d_time">
                            <input type="text" class="form-control" name="d_km" id="d_km">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Client Name</label>
                            <input type="text" class="form-control" name="client_name" id="client_name" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Meeting Time/Duration</label>
                            <input type="number" class="form-control" name="meeting_duration" id="meeting_duration" placeholder="In Minutes">
                            <span>Available (09:00 AM - 06:00 PM)</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Date (Add/View)</label>
                            <input type="date" class="form-control" name="date" id="date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="btn form-control" style="display: flex; flex-direction:row; justify-content:center;">
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&libraries=places"></script>
<script>
    $(document).ready(function(){
        var autocomplete;
        autocomplete = new google.maps.places.Autocomplete((document.getElementById('location')),{
            types:['geocode']
        });

        google.maps.event.addListener(autocomplete,'place_changed',function(){
            var currentPlace = autocomplete.getPlace();
            $('#latitude').val(currentPlace.geometry.location.lat());
            $('#longitude').val(currentPlace.geometry.location.lng());
            $.getJSON("https://api.ipify.org/?format=json",function(data){
                var ip = data.ip;
                $('#ip').val(ip);
                getCity(ip);
            });
        });

    });

    function getCity(ip){
        var req = new XMLHttpRequest();
        req.open("GET","http://ip-api.com/json/"+ip, true);
        req.send();

        req.onreadystatechange = function() {
            if (req.readyState == 4 && req.status == 200) {
                var ipData = JSON.parse(req.responseText);
                var city = ipData.city;
                $('#city').val(city);
                calculateDistance(city);
            }
        };


    }

    //To run the below code google map distance matrix API should be enabled
    function calculateDistance(city){
        var from = $('#location').val();

        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix({
            origin:city,
            destination:from,
            travelMode:google.maps.TravelMode.DRIVING,
            unitSystem:google.maps.UnitSystem.metric,
            avoidHighways:false,
            avoidTolls:true,
        },callback);
    }

    function callback(resp, status){
        if(status != google.maps.DistanceMatrixStatus.OK){
            console.log('Something went wrong!');
        }else{
            if(resp.rows[0].elements[0].status == "ZERO_RESULTS")
            {
                alert('No Path found');
            }else{
                var distance = resp.rows[0].elements[0].distance;
                var duration = resp.rows[0].elements[0].duration;
                console.log(distance, duration);
                var distance_km = distance.value/1000; //in KM
                var duration_min = duration.value/60; // in minutes
                $('#d_km').val(distance_km);
                $('#d_time').val(duration_min);
            }
        }
    }
</script>


@endsection
