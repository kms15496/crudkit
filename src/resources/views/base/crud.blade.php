@extends(config('crudkit.view_layout', 'layouts.form-layout'))

@section('title')
{{ isset($item) ? __('update') : __('add') }} {{ __($form_name) }}
@endsection

@section('form')
<form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="mt-3 " style="margin: bottom 20px;">
    @csrf
    @if ($item)
    @method('PUT')
    @endif


    @php
    $isTwoCols = count($fields) > 8;
    @endphp

    <div class="{{ $isTwoCols ? 'row' : '' }}">
        @foreach ($fields as $field => $rules)
        @if (!in_array($field, $hideFields) || !isset($item))
        <div class="{{ $isTwoCols ? 'col-md-6' : '' }}">
            <div class="mb-3">
                <label for="{{ $field }}" class="form-label">{{ __($field) }}</label>

                @php
                $isTextarea = (strpos($rules, 'max:255') || strpos($rules, 'min:255')) !== false;
                @endphp

                @if (in_array($field,['dob','joining_date']))
                <input type="date" class="form-control" id="{{ $field }}" name="{{ $field }}"
                    value="{{ old($field, isset($item->$field) ? \Carbon\Carbon::parse($item->$field)->format('Y-m-d') : '') }}" required>

                @elseif ($isTextarea)
                <textarea class="form-control" id="{{ $field }}" name="{{ $field }}" rows="3"
                    required>{{ old($field, $item->$field ?? '') }}</textarea>

                @elseif (strpos($rules, 'string') !== false)
                <input
                    type="{{ $field === 'password' ? 'password' : 'text' }}"
                    class="form-control"
                    id="{{ $field }}"
                    name="{{ $field }}"
                    @unless($field==='password' )
                    value="{{ old($field, $item->$field ?? '') }}"
                    @endunless>
                            @elseif (strpos($rules, 'numeric') !== false)
                                <input type="number" class="form-control" id="{{ $field }}"
                                    name="{{ $field }}" value="{{ old($field, $item->$field ?? '') }}" required>
                            @elseif (strpos($rules, 'integer') !== false)
                                <input type="number" class="form-control" id="{{ $field }}"
                                    name="{{ $field }}" value="{{ old($field, $item->$field ?? '') }}" required>
                            @elseif (strpos($rules, 'file') !== false)
                                <input type="file" class="form-control" id="{{ $field }}"
                                    name="{{ $field }}" onchange="previewImage(event, '{{ $field }}')">
                                <div class="mt-2">
                                    @if ($item && $item->getFirstMediaUrl($collection))
                                        <img id="preview-{{ $field }}"
                                            src="{{ $item->getFirstMediaUrl($collection) }}" width="150px"
                                            height="150px" />
                                    @else
                                        <img id="preview-{{ $field }}" style="display: none;" width="150px"
                                            height="150px" />
                                    @endif
                                </div>
                            @elseif (strpos($field, 'start_year') !== false ||
                                    strpos($field, 'end_year') !== false ||
                                    strpos($rules, 'integer') !== false)
                                <input type="number" class="form-control yearpicker" id="{{ $field }}"
                                    name="{{ $field }}" min="1900"
                                    value="{{ old($field, $item->$field ?? ($field == 'end_year' ? date('Y') + 1 : date('Y'))) }}"
                                    required>
                            @elseif (array_key_exists($field, $selectFields))
                                @php
                                    // Define which fields should allow multiple selections
                                    $multipleFields = $multiple;
                                    $isMultiple = in_array($field, $multipleFields);
                                    $isCheckBoxField = in_array($field, $checkBoxFields);
                                    $isRadioField = in_array($field, $radioFields);
                                    $fieldName = $isMultiple ? $field . '[]' : $field;
                                    $selectedValues = old(
                                        $field,
                                        $item?->$field ?? ($isMultiple || $isCheckBoxField ? [] : ''),
                                    );
                                @endphp

                @if($isRadioField)
                <div class="row">
                    @foreach($selectFields[$field] as $key => $label)
                    <div class="col-md-3">
                        <div class="form-check mb-2">
                            <input class="form-check-input"
                                type="radio"
                                name="{{ $field }}" {{-- no [] for radios --}}
                                value="{{ $key }}"
                                id="{{ $field . '_' . $key }}"
                                {{ $selectedValues == $key ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="{{ $field . '_' . $key }}">
                                {{ ucfirst(str_replace('_', ' ', $label)) }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif(!$isCheckBoxField)

                <select class="form-control"
                    id="{{ $field }}"
                    name="{{ $fieldName }}"
                    @if ($isMultiple) multiple @endif
                    required>
                    @if (! $isMultiple)
                    <!-- <option value="">{{ __('Select') }}</option> -->
                    @endif

                    @foreach ($selectFields[$field] as $key => $label)
                    <option value="{{ $key }}"
                        @if (
                        ($isMultiple && in_array($key, $selectedValues)) ||
                        (!$isMultiple && $selectedValues==$key)
                        )
                        selected
                        @endif>
                        {!! $label !!}
                    </option>
                    @endforeach
                </select>

                @else

                <div class="row">
                    @foreach($selectFields[$field] as $key => $label)
                    <div class="col-md-3">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="{{ $fieldName }}[]" value="{{ $key }}" id="{{ $fieldName . '_' . $key }}"
                                {{ in_array($key, $selectedValues) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $fieldName . '_' . $key }}">
                                {{ ucfirst(str_replace('_', ' ', $label)) }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>

                @endif

                @endif

                @error($field)
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">{{ $item ? __('update') : __('save') }}</button>
    <button type="button" class="btn btn-danger" onclick="history.back()">{{ __('back') }}</button>
</form>
@endsection
