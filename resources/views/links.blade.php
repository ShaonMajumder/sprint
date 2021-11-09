@extends('layouts.app')

@section('content')

<script>

    $("#table").DataTable();
    
    window.onload = function() {
        if (window.jQuery) {  
            // jQuery is loaded  
            alert("Yeah!");
        } else {
            // jQuery is not loaded
            alert("Doesn't Work");
        }
    }
    </script>

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

                <table id="table" class="table table-striped table-bordered table-hover mb-5">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">#</th>
                            <th scope="col">Sort Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Description</th>
                            <th scope="col">URL</th>
                        </tr>
                    </thead>
                    <tbody id="tablecontents">
                        @foreach($links as $data)
                        <tr class="row1" data-id="{{ $data->id }}">
                            <th scope="row">{{ $data->id }}</th>
                            <td>{{ $data->sort_id }}</td>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->category }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->URL }}</td>
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
