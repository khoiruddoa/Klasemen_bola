@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pertandingan</h1>

    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show col-lg-8" role="alert">
            {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive col-lg-6">
        <a href="/dashboard/pertandingan/create" class="btn btn-primary mb-3">Tambah pertandingan Baru</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Home</th>
                    <th scope="col">away</th>
                    <th scope="col">score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fights as $fight)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $fight->home}}</td>
                        <td>{{ $fight->away}}</td>
                        <td>{{ $fight->home_score}} - {{ $fight->away_score}}</td>
                       
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $fights->links() }}

    </div>
@endsection
