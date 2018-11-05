{{ csrf_field() }}
<input type="hidden" name="client_type" id="client_type" value="{{$client_type}}">
<div class="form-group">
    <label for="name">Nome</label>   
    <input class="form-control" name="name" id="name" value="{{ old('name', $client->name)}}">
</div>

<div class="form-group">
        <label for="document_number">Documento</label>   
        <input class="form-control" name="document_number" id="document_number" value="{{ old('document_number', $client->document_number) }}">
</div>

<div class="form-group">
        <label for="email">Email</label>   
        <input class="form-control" name="email" id="email" type="email" value="{{old('email', $client->email)}}">
</div>

<div class="form-group">
        <label for="phone">Telefone</label>   
        <input class="form-control" name="phone" id="phone" value="{{old('phone', $client->phone)}}">
</div>

@if ($client_type == App\Client::TYPE_INDIVIDUAL)

@php
$marital_status = $client->marital_status;    
@endphp

<div class="form-group">
    <label for="marital_status">Estado Civíl</label>   
    <select class="form-control" name="marital_status" id="marital_status">
        <option value="">Selecione o estado</option>
        <option value="1" {{ old('marital_status', $marital_status) == '1' ? 'selected' : ''}}>Solteiro</option>
        <option value="2" {{ old('marital_status', $marital_status) == '2' ? 'selected' : ''}}>Casado</option>
        <option value="3" {{ old('marital_status', $marital_status) == '3' ? 'selected' : ''}}>Divorciado</option>
    </select>
</div>

<div class="form-group">
    <label for="date_birth">Data Nascimento</label>   
    <input class="form-control" name="date_birth" id="date_birth" type="date" value="{{ old('date_birth', $client->date_birth)}}">
</div>

@php
$sex = $client->sex;
@endphp

<div class="radio">
<label>
    <input type="radio" name="sex" value="m" {{ old('sex', $sex) == 'm' ? 'checked="checked"' : ''}}> Masculino
</label>
</div>

<div class="radio">
<label>
    <input type="radio" name="sex" value="f"  {{ old('sex', $sex) == 'f' ? 'checked="checked"' : ''}}> Feminino
</label>
</div>

<div class="form-group">
    <label for="physical_disability">Deficiência</label>   
    <input class="form-control" name="physical_disability" id="physical_disability" value="{{ old('physical_disability', $client->physical_disability)}}">
</div>

@else

<div class="form-group">
    <label for="company_name">Nome Fantasia</label>   
    <input class="form-control" name="company_name" id="company_name" value="{{ old('company_name', $client->company_name)}}">
</div>

@endif

<div class="checkbox">
    <label>
        <input type="checkbox" name="defaulter" id="defaulter" type="checkbox" {{ old('defaulter', $client->defaulter) ? 'checked="checked"' : ''}}> Inadimplente
    </label>
</div>