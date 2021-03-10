@extends('layouts.cms')

@section('content')

<div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success" role="alert" v-if="successRegistration">
                Registered successfully.
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-7">
                
                <div class="card border-primary mb-3" >
                    <div class="card-header">Registration</div>
                    <div class="card-body">
                        <form method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="First Name *"
                                            name="first_name"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Last Name *"
                                            name="last_name"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Contact No. *"
                                            name="contact_no"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input 
                                            type="email" 
                                            class="form-control" 
                                            placeholder="Email Address *"
                                            name="email"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label >Role</label>
                                            <select 
                                                class="custom-select" 
                                                name="role"
                                                required
                                                >
                                                <option value="admin">Admin</option>
                                                <option value="sponsor">Sponsor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <input 
                                                type="password" 
                                                class="form-control" 
                                                placeholder="Password *"
                                                name="password"
                                                required
                                            >
                                        </div>
                                        <div class="form-group">
                                            <input 
                                                type="password" 
                                                class="form-control" 
                                                placeholder="Confirm password *"
                                                
                                                required
                                            >
                                            <small class="text-danger" v-if="errors != ''">Those password didn't match. Try again.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    
                                    <div class="form-group">
                                        <p>
                                            <small class="text-muted">
                                                By clicking Register you agree to our Terms and that you have read out <a href="#">Data Use Policy</a>, including our <a href="#">Cookie Use</a>.                                        
                                            </small>
                                        </p>
                                        <button class="btn btn-primary">Register</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop