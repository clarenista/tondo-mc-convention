@extends('layouts.public')

@section('title')
Registration
@stop

@section('content')
<div class="container">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
</div>
<section>

    <div class="container">
        <div class="row ">
            <div class="col-md-4 py-5 bg-primary text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                        <h2 class="py-3">Registration</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, blanditiis dolorem nobis exercitationem accusamus omnis explicabo delectus, id odio vel vero, aut et. Autem corrupti quasi natus, vel magni odit.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border">
                <h4 class="pb-4">Please fill with your details</h4>
                <form action="{{route('save_guest_registration')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4 col-xs-12">
                            <input name="first_name" value="{{ old('first_name', '') }}" placeholder="First Name" class="form-control" type="text" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <input name="middle_name" value="{{ old('middle_name', '') }}" placeholder="Middle Name" class="form-control" type="text" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <input name="last_name" value="{{ old('last_name', '') }}" placeholder="Last Name" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4 col-xs-12">
                            <input name="prc_no" value="{{ old('prc_no', '') }}" placeholder="PRC ID (if applicable)" class="form-control" type="number" required>
                        </div>
                        <div class="form-group col-md col-xs-12">
                            <input name="hospital_affiliation" value="{{ old('hospital_affiliation', '') }}" placeholder="Hospital Affiliation" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md col-xs-12">
                            <input name="email_address" value="{{ old('email_address', '') }}" placeholder="Email Address" class="form-control" type="email" required>
                        </div>
                        <div class="form-group col-md col-xs-12">
                            <input name="email_address_confirmation" value="{{ old('email_address_confirmation', '') }}" placeholder="Confirm Email Address" class="form-control" type="email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md col-xs-12">
                            <input name="name_on_cert" value="{{ old('name_on_cert', '') }}" placeholder="Name on the Certificate" class="form-control" type="text" required>
                        </div>
                        <div class="form-group col-md-6">

                            <select id="inputState" name="position" value="{{ old('position', '') }}" class="form-control" required>
                                <option value="">Choose Position...</option>
                                <option value="Consultant"> Consultant</option>
                                <option value="Fellow-in-training"> Fellow-in-training</option>
                                <option value="Resident"> Resident</option>
                                <option value="	Clerk/Medical Intern"> Clerk/Medical Intern</option>
                                <option value="Nurse/Healthcare Practitioner"> Nurse/Healthcare Practitioner</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="ml-1 form-row">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="disclaimer_checkbox" id="disclaimer1" required>
                                <label class="form-check-label" for="disclaimer1">
                                    <small>I understand that all information I have provided will be processed by the account owner and host in accordance to the Data Privacy Act of 2012 (RA 10173)</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="ml-1 form-row">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="disclaimer_checkbox" id="disclaimer2" required>
                                <label class="form-check-label" for="disclaimer2">
                                    <small>I allow to share my name to the industry partners for attendance purposes.</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row" id="register-btn-container" style="display: none;">
                        <button type="submit" class="btn btn-danger">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@stop

@section('js')
<script>
    let checkedDisclaimers = []
    const disclaimers = $('[name="disclaimer_checkbox"]')
    for (let d of disclaimers) {
        d.addEventListener('change', function(e) {
            if (this.checked) checkedDisclaimers.push(this.id)
            else checkedDisclaimers.splice(checkedDisclaimers.findIndex(cd => cd === this.id), 1)
            if (checkedDisclaimers.length >= disclaimers.length) {
                $('#register-btn-container').show()
            } else {
                $('#register-btn-container').hide()
            }

        })
    }
</script>
@stop