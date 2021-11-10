@extends('layouts.app')

@section('content')





<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <table id="table"  class="table table-striped table-bordered table-hover mb-5">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">Move</th>
                            <th scope="col">#</th>
                            <th scope="col">Sort Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Description</th>
                            <th scope="col">URL</th>
                        </tr>
                    </thead>
                    <tbody id="tablecontents" class="ui-sortable">
                        @foreach($links as $data)
                        
                            

                        <tr class="row1 ui-sortable-handle" data-id="{{ $data->id }}" role="row">
                            <td>
                                <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;" title="change display order">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </td>
                            <td>{{ $data->id }}</td> 
                            <td>{{ $data->sort_id }}</td>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->category }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->url }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center">
                    {{ $links->links() }}
                </div>

            </div>
        </div>
    </div>
</div>



@endsection
