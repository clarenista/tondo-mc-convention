@extends('layouts.public')

@section('title')
Registration
@stop

@section('content')
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
                            <input name="first_name" placeholder="First Name" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <input name="middle_name" placeholder="Middle Name" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <input name="last_name" placeholder="Last Name" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4 col-xs-12">
                            <input name="prc_no" placeholder="PRC ID (if applicable)" class="form-control" type="number">
                        </div>
                        <div class="form-group col-md col-xs-12">
                            <input name="hospital_affiliation" placeholder="Hospital Affiliation" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md col-xs-12">
                            <input name="email_address" placeholder="Email Address" class="form-control" type="email">
                        </div>
                        <div class="form-group col-md col-xs-12">
                            <input name="confirm_email_address" placeholder="Confirm Email Address" class="form-control" type="email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md col-xs-12">
                            <input name="name_on_cert" placeholder="Name on the Certificate" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-6">

                            <select id="inputState" name="position" class="form-control">
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
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                <label class="form-check-label" for="invalidCheck2">
                                    <small>I understand that all information I have provided will be processed by the account owner and host in accordance to the Data Privacy Act of 2012 (RA 10173)</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="ml-1 form-row">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                <label class="form-check-label" for="invalidCheck2">
                                    <small>I allow to share my name to the industry partners for attendance purposes.</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <button type="submit" class="btn btn-danger">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@stop