@extends('Layouts/layout')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visualizar Cliente</title>
</head>
<body>
    <h3>Visualizar Cliente</h3>
    <a href={{ route('clients.index')}} class="btn btn-primary">Voltar</a> 
    <a href={{ route('clients.edit', $client->id)}} class="btn btn-primary">Editar</a> 
    <a href={{ route('clients.destroy', $client->id)}} onclick="event.preventDefault();if(confirm('Tem certeza?')){document.getElementById('form-delete').submit()}" class="btn btn-danger">Excluir</a> 
    <form action={{ route('clients.destroy', $client->id)}} style="display: none" id="form-delete" method="post">
        {{ csrf_field() }}
        @method('DELETE')
    </form>
    <br><br>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Nome:</th>
                <td>{{$client->name}}</td>
            </tr>
            <tr>
                <th>Documento:</th>
                <td>{{$client->document_number}}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{$client->email}}</td>
            </tr>
            <tr>
                <th>Telefone:</th>
                <td>{{$client->phone}}</td>
            </tr>
            <tr>
                <th>Inadiplente:</th>
                <td>{{$client->defaulter ? 'sim' : 'não'}}</td>
            </tr>
            <tr>
                <th>Data Nascimento:</th>
                <td>{{$client->date_birth}}</td>
            </tr>
            <tr>
                <th>Sexo:</th>
                <td>{{$client->sex == 'm' ? 'masculino' : 'feminino'}}</td>
            </tr>
            <tr>
                <th>Estado civil:</th>
                <td>
                     @switch($client->marital_status)
                        @case(1)
                            Solteiro
                            @break
                        @case(2)
                            Casado
                            @break
                        @default
                            Divorciado
                    @endswitch
                </td>
            </tr>
            <tr>
                <th>Deficiência:</th>
                <td>{{$client->physical_disability}}</td>
            </tr>
        </tbody>
    </table>    
</body>
</html>
    
@endsection
{{-- 
$table->string('');
$table->string('');
$table->string('email');
$table->string('phone');
$table->boolean('defaulter');
$table->date('');
$table->char('sex', 10);
$table->enum('marital_status', array_keys(Client::MARITAL_STATUS));
$table->string('physical_disability')->nullable(); --}}

{{-- const MARITAL_STATUS = [
    1 => 'Solteiro',
    2 => 'Casado',
    3 => 'Divorciado',
]; --}}