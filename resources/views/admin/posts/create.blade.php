@extends('layouts.app')

{{-- back id for JavaScript function  --}}
@php
    strpos( url()->previous(), 'edit' ) || strpos( url()->previous(), 'create' ) ? $back = '_back2' : $back = '_back';
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">
                    <span>Crea un nuovo post</span>
                </div>
                
                <div class="card-body">
                    <form id="_update" action="{{ route( 'posts.store' ) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Titolo --}}
                        <div class="form-group">
                            <label for="title">Titolo:</label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" placeholder="Inserisci il titolo" value="{{ old('title') }}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Contenuto --}}
                        <div class="form-group">
                            <label for="content">Contenuto:</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" placeholder="Inserisci il contenuto" rows="6">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Immagine --}}
                        <div class="form-group">
                            <img id="image-preview" class="img-fluid" src="http://placehold.jp/606060/ffffff/800x500.png?text=Image%20preview&css=%7B%22border-radius%22%3A%2215px%22%7D" alt="preview image">
                            <div class="custom-file mt-3">
                                <label for="image" class="custom-file-label" id="image-title">Aggiungi immagine</label>
                                <input type="file" name="image" id="image" class="custom-file-input">
                            </div>
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Categorie --}}
                        @php
                            $sortedCategories = $categories->all();

                            usort($sortedCategories, 'sortByName');

                            function sortByName($a, $b) {
                                return $a->name > $b->name;
                            }
                        @endphp
                        <div class="form-group">
                            <label for="category">Categoria:</label>
                            <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id" id="category">
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Seleziona una categoria</option>
                                @foreach ($sortedCategories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tags --}}
                        <div class="form-group">
                            <p>Tags:</p>
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="{{ $tag->slug }}" name="tags[]" value="{{ $tag->id }}" @if ( in_array( $tag->id, old('tags', []) ) ) checked @endif>
                                    <label class="form-check-label" for="{{ $tag->slug }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                            @error('tags')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <input id="published" type="hidden" name="published" value="">
                        
                        {{-- Buttons --}}
                        <div class="_buttons text-right">
                            {{-- Salva come bozza --}}
                            <button id="save" type="submit" class="btn btn-primary">Salva per dopo</button>
                            {{-- Salva e pubblica --}}
                            <button id="publish" type="submit" class="btn btn-success">Pubblica</button>
                        </div>
                    </form>
                </div>
            </div>
            <button id="{{$back}}" title="Annulla creazione post" class="btn btn-primary">Annulla</button>
        </div>
    </div>
</div>
@endsection