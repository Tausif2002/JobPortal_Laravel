@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->profile->avatar))
                <img src="{{asset('avatar/man.jpg')}}" width="80" style="width:90%">
            @else
                <img src="{{asset('uploads/avatar')}}/{{Auth::user()->profile->avatar}}" width="80" style="width:90%;">
            @endif
            
            <br><br>

            <form action="{{route('avatar')}}" method="POST" enctype="multipart/form-data">@csrf
            <div class="card">
                <div class="card-header">Update Profile Picture</div>
                <div class="card-body">
                    <input type="file" class="form-control" name="avatar">
                    <br>
                    <button class="btn btn-success float-end" type="submit">Update</button>

                    @if($errors->has('avatar'))
                        <div class="error" style="color:red;">
                            {{$errors->first('avatar')}}
                        </div>
                    @endif
                </div>
                
            </div>
            </form>

        </div>

        <div class="col-md-5">
            <div class="card">
                 @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{Session::get('message')}}
                    </div>
                @endif
                @if(Session::has('warning'))
                    <div class="alert alert-danger">
                    {{Session::get('warning')}}
                    </div>
                    
                @endif
                <div class="card-header">
                    Update Your Profile
                </div>
                <form action="{{route('profile.create')}}" method="POST">@csrf
                <div class="card-body">

                    
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="{{Auth::user()->profile->address}}">

                        @if($errors->has('address'))
                            <div class="error" style="color:red;">
                                {{$errors->first('address')}}
                            </div>
                        @endif
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" value="{{Auth::user()->profile->phone_no}}">

                        @if($errors->has('phone_number'))
                            <div class="error" style="color:red;">
                                {{$errors->first('phone_number')}}
                            </div>
                        @endif
                   
                    </div>

                    <br>

                    <div class="form-group">
                        <label for="experience" class="form-label">Experience</label>
                        <textarea name="experience"  class="form-control" >{{Auth::user()->profile->experience}}</textarea>

                        @if($errors->has('experience'))
                            <div class="error" style="color:red;">
                                {{$errors->first('experience')}}
                            </div>
                        @endif
                    
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea name="bio"  class="form-control" >{{Auth::user()->profile->bio}}</textarea>

                        @if($errors->has('bio'))
                            <div class="error" style="color:red;">
                                {{$errors->first('bio')}}
                            </div>
                        @endif
                    
                    </div>
                    <br>
                    <div class="form-group justify-content-center">
                        <button class="btn btn-success float-end" type="submit">Update</button>
                    </div>

                   
                   
                    
                </div>
                
                
                </form>
               

                

            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Your Information</div>
                <div class="card-body">
                    <p><strong>Name :</strong> {{Auth::user()->name}}</p>
                    <p><strong>Email-Id :</strong> {{Auth::user()->email}}</p>
                    <p><strong>Address :</strong> {{Auth::user()->profile->address}}</p>
                    <p><strong>Phone Number :</strong> {{Auth::user()->profile->phone_no}}</p>
                    <p><strong>Experience :</strong> {{Auth::user()->profile->experience}}</p>
                    <p><strong>Bio :</strong> {{Auth::user()->profile->bio}}</p>
                    <p><strong>Member On : </strong>{{date('d F Y',strtotime(Auth::user()->created_at))}}</p>

                    @if(!empty(Auth::user()->profile->cover_letter))
                        <p><a href="{{Storage::url(Auth::user()->profile->cover_letter)}}" target="_blank"> Cover Letter </a></p>
                    @else
                        <p>Please upload your Cover letter</p>
                    @endif

                    @if(!empty(Auth::user()->profile->resume))
                        <p><a href="{{Storage::url(Auth::user()->profile->resume)}}" target="_blank"> Resume </a></p>
                    @else
                        <p>Please upload your Resume</p>
                    @endif
                </div>
            </div>
            <br>
            
            <form action="{{route('cover.letter')}}" method="POST" enctype="multipart/form-data">@csrf

            <div class="card">
                <div class="card-header">Update Coverletter</div>
                <div class="card-body">
                    <input type="file" class="form-control" name="cover_letter">
                    <br>
                    <button class="btn btn-success float-end" type="submit">Update</button>

                    @if($errors->has('cover_letter'))
                        <div class="error" style="color:red;">
                            {{$errors->first('cover_letter')}}
                        </div>
                    @endif
                </div>
                
            </div>
            </form>
            <br>
            <form action="{{route('resume')}}" method="POST" enctype="multipart/form-data">@csrf
            <div class="card">
                <div class="card-header">Update Resume</div>
                <div class="card-body">
                    <input type="file" class="form-control" name="resume">
                    <br>
                    <button class="btn btn-success float-end" type="submit">Update</button>

                    @if($errors->has('resume'))
                        <div class="error" style="color:red;">
                            {{$errors->first('resume')}}
                        </div>
                    @endif
                </div>
                
            </div>
            </form>
        </div>
        
    </div>
</div>
@endsection
