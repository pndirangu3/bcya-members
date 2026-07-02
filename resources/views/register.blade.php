@extends('layouts.admin')

@section('title', 'Register Member')

@section('content')

    <div class="register-page">

        <div class="form-container">
            <h1>BCYA Member Registration</h1>

            @if ($errors->any())
                <div class="error-banner">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="memberForm" method="POST" action="/register" enctype="multipart/form-data" class="form-grid">
                @csrf


                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}">
                </div>

                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="">-- Select Gender --</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group full-width">
                    <label for="national_id">National ID(Personal Number)</label>
                    <input type="text" id="national_id" name="national_id" value="{{ old('national_id') }}">
                </div>

                <div class="form-group">
                    <label for="payam">Payam</label>
                    <select id="payam" name="payam">
                        <option value="">-- Select Payam --</option>

                        @foreach ($payams as $payam)
                            <option value="{{ $payam->name }}">
                                {{ $payam->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="boma">Boma</label>
                    <select id="boma" name="boma">
                        <option value="">-- Select Boma --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="clan">Clan</label>
                    <input type="text" id="clan" name="clan" value="{{ old('clan') }}">
                </div>

                <div class="form-group">
                    <label for="section">Section</label>
                    <input type="text" id="section" name="section" value="{{ old('section') }}">
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" name="photo">
                </div>

                <input type="hidden" name="fingerprint_template" id="fingerprint_template">



                <div id="fingerprintStatus" style="margin-top:10px;font-weight:bold;color:#833556;">
                    <button type="button" id="captureBtn">
                        Capture Fingerprint
                    </button> </br>
                    Fingerprint Not Captured
                </div>

                <button type="submit" class="btn-submit">Register Member</button>
            </form>
        </div>

    </div>
    <script>
        document.getElementById('payam').addEventListener('change', function() {

            let payam = this.value;

            let bomaSelect = document.getElementById('boma');

            bomaSelect.innerHTML =
                '<option value="">Loading...</option>';

            fetch('/get-bomas/' + encodeURIComponent(payam))
                .then(response => response.json())
                .then(data => {

                    bomaSelect.innerHTML =
                        '<option value="">-- Select Boma --</option>';

                    data.forEach(function(boma) {

                        let option = document.createElement('option');

                        option.value = boma.name;

                        option.textContent = boma.name;

                        bomaSelect.appendChild(option);
                    });
                });
        });
    </script>

    <script>
        document.getElementById('captureBtn').addEventListener('click', function() {

            document.getElementById('fingerprintStatus').innerHTML =
                'Place finger on scanner...';

            CallSGIFPGetData(
                function(result) {

                    if (result.ErrorCode == 0) {

                        document.getElementById('fingerprint_template').value =
                            result.TemplateBase64;

                        document.getElementById('fingerprintStatus').innerHTML =
                            '✓ Fingerprint Captured';
                        document.getElementById('fingerprintStatus').style.color =
                            'green';
                        document.getElementById('captureBtn').innerHTML =
                            '✓ Fingerprint Captured';

                    } else {

                        alert(
                            'Fingerprint Error: ' +
                            result.ErrorCode
                        );

                        document.getElementById('fingerprintStatus').innerHTML =
                            'Fingerprint Capture Failed';
                    }
                },

                function(status) {

                    alert('SecuGen WebAPI not running');

                    document.getElementById('fingerprintStatus').innerHTML =
                        'Scanner Not Available';
                }
            );
        });


        function CallSGIFPGetData(successCall, failCall) {
            var uri = "https://localhost:8443/SGIFPCapture";

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var fpobject = JSON.parse(xmlhttp.responseText);

                    successCall(fpobject);
                } else if (xmlhttp.status == 404) {
                    failCall(xmlhttp.status);
                }
            }

            var params = "Timeout=10000";
            params += "&Quality=50";
            params += "&templateFormat=ISO";
            params += "&imageWSQRate=0.75";

            xmlhttp.open("POST", uri, true);
            xmlhttp.send(params);

            xmlhttp.onerror = function() {
                failCall(xmlhttp.statusText);
            }
        }

        document.getElementById('memberForm').addEventListener('submit', function(e) {
            const fingerprint =
                document.getElementById('fingerprint_template').value;

            if (fingerprint === '') {
                e.preventDefault();

                alert(
                    'Please capture fingerprint before registering member.'
                );

                document.getElementById('fingerprintStatus').innerHTML =
                    'Fingerprint Required';

                return false;
            }
        });
    </script>

@endsection
