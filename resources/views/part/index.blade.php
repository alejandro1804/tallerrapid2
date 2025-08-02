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
                                {{ __('Part') }}
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

                    <div class="card-body">
                        <div class="table-responsive">
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
                                     	<th>Nro Equipo </th>
                                        <th>Equipo o Maquina </th>
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
                                            <td>{{ $part->item->name }}</td>
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
