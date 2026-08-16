<div {{ $attributes->merge([
    'class' => 'mx-auto w-full max-w-[1440px] px-6 lg:px-12'
]) }}>
    {{ $slot }}
</div>
