@extends('layouts.app')

@section('template_title')
    Ticket
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <h5 class="mt-3"> {{ __('Listado General de tickets') }}</h5>
                            </span>
                            <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm me-2">
                                {{ __('Create New') }}
                            </a>
                            <a href="{{ route('tickets.export.pdf', request()->query()) }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ __('Exportar PDF filtrado') }}
                            </a>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                              <form method="get" class="mb-3">
    <div class="row align-items-center">
        <!-- Estados -->
        <div class="col-md-10 d-flex flex-wrap">
            <label class="mr-2">
                <input type="checkbox" name="estado[]" value="NUEVO" {{ in_array('NUEVO', request()->get('estado', [])) ? 'checked' : '' }}>
                NUEVO
            </label>
            <label class="mx-2">
                <input type="checkbox" name="estado[]" value="EN EJECUCION" {{ in_array('EN EJECUCION', request()->get('estado', [])) ? 'checked' : '' }}>
                EN EJECUCION
            </label>
            <label class="mx-2">
                <input type="checkbox" name="estado[]" value="EN ESPERA" {{ in_array('EN ESPERA', request()->get('estado', [])) ? 'checked' : '' }}>
                EN ESPERA
            </label>
            <label class="mx-2">
                <input type="checkbox" name="estado[]" value="CERRADO" {{ in_array('CERRADO', request()->get('estado', [])) ? 'checked' : '' }}>
                CERRADO
            </label>
        </div>

        <!-- Fechas -->
        <div class="col-md-4 d-flex align-items-center">
            <div class="me-2 d-flex align-items-center">
                <span class="me-2">Desde:</span>
                <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="form-control">
            </div>
            <div class="ms-2 d-flex align-items-center">
                <span class="me-2">Hasta:</span>
                <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="form-control">
            </div>
        </div>
        <!-- Autor -->
        <div class="col-md-2">
            <select name="author_id" class="form-control">
                <option value="">-- Filtrar por Autor --</option>
                @foreach($authors as $id => $name)
                    <option value="{{ $id }}" {{ request('author_id') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Item -->
        <div class="col-md-2">
            <select name="item_id" class="form-control">
                <option value="">-- Filtrar por Item --</option>
                @foreach($items as $id => $name)
                    <option value="{{ $id }}" {{ request('item_id') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Prioridad -->
        <div class="col-md-1">
            <select name="priority" class="form-control">
                <option value="">Prioridad</option>
                @foreach($priorityMap as $priority)
                    <option value="{{ $priority }}" {{ request('priority') == $priority ? 'selected' : '' }}>
                        {{ $priority }}
                    </option>
                @endforeach
            </select>
        </div>



        <!-- Búsqueda -->
        <div class="col-md-3 d-flex">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar...">
            <button class="btn btn-success mx-2" type="submit">Filtrar</button>
            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form> 
                         </div>
                         
                        
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Ticket</th>
                                        <th>State</th>
										<th>Admission</th>
										<th>Item </th>
										<th>Priority</th>
                                        <th>Author</th>
                                        <th>Binnacles</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($tickets->isEmpty())
                                  <p> NO HAY REGISTROS </P>  
                                @else    
                                    @foreach ($tickets as $ticket)
                                        @php
                                             ++$i;  
                                        @endphp
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
											<td>{{ $ticket->state->name }}</td>
											<td>{{ $ticket->admission }}</td>
											<td>{{ $ticket->item->name }}</td>
                                            @php
                                                $priorityLabels = [1 => 'Alta', 2 => 'Media', 3 => 'Baja'];
                                            @endphp
                                            <td>{{ $priorityLabels[$ticket->priority] ?? 'Sin prioridad' }}</td>
                                            @php
                                                $autor = $ticket->users->firstWhere('pivot.role_in_ticket', 'autor');
                                            @endphp

                                            <td>{{ $autor ? $autor->name : 'Sin autor' }}</td>
                                            
                                            <td>{{ $ticket->binnacles->count() }} bitácoras</td>
                                            

                                            <td>
                                                <form action="{{ route('tickets.destroy',$ticket->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tickets.show',$ticket->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tickets.edit',$ticket->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    <a class="btn btn-sm btn-warning" href="{{ route('binnacles.index',['id' => $ticket->id]) }}"><i class="fa fa-fw fa-edit"></i>{{ __('Bitacora') }}</a>
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
                {!! $tickets->links() !!}
                {{ $tickets->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
