@extends('layouts.app')

@section('template_title')
    Part
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                @if(isset($item))
                                    <h5 class="mt-3">Partes asociadas al ítem: <strong>{{ $item->name }}</strong></h5>
                                @else
                                    <h5 class="mt-3">Listado general de partes</h5>
                                @endif
                            </span>

                             <div class="float-right">
                                <a href="{{ route('parts.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @php
                        $i = $i ?? 0;
                        $item_id = $item_id ?? null;
                    @endphp

                    @if($items && $providers)

                    <form method="GET" action="{{ route('parts.index') }}">

                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="row mb-3">
                            <div class="col-md-4">
                                <select name="item_id" class="form-select">
                                    @foreach($items as $id => $name)
                                        <option value="{{ $id }}" {{ $id == $item_id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="provider_id" class="form-select">
                                    <option value="">-- Filtrar por Proveedor --</option>
                                    @foreach($providers as $provider)
                                        <option value="{{ $provider->id }}" {{ request('provider_id') == $provider->id ? 'selected' : '' }}>
                                            {{ $provider->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end gap-2">
                                <button class="btn btn-success w-100" type="submit">Filtrar</button>
                                <a href="{{ route('parts.index') }}" class="btn btn-secondary w-100">Reset</a>
                            </div>
                        </div>
                    </form>
                    @endif    
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                     	<th>Nro Equipo </th>
                                        @if(!isset($item))

                                        <th>Equipo o Maquina </th>
                                        @endif
										<th>Parte</th>
										<th>Provider </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($parts->isEmpty())
                                  <p> NO HAY REGISTROS </P>  

                                @else    
                                    @foreach ($parts as $part)
                                            @php
                                                 ++$i;  
                                            @endphp
                                        <tr>
                                        	<td>{{ $part->item_id }}</td>
                                            @if(!isset($item))

                                                <td>{{ $part->item->name }}</td>
                                            @endif    
											<td>{{ $part->name }}</td>
											<td>{{ $part->provider->name ?? 'Sin proveedor'}}</td>

                                            <td>
                                                <form action="{{ route('parts.destroy',$part->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('parts.show',$part->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('parts.edit',$part->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $parts->links() !!}
            </div>
        </div>
    </div>
@endsection
