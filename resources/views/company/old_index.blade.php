@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="company-profile">

                @if(empty($company->cover_photo))
                <img src="{{asset('cover/tumblr-image-sizes-banner.png')}}" style="width:100%;">
                
                @else
                <img src="{{asset('uploads/coverphoto')}}/{{$company->cover_photo}}" style="width:100%;">
                @endif
                <div class="company-desc">
                @if(empty($company->logo))
                <img src="{{asset('avatar/man.jpg')}}"  width="100">            
                
                @else
                <img src="{{asset('uploads/logo')}}/{{$company->logo}}" width="100">
                @endif
                    <p>{{$company->description}}</p>
                    <h1>{{$company->cname}}</h1>
                    <p>Slogan: {{$company->slogan}} &nbsp;<br>
                        Address: {{$company->address}} &nbsp;<br>
                        Phone: {{$company->phone}} &nbsp;<br>
                        Website: {{$company->website}};

                    </p>

                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($company->jobs as $job)
                    <tr>
                        <td><img src="{{asset('avatar\man.jpg')}}" width="80"></td>
                        <td>Position: {{$job->position}}
                            <br><i class="fa fa-clock-o" area-hidden="true"></i>&nbsp; {{$job->job_type}}
                        </td>

                        <td><i class="fa fa-map-marker"></i>&nbsp; address: {{$job->address}}</td>

                        <td><i class="fa fa-globe" area-hidden="true"></i>&nbsp;
                            Date: {{$job->created_at->diffForHumans()}}
                            
                        </td>

                        <td>
                            <a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                            <button class="btn btn-success btn-sm">Apply</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
@endsection
