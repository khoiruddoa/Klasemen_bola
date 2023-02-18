@extends('layouts.main')

@section('container')
<div class="table-responsive col-lg-8">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Klub</th>
                <th scope="col">Main</th>
                <th scope="col">Menang</th>
                <th scope="col">Seri</th>
                <th scope="col">Kalah</th>
                <th scope="col">Gol Menang</th>
                <th scope="col">Kebobolan</th>
                <th scope="col">Point</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fights as $fight)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fight->name}}</td>
                    <td>{{ $fight->main}}</td>
                    <td>{{ $fight->menang}}</td>
                    <td>{{ $fight->seri}}</td>
                    <td>{{ $fight->kalah}}</td>
                    <td>{{ $fight->goal_menang}}</td>
                    <td>{{ $fight->goal_kalah}}</td>
                    <td>{{ $fight->point}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
