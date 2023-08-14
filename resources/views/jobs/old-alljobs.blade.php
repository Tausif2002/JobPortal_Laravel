@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <form action="{{route('alljobs')}}" method="GET">

        <div class="row row-cols-lg-auto  align-items-center ">
            <div class="form-group col-8">
                <label>Keyword&nbsp;</label>
                <input type="text" name="title" class="form-control">&nbsp;&nbsp;&nbsp;
            </div>
            <div class="form-group col-8">
                <label>Employment type&nbsp;</label>
                <select class="form-control" name="job_type">
                        <option value="">-select-</option>
                        <option value="fulltime">fulltime</option>
                        <option value="parttime">parttime</option>
                        <option value="casual">casual</option>
                    </select>
                    &nbsp;&nbsp;
            </div>
            <div class="form-group col-8">
                <label>category</label>
                <select name="category_id" class="form-control">
                    <option value="">-select-</option>

                        @foreach(App\Models\Category::all() as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                    &nbsp;&nbsp;
            </div>

            <div class="form-group col-8">
                <label>address</label>
                <input type="text" name="address" class="form-control">&nbsp;&nbsp;
            </div>
            
            <div class="form-group col-8">
                <button type="submit" class="btn btn-outline-success">Search</button>
            </div>
        </div>
    </form>
    <br><br>
        <table class="table">
            
            <tbody>
                @foreach($jobs as $job)
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

        <div class="d-flex justify-content-center">
    
        </div>
    </div>
    
</div>

@endsection
<style>
    .fa{
        color:4183D7;
    }
</style>
