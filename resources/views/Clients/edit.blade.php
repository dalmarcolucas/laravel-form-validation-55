@extends('Layouts/layout')

@section('content')

<h3>Editar cliente</h3>
    @include('form._form_errors')
<form action="{{ route('clients.update', ['client' => $client->id])}}" method="post">
    @method('PUT')
    @include('clients._form')    
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
    
@endsection