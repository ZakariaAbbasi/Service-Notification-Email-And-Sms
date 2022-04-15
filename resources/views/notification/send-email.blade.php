@extends('layouts.layout')

@section('titile', 'send Email')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @lang('notifications.send_email')
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('failed'))
                        <div class="alert alert-danger text-center">
                            {{ session('failed') }}
                        </div>
                    @endif
                    <form action="{{ route('notifications.send.email') }}" method="POST">
                        @csrf
                        <div class="form-group ">
                            <label for="user">@lang('notifications.users')</label>
                            <select name="user" class="form-control" id="user">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach


                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email_type">@lang('notifications.email_type')</label>
                            <select name="email_type" class="form-control" id="email_type">
                                @foreach ($emailTypes as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach

                            </select>
                        </div>
                        @include('errors.message')

                        <button type="submit" class="btn btn-info">@lang('notifications.send')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
