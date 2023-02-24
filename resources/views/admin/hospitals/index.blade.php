@extends('admin.layouts')

@section('css')

@endsection

@section('title', 'Hospitals')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">Hospitals Table</h3>
                <a href="{{ route('hospitals.create') }}" class="btn btn-success float-right">New Hospital</a>
            </div>

            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        <h2>
                            {{ session()->get('message') }}
                        </h2>
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Rate</th>
                            <th>cover</th>
                            <th>Status</th>
                            <th>Creat Date</th>
                            <th>Update Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $hospital)
                            <tr>
                                <th>{{ $hospital->id }}</th>
                                <th>{{ $hospital->name }}</th>
                                <th>{{ $hospital->location }}</th>
                                <th>{{ $hospital->rate }}</th>
                                <th>
                                    <img src="{{ Storage::url('hospitals/' . $hospital->cover) }}" alt="Hospital cover"
                                        height="50px" width="50px">
                                </th>
                                <th>{{ $hospital->is_active ? 'Active' : 'None Active' }}</th>
                                <th>{{ $hospital->created_at }}</th>
                                <th>{{ $hospital->updated_at }}</th>
                                <th>
                                    <div class="btn-group">
                                        <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('hospitals.destroy', $hospital->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </th>
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
