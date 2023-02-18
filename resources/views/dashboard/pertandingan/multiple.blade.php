@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Pertandingan</h1>
    </div>
    <div class="mb-4">
    <button class="add-button btn btn-success">Tambah Form</button>
</div>
    <div class="col-lg-4">
       
        <form method="post" action="/dashboard/pertandingan/multiplecreate" class="mb-5">
            @csrf
            <div class="container">
                <div class="input-row">
                    <div class="d-flex flex-row gap-3">
                        <div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Home Team</label>
                                <select class="form-select" name="home_id[]">
                                    @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                      
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="home_score" class="form-label">Home_score</label>
                                <input type="number" name="home_score[]"
                                    class="form-control  @error('home_score') is-invalid @enderror" id="home_score"
                                    autofocus required>
                                @error('home_score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Away Team</label>
                                <select class="form-select" name="away_id[]">
                                    @foreach ($categories as $category)
                                        
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                       
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="away_score" class="form-label">away score</label>
                                <input type="number" name="away_score[]"
                                    class="form-control  @error('away_score') is-invalid @enderror" id="away_score" autofocus required>
                                @error('away_score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Input score</button>
                
        </form>
        
       
    </div>




    <script>
        const addButton = document.querySelector(".add-button");
        const container = document.querySelector(".container");

        addButton.addEventListener("click", () => {
            const inputRow = document.createElement("div");
            inputRow.classList.add("input-row");
            inputRow.innerHTML = `<div class="d-flex flex-row gap-3">
                        <div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Home Team</label>
                                <select class="form-select" name="home_id[]">
                                    @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                      
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="home_score" class="form-label">Home_score</label>
                                <input type="number" name="home_score[]"
                                    class="form-control  @error('home_score') is-invalid @enderror" id="home_score"
                                    autofocus required>
                                @error('home_score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Away Team</label>
                                <select class="form-select" name="away_id[]">
                                    @foreach ($categories as $category)
                                        
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                       
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="away_score" class="form-label">away score</label>
                                <input type="number" name="away_score[]"
                                    class="form-control  @error('away_score') is-invalid @enderror" id="away_score" autofocus required>
                                @error('away_score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>`;
            container.appendChild(inputRow);
        });
    </script>
@endsection
