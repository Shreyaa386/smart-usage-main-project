@props([
    'name' => 'password',
    'id' => null,
    'label' => 'Password',
    'placeholder' => '••••••••',
    'required' => true,
    'value' => '',
    'showIcon' => true,
])

@php
    $fieldId = $id ?? $name;
@endphp

<div class="space-y-2">
    <label class="text-xs sm:text-sm font-semibold tracking-tight text-white ml-1" for="{{ $fieldId }}">{{ $label }}</label>
    <div class="relative">
        @if($showIcon)
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white pointer-events-none">
            <i class="fa-solid fa-lock text-sm"></i>
        </span>
        @endif
        <input
            class="flex h-11 sm:h-12 w-full rounded-xl border border-input bg-gray-800 px-4 py-2 text-sm text-white ring-offset-background placeholder:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20"
            type="password"
            name="{{ $name }}"
            id="{{ $fieldId }}"
            @if($required) required @endif
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
            autocomplete="{{ $name === 'password_confirmation' ? 'new-password' : ($name === 'password' ? 'current-password' : 'off') }}"
        >
        <button
            type="button"
            class="password-toggle absolute inset-y-0 right-0 flex items-center pr-3 sm:pr-4 text-white hover:text-foreground transition-colors cursor-pointer"
            data-target="{{ $fieldId }}"
            aria-label="Show password"
            aria-pressed="false"
        >
            <i class="fa-regular fa-eye text-base" aria-hidden="true"></i>
        </button>
    </div>
    @error($name)
        <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span>
    @enderror
</div>
