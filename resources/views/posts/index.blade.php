<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
        {{-- Left Side --}}
        <div class="w-[30rem] mx-auto lg:w-[95rem]">
            @forelse($posts as $post)
            <x-post :post="$post" />
            @empty
            <div class="max-w-2xl gap-8 mx-auto">
                {{('__start following your friends')}}
            </div>
            @endforelse
        </div>
        {{-- Right Side --}}
        <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4">
        </div>
    </div>
</x-app-layout>