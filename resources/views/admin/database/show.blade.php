@extends('admin.layouts.app')
@push('scripts')
    @include('admin.components.flash')
    <script src="{{ asset('assets/js/examples/pages/customers.js') }}"></script>

    <script>
        let fingerprintID;
        let intervalId;

        // Function to send a GET request
        function sendPostRequest(callback) {
            const idToBeRegistered = $("#idToBeRegistered").val();
            const userID = $("#userId").val();
            const postData = {
                device_uid: $("#deviceSelect").val(),
                id_to_be_registered: idToBeRegistered,
                user_id: userID,
            };

            // Send a POST request using jQuery's $.ajax() method
            $.ajax({
                type: "POST",
                url: "{{route('fingerprint.enroll')}}", // Replace with your actual endpoint
                data: JSON.stringify(postData), // Convert data to JSON format if needed
                contentType: "application/json", // Set the content type
                success: function (data) {
                    fingerprintID = data.fingerprint_id;
                    console.log("POST request successful:", data);
                    alert(data.message);
                    // Handle the response data as needed
                    if (typeof callback === "function") {
                        callback(); // Call the callback function when the POST request is successful
                    }
                },
                error: function (error) {
                    console.error("POST request error:", error);
                    // Handle errors if any
                }
            });
        }

        function sendGetRequest() {
            // Send a GET request to check for changes
            var getUrl = "{{route('fingerprint.verify')}}" + "?fingerprint_id=" + fingerprintID;
            $.get(getUrl, function (data) {
                console.log("GET request successful:", data);
                // Check if something has changed in the response data and take appropriate action
                if (data.success == true) {
                    clearInterval(intervalId);
                    $("#displayStatus").removeClass("alert-danger").addClass("alert-success")
                    $("#displayStatus").text("Fingerprint Added Successfully")
                }
                if (data.success == false) {

                }
            }).fail(function (error) {
                console.error("GET request error:", error);
                // Handle errors if any
            });
        }

        // Add an event listener to listen for changes in the select element
        $("#deviceSelect").on("change", function () {
            console.log('changed');
            sendPostRequest(function () {
                // After the POST request is sent and the callback is called, set an interval
                // to send the GET request at a reasonable interval (e.g., every 5 seconds)
                const interval = 2000; // 5000 milliseconds = 5 seconds
                const intervalId = setInterval(sendGetRequest, interval);
            });
        });
    </script>
@endpush('scripts')
@section('styles')

@endsection
@section('content')
    <div class="page-header d-md-flex justify-content-between">
        <div class="">

            <h3>Fingerprint Enrollment for: {{ucwords($user->name)}}</h3>

        </div>

    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{$user->name}}</h6>
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="deviceSelect">User Type</label>
                                <select id="deviceSelect" name="device" class="form-control">
                                    <option selected disabled hidden>Pick a Device</option>
                                    @foreach ($devices as $device)
                                        <option value="{{ $device->uid }}">{{ ucwords($device->name) }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="idToBeRegistered" value="{{$idToBeRegistered}}">
                                <input type="hidden" id="userId" value="{{$user->id}}">
                            </div>
                        </div>
                    </form>

                    <p>Place your hand on the fingerprint device to scan your fingerprint</p>

                    <span style="width: 100%; height: 50%; font-size: 14px"
                          id="displayStatus"
                          class="alert alert-danger text-center">
                        Fingerprint is not Added
                    </span>
                </div>
            </div>

        </div>
    </div>
@endsection
