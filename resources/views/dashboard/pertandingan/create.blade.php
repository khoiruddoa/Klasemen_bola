@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Pertandingan</h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/dashboard/pertandingan/create" class="mb-5">
            @csrf


            <div class="mb-3">
                <label for="category" class="form-label">Home Team</label>
                <select class="form-select" name="home_id">
                    @foreach ($categories as $category)
                        @if (old('home_id') == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="home_score" class="form-label">Home_score</label>
                <input type="number" name="home_score" class="form-control  @error('home_score') is-invalid @enderror"
                    id="home_score" value="{{ old('home_score') }}" autofocus>
                @error('home_score')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Away Team</label>
                <select class="form-select" name="away_id">
                    @foreach ($categories as $category)
                        @if (old('away_id') == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="away_score" class="form-label">away score</label>
                <input type="number" name="away_score" class="form-control  @error('away_score') is-invalid @enderror"
                    id="away_score" value="{{ old('away_score') }}" autofocus>
                @error('away_score')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Input score</button>
        </form>
    </div>
@endsection
