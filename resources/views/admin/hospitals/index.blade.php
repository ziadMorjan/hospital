@extends('admin.layouts')

@section('css')

@endsection

@section('title', 'Hospitals')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Hospitals Table</h3>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 25px">Id</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Rate</th>
                            <th>Creat Date</th>
                            <th>Update Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $hospital)
                            <tr>
                                <th>{{$hospital->id}}</th>
                                <th>{{$hospital->name}}</th>
                                <th>{{$hospital->location}}</th>
                                <th>{{$hospital->rate}}</th>
                                <th>{{$hospital->created_at}}</th>
                                <th>{{$hospital->updated_at}}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
