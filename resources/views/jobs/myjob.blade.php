@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
            <table class="table">
            <thead>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>
                        @if(empty(Auth::user()->company->cover_photo))
                            <img src="{{asset('avatar/man.jpg')}}" width="100" style="width:100; margin-right:0px;">            
                
                        @else
                            <img src="{{asset('uploads/logo')}}/{{Auth::user()->company->logo}}" style="width:100;margin-right:0px;">
                         @endif
                        </td>
                        <td style="margin-left:0px;">Position: {{$job->position}}
                            <br><i class="fa fa-clock-o" area-hidden="true"></i>&nbsp; {{$job->job_type}}
                        </td>

                        <td><i class="fa fa-map-marker"></i>&nbsp; address: {{$job->address}}</td>

                        <td><i class="fa fa-globe" area-hidden="true"></i>&nbsp;
                            Date: {{$job->created_at->diffForHumans()}}
                            
                        </td>

                        <td>
                            <a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                            <button class="btn btn-success btn-sm" >Apply</button>
                            </a>
                            <br>
                            <a href="{{route('jobs.edit',[$job->id])}}">
                            <button class="btn btn-dark">Edit</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
