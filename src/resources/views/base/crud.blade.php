@extends(config('crudkit.view_layout', 'layouts.form-layout'))

@section('title')
{{ isset($item) ? __('update') : __('add') }} {{ __($form_name) }}
@endsection

@section('form')
<form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="mt-3">
    @csrf
    @if ($item)
        @method('PUT')
    @endif

    {{-- Form fields (snipped for brevity) --}}
    {{-- Replace this with your own logic or publish the view and edit --}}

    <button type="submit" class="btn btn-primary">{{ $item ? __('update') : __('save') }}</button>
    <button type="button" class="btn btn-danger" onclick="history.back()">{{ __('back') }}</button>
</form>
@endsection
