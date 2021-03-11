@extends('layouts.cms')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <!-- <div class="alert alert-success" role="alert" v-if="isLoginSuccess">
            Login successs.
        </div> -->
        @error('email')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @enderror

        <div class="card border-primary mb-3" >
            <div class="card-header">User Login</div>
            <div class="card-body">
                <form method="POST">
                    @csrf
                    <div class="col">
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Email Address *"
                                name="email"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Password *"
                                    name="password"
                                    required

                                >
                                <div class="input-group-append" >
                                    <span class="input-group-text" id="my-addon"><i class="fa fa-eye-slash"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@stop
