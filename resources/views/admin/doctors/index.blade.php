@extends('admin.layouts')

@section('css')

@endsection

@section('title', 'Doctors')

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
                            <th>Id</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Major_Id</th>
                            <th>Hospital_Id</th>
                            <th>Phone</th>
                            <th>Rate</th>
                            <th>Creat Date</th>
                            <th>Update Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $doctor)
                            <tr>
                                <th>{{$doctor->id}}</th>
                                <th>{{$doctor->name}}</th>
                                <th>{{$doctor->email}}</th>
                                <th>{{$doctor->major_id}}</th>
                                <th>{{$doctor->hospital_id}}</th>
                                <th>{{$doctor->phone}}</th>
                                <th>{{$doctor->rate}}</th>
                                <th>{{$doctor->created_at}}</th>
                                <th>{{$doctor->updated_at}}</th>
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
