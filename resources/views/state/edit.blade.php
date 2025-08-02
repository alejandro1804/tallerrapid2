@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Sector
@endsection
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            @includeIf('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} State</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('states.update', $state->id) }}" role="form" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf

                        @include('state.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
