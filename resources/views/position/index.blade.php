@extends('layouts.app')

@section('template_title')
    Position
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; align-items: center; position: relative;">
                            <div style="flex: 1;">
                                <h5>{{ __('Position') }}</h5>
                            </div>

                            <div style="position: absolute; left: 50%; transform: translateX(-50%);">
                                <a href="{{ route('positions.create') }}" class="btn btn-primary btn-sm" data-placement="left">
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        
                                        
										<th>Name</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($positions->isEmpty())
                                  <p> NO HAY REGISTROS </P>  

                                @else    

                                    @foreach ($positions as $position)
                                             @php
                                                 ++$i;  
                                            @endphp

                                        <tr>
                                           
                                            
											<td>{{ $position->name }}</td>

                                            <td>
                                                <form action="{{ route('positions.destroy',$position->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('positions.show',$position->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('positions.edit',$position->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $positions->links() !!}
            </div>
        </div>
    </div>
@endsection
