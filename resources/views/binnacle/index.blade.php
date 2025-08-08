@extends('layouts.app')

@section('template_title')
    Binnacle
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                 <F5> {{ __('Binnacle de ticket: ') . $ticket_id . ' — ' . $itemName }} </F5>
                            </span>
                            <div class="float-right">
                                <!--a href="{{ route('binnacles.create', $ticket_id ) }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a> -->
                                <a href="{{ route('binnacles.create', ['ticket_id' => $ticket_id, 'user_id' => Auth::id()]) }}" class="btn btn-primary">
                                    Crear nueva bitácora
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
                        <form method="get">
                            <div class="float-left">
                                <input type="text" name="search" value="{{ request()->get('search')}}" class="form-control"
                                        plaaceholder="Search ...." aria-label="Search" aria-describedby="button-addon2">
                                <button class="btn btn-success" type="submit" id="button-addon2">Search</button>       

                            <div>
                        </form>
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>User</th>
                                        <th>Fecha y hora </th>
                                        <th>Nota </th>
									</tr>
                                </thead>
                                <tbody>
                                @if($binnacles->isEmpty())
                                  <p> NO HAY REGISTROS </P>  

                                @else    
                                    
                                    @foreach ($binnacles as $binnacle) 
                                            @php
                                                 ++$i;  
                                            @endphp
                                        <tr>
                                    		<td>{{ $binnacle->user->name }}</td>
                                            <td>{{ $binnacle->created_at }}</td>
                                            <td>{{ $binnacle->note }}</td>
										    <td>
                                                <form action="{{ route('binnacles.destroy',$binnacle->id) }}" method="POST">
                                                                                       

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
                {!! $binnacles->links() !!}
            </div>
        </div>
    </div>
@endsection
