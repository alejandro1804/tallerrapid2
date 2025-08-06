@extends('layouts.app')

@section('template_title')
    User
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Usuarios') }}
                            </span>
                     
                            
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
                                       	<th>Name</th>
										<th>email</th>
                                        <th>phone</th>
										<th>position</th>
                                        <th>rol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($users->isEmpty())
                                  <p> NO HAY REGISTROS </P>  

                                @else    

                                    @foreach ($users as $user)
                                            @php
                                                 ++$i;  
                                            @endphp
                                                                       
                                        <tr>
                                            <td>{{ $user->name }}</td>
											<td>{{ $user->email  }}</td>
                                            <td>{{ $user->phone  }}</td>
											<td>{{ optional($user->position)->name ?? 'Sin posición' }}</td>
                                            <td>{{ optional($user->role)->name ?? 'Sin posición' }}</td>
                                            <td>
                                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('users.show',$user->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $users->links() !!}
                
            </div>
        </div>
    </div>
@endsection
