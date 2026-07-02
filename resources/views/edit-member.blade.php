@extends('layouts.admin')

@section('title', 'Edit Member')

@section('content')

    <div class="register-page">

        <div class="form-container">
            <h1>Edit Member</h1>

            @if ($errors->any())
                <div class="error-banner">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="memberForm" method="POST" action="{{ route('members.update', $member->id) }}"
                enctype="multipart/form-data" class="form-grid">

                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name"
                        value="{{ old('first_name', $member->first_name) }}">
                </div>

                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name"
                        value="{{ old('middle_name', $member->middle_name) }}">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name"
                        value="{{ old('last_name', $member->last_name) }}">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="">-- Select Gender --</option>

                        <option value="Male" {{ old('gender', $member->gender) == 'Male' ? 'selected' : '' }}>
                            Male
                        </option>

                        <option value="Female" {{ old('gender', $member->gender) == 'Female' ? 'selected' : '' }}>
                            Female
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth"
                        value="{{ old('date_of_birth', $member->date_of_birth) }}">
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $member->phone) }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $member->email) }}">
                </div>

                <div class="form-group full-width">
                    <label for="national_id">National ID(Personal Number)</label>
                    <input type="text" id="national_id" name="national_id"
                        value="{{ old('national_id', $member->national_id) }}">
                </div>

                <div class="form-group">
                    <label for="payam">Payam</label>
                    <select id="payam" name="payam">

                        <option value="">-- Select Payam --</option>

                        @foreach ($payams as $payam)
                            <option value="{{ $payam->name }}"
                                {{ old('payam', $member->payam) == $payam->name ? 'selected' : '' }}>
                                {{ $payam->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="boma">Boma</label>
                    <select id="boma" name="boma">

                        @foreach ($bomas as $boma)
                            <option value="{{ $boma->name }}"
                                {{ old('boma', $member->boma) == $boma->name ? 'selected' : '' }}>
                                {{ $boma->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="clan">Clan</label>
                    <input type="text" id="clan" name="clan" value="{{ old('clan', $member->clan) }}">
                </div>

                <div class="form-group">
                    <label for="section">Section</label>
                    <input type="text" id="section" name="section" value="{{ old('section', $member->section) }}">
                </div>
                <div class="form-group">
                    @if ($member->photo)
                        <img src="/storage/{{ $member->photo }}" style="width:120px;border-radius:8px;margin-bottom:10px;">
                    @endif

                    <label for="photo">Replace Photo</label>
                    <input type="file" id="photo" name="photo">
                </div>

                <input type="hidden" id="fingerprint_template" name="fingerprint_template"
                    value="{{ $member->fingerprint_template }}">

                <button type="submit" class="btn-submit">Update Member</button>
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



@endsection
