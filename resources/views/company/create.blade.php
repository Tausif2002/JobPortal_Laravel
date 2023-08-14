@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">

        @if(empty(Auth::user()->company->logo))
                <img src="{{asset('avatar/man.jpg')}}" width="80" style="width:90%">            
                
                @else
                <img src="{{asset('uploads/logo')}}/{{Auth::user()->company->logo}}" width="80" style="width:50%">
                @endif
           
                
         
            
            <br><br>

            <form action="{{route('company.logo')}}" method="POST" enctype="multipart/form-data">@csrf
            <div class="card">
                <div class="card-header">Update Company logo</div>
                <div class="card-body">
                    <input type="file" class="form-control" name="company_logo">
                    <br>
                    <button class="btn btn-success float-end" type="submit">Update</button>

                    @if($errors->has('company_logo'))
                        <div class="error" style="color:red;">
                            {{$errors->first('company_logo')}}
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
                    Update Your Company Information
                </div>
                <form action="{{route('company.store')}}" method="POST">@csrf
                <div class="card-body">

                    
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="{{Auth::user()->company->address}}">

                        @if($errors->has('address'))
                            <div class="error" style="color:red;">
                                {{$errors->first('address')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label" >Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{Auth::user()->company->phone}}">

                    </div>

                    <div class="form-group">
                        <label for="website" class="form-label" >Website</label>
                        <input type="text" class="form-control" name="website" value="{{Auth::user()->company->website}}">

                    </div>

                    <div class="form-group">
                        <label for="slogan" class="form-label">Slogan</label>
                        <input type="text" class="form-control" name="slogan" value="{{Auth::user()->company->slogan}}">

                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>

                       <textarea name="description" class="form-control">{{Auth::user()->company->description}}</textarea>

                    </div>

                    <br>
                    <br>                   
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
                <div class="card-header">About your company</div>
                    <div class="card-body">
                        <p><strong>Company Name</strong> : {{Auth::user()->company->cname}}</p>
                        <p><strong>Company Address</strong>: {{Auth::user()->company->address}}</p>
                        <p><strong>Company Phone </strong>: {{Auth::user()->company->phone}}</p>
                        <p><strong>Company website </strong>: <a href="{{Auth::user()->company->website}}">{{Auth::user()->company->website}}</a></p>
                        <p><strong>Company slogan </strong>: {{Auth::user()->company->slogan}}</p>
                        <p>Company page <a href="company/{{Auth::user()->company->slug}}">view</a></p>
                    
                    </div>
                </div>
            <br>
            
            <form action="{{route('cover.photo')}}" method="POST" enctype="multipart/form-data">@csrf

            <div class="card">
                <div class="card-header">Update Cover photor</div>
                    <div class="card-body">
                        <input type="file" class="form-control" name="cover_photo">
                        <br>
                        <button class="btn btn-success float-end" type="submit">Update</button>

                        @if($errors->has('cover_photo'))
                            <div class="error" style="color:red;">
                                {{$errors->first('cover_photo')}}
                            </div>
                        @endif
                    </div>
                
                </div>
                </form>
                <br>
            
        </div>
        
    </div>
</div>
@endsection
