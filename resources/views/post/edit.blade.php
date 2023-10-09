<x-app-layout>
    <x-slot name="header">
        <x-header title="Edit Post" />
    </x-slot>

    <x-post-form :post="$post"/>
</x-app-layout>