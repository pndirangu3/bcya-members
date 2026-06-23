<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCYA Member Registration</title>
    <style>
        /* Global Reset & Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.5;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container Card */
        .form-container {
            background-color: #ffffff;
            width: 100%;
            max-width: 650px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-top: 6px solid #833556;
        }

        h1 {
            color: #1e293b;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            text-align: center;
        }

        /* Error Banner */
        .error-banner {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 16px;
            border-radius: 6px;
            margin-bottom: 24px;
        }

        .error-banner ul {
            list-style-type: none;
            color: #b91c1c;
            font-size: 14px;
        }

        /* Layout Grid */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .full-width {
            grid-column: span 2;
        }

        /* Form Controls */
        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px 14px;
            font-size: 15px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background-color: #fff;
            color: #334155;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus,
        select:focus {
            border-color: #833556;
            box-shadow: 0 0 0 3px rgba(131, 53, 86, 0.15);
        }

        /* File Input Styling */
        input[type="file"] {
            font-size: 14px;
            color: #64748b;
        }

        input[type="file"]::file-selector-button {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            margin-right: 10px;
            transition: background-color 0.2s;
        }

        input[type="file"]::file-selector-button:hover {
            background-color: #e2e8f0;
        }

        /* Submit Button */
        .btn-submit {
            grid-column: span 2;
            background-color: #833556;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            margin-top: 10px;
            text-align: center;
        }

        .btn-submit:hover {
            background-color: #6b2b46;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        /* Mobile Optimization */
        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width,
            .btn-submit {
                grid-column: span 1;
            }

            .form-container {
                padding: 24px 16px;
            }
        }

        #fingerprintStatus {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>

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

            <div class="form-group full-width">
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

            <button type="button" id="captureBtn">
                Capture Fingerprint
            </button>

            <div id="fingerprintStatus" style="margin-top:10px;font-weight:bold;color:#833556;">
                Fingerprint Not Captured
            </div>

            <button type="submit" class="btn-submit">Register Member</button>
        </form>
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

</body>

</html>
