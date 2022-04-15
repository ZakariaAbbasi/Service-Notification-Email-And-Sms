@extends('layouts.layout')

@section('title', 'Send SMS')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @lang('notifications.send_sms')
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
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group ">
                            <label for="user">@lang('notifications.users')</label>
                            <select name="user" class="form-control" id="user">
                                @foreach ($users as $user)
                                    <option {{ old('user') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">@lang('notifications.sms_text')</label>
                            <textarea name="text" id="text" class="form-control" rows="3">{{ old('text') }}</textarea>
                        </div>
                        @include('errors.message')
                        <button type="submit" class="btn btn-info">@lang('notifications.send')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
