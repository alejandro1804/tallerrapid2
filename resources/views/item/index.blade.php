@extends('layouts.app')

@section('template_title')
    Item
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Maquinas o Equipos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
  <form method="get" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <select name="sector_id" class="form-control">
                <option value="">-- Filtrar por Sector --</option>
                @foreach($sectors as $id => $name)
                    <option value="{{ $id }}" {{ request('sector_id') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select name="provider_id" class="form-control">
                <option value="">-- Filtrar por Proveedor --</option>
                @foreach($providers as $id => $name)
                    <option value="{{ $id }}" {{ request('provider_id') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end gap-2">
            <button class="btn btn-success w-100" type="submit">Filtrar</button>
            <a href="{{ route('items.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
        
    </div>
</form>

                  

                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Name</th>
										<th>Sector </th>
										<th>Trademark</th>
										<th>Provider </th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                @if($items->isEmpty())
                                  <p> NO HAY REGISTROS </P>  

                                @else    

                                    @foreach ($items as $item)
                                         @php
                                                 ++$i;  
                                         @endphp
                                                            
                                        <tr>
                                            
                                          	<td>{{ $item->name }}</td>
											<td>{{ $item->sector->name }}</td>
											<td>{{ $item->trademark }}</td>
											<td>{{ $item->provider->name ?? 'Sin proveedor'}}</td>
                                            
                                            <td>
                                                <form action="{{ route('items.destroy',$item->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('items.show',$item->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('items.edit',$item->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    <a class="btn btn-sm btn-warning" href="{{ route('items.parts', ['item' => $item->id]) }}"><i class="fa fa-fw fa-cogs"></i> {{__('Show Parts') }}</a>
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
                {!! $items->appends(request()->query())->links() !!}
                {!! $items->links() !!}
            </div>
        </div>
    </div>
@endsection
