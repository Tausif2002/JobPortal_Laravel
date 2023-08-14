@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @foreach($applicants as $applicant)
                <div class="card-header"><a href="{{route('jobs.show',[$applicant->id,$applicant->slug])}}">{{$applicant->title}}</a></div>

                <div class="card-body">
                    @foreach($applicant->users as $user)
                    
                <table class="table">
                    <thead>
                        <tr>
                        
                        <th scope="col"></th>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        
                        <td><b> Name : </b>{{$user->name}}</td>
                        <td><b>E-Mail : </b>{{$user->email}}</td>
                        <td><b>Address : </b>{{$user->profile->address}}</td>
                        <td><b>Gender : </b>{{$user->profile->gender}}</td>
                        <td><b>Bio : </b>{{$user->profile->bio}}</td>
                        <td><b>Experience : </b>{{$user->profile->experience}}</td>
                        <td><a href="{{Storage::url($user->profile->resume)}}">Resume</a></td>
                        <td><a href="{{Storage::url($user->profile->cover_letter)}}">Cover Letter</a></td>
                        </tr>
                       
                    </tbody>
                </table>
                @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection