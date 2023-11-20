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
            <form action="">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Location</label>
                            <input type="text" class="form-control" name="location" id="location" required>
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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_jDlfRb0lO5o1NZh2PxwwB1OtHUnrTVw&libraries=places"></script>
<script>
    $(document).ready(function(){
        var autocomplete;
        var to = 'location';
        // autocomplete = new google.maps.places.Autocomplete((document.getElementById(to)),{
        //     types:['geocode']
        // });

    });
</script>

@endsection
