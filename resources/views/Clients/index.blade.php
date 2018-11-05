@extends('Layouts/layout')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (\Session::has('message'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('message') !!}</li>
            </ul>
        </div>
    @endif
    <h3>Listagem de Clientes</h3>
    <br>
    <a class="btn btn-dark" href="{{ route('clients.create')}}" >Criar novo</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>CNPJ/CPF</th>
                <th>Data Nascimento</th>
                <th>E-Mail</th>
                <th>Telefone</th>
                <th>Sexo</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->name}}</td>
            <td>{{$client->document_number}}</td>
            <td>{{$client->date_birth}}</td>
            <td>{{$client->email}}</td>
            <td>{{$client->phone}}</td>
            <td>{{$client->sex}}</td>
            <td>
                <a href="{{ route('clients.edit', ['client' => $client->id])}}">Editar</a> | 
                <a href="{{ route('clients.show', ['client' => $client->id])}}">Visualizar</a>
            </td>
            </tr>    
            @endforeach
        </tbody>
    </table>
</body>
</html>
    
@endsection
