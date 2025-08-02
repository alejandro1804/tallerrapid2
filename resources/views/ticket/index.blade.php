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
                                {{ __(' <Tickets>  '). $cantidad . '   '. $finalizado}}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                                <a href="{{ route('tickets.export.pdf', request()->query()) }}" class="btn btn-danger btn-sm mx-2">
                                    <i class="fa fa-file-pdf-o"></i> {{ __('Exportar PDF filtrado') }}
                                </a>
                              </div>
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
                                <div class="form-group d-flex align-items-center">
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
                                    <label class="mx-2">Desde:
                                        <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
                                    </label>
                                    <label class="mx-2">Hasta:
                                        <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}">
                                    </label>
                                    <button class="btn btn-primary ml-3" type="submit">Filtrar</button>
                                </div>
                            </form>
                        </div>
                         
                        <div class="float-right">
                            <form method="get">
                                <div class="input-group">
                                    <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control"
                                        placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
                                    <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
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
                                            
											<td>{{ $ticket->priority }}</td>
                                            <td>{{ $ticket->author()?->name ?? 'Sin autor' }}</td>


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
