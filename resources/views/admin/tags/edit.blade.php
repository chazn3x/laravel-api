@extends('layouts.app')

{{-- back id for JavaScript function  --}}
@php
    strpos( url()->previous(), 'edit' ) ? $back = '_back2' : $back = '_back';
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3 d-flex flex-column align-items-end">
                <form action="{{ route( 'tags.store' ) }}" method="POST" class="form-inline">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nuovo tag" id="new-tag" name="name">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-primary">Aggiungi</button>
                        </div>
                    </div>
                </form>
                @error('name')
                    <div class="alert alert-danger d-block">{{ $message }}</div>
                @enderror
            </div>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Azioni</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                        <th scope="row">{{ $tag->id }}</th>
                        @if ( $tag->id == $toEdit->id )
                            <td>
                                <form action="{{ route( 'tags.update', $tag->id ) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $tag->name }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Modifica</button>
                                            <button id="{{$back}}" title="Annulla modifica tag" class="btn btn-outline-primary">Annulla</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        @else
                            <td><a href="{{ route( 'tags.show', $tag->id ) }}">{{ $tag->name }}</a></td>
                        @endif
                        <td>{{ $tag->slug }}</td>
                        <td>
                            {{-- Edit --}}
                            <a href="{{ route( 'tags.edit', $tag->id ) }}" title="Modifica tag" class="mx-2 text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('tags.destroy', $tag->id ) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" title="Cancella tag" class="text-decoration-none border-0 bg-transparent text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                        <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection