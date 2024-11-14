@extends('statamic::layout')
@section('title', __('Short URLs'))

@section('content')
    <header class="mb-3">
        @include('statamic::partials.breadcrumb', [
            'url' => cp_route('utilities.index'),
            'title' => __('Utilities')
        ])
        <h1>{{ __('Short URLs') }}</h1>
    </header>

    <div class="card mb-6">
        <form method="POST" action="{{ cp_route('utilities.short-urls.create') }}">
            @csrf
            <div class="flex items-center">
                <div class=" rtl:ml-4 ltr:mr-4 flex-1">
                    <input type="text" name="destination-url" value="{{ old('destination-url') }}" placeholder="https://example.com/my-long-url" class="input-text @error('destination-url') is-invalid @enderror">
                    @error('destination-url')
                        <div class="help-block text-red-500">{{ $message }}</div>
                    @enderror
                </div>    
                <button type="submit" class="btn-primary">{{ __('Shorten URL') }}</button>
            </div>
        </form>
    </div>

    <div class="card p-0">
        <div class="w-full overflow-auto">
            <table class="data-table">
                <thead class="pb-1">
                    <th>{{ __('URL') }}</th>
                    <th>{{ __('Destination') }}</th>
                    <th>{{ __('Activated at') }}</th>
                </thead>
                <tbody>
                    @forelse  ($shortUrls as $shortUrl)
                        <tr>
                            <td>{{ $shortUrl['default_short_url'] }}</td>
                            <td>{{ $shortUrl['destination_url'] }}</td>
                            <td>{{ $shortUrl['activated_at'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="3">{{ __('No data') }}</td>
                        </tr>
                    @endforelse 
                </tbody>
            </table>
        </div>
    </div>
@stop