@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row justify-content-center">

      @foreach ($projects as $project)
        <div class="project-item">
          <a href="projects?title={{ $project->title }}">
            <i class="fas fa-folder-open fa-2x"></i> <br>
            <span>{{ $project->title }}</span>
          </a>
        </div>
      @endforeach

      
    </div>
  </div>
@endsection

@section('top-head-css')
  <style>

  </style>
@endsection

@section('top-head-js')
  <script>
    
  </script>
@endsection