@extends('layouts.app')

@section('content')
<div class="columns is-multiline">
    @foreach($jobs as $job)
      <div class="column is-one-quarter">
      <div class="card">
        <div class="card-content">
          <p class="title is-4">
              <strong>{{$job->name}}</strong>
          </p>
          <p class="subtitle is-6">
              {{$job->description}}
          </p>
        </div>
        <footer class="card-footer">
          <p class="card-footer-item" style="border-top: 1px solid black;border-right: 1px solid black">
            <span>
              <strong>Cijena</strong>: {{$job->price}} HRK
            </span>
          </p>
          <p class="card-footer-item" style="border-top: 1px solid black">
            <span>
              <strong>Trajanje</strong>: {{$job->duration_in_minutes}} (min)
            </span>
          </p>
        </footer>
      </div>
    </div>
  @endforeach
</div>
<style>
.card {
  height: 100%;
  display:flex;
  flex-direction: column;
  background-color: #e6e6e6;
}
.card-footer {
    margin-top: auto;
    background-color: #b3d9ff;
}
</style>


{{ $jobs->links() }}

@endsection
