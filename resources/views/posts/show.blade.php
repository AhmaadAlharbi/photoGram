<x-app-layout>
    <div class="h-screen md:flex md:flex-row ">
        {{-- Left Side --}}
        <div class="h-full md:w-7/12  flex justify-center items-cente">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->image }}"
                class="max-h-screen object-cover">
        </div>
        {{-- Right Side --}}
        <div class="flex flex-col w-full md:w-5/12 bg-white">
            {{-- Top --}}
            <div class="flex items-center p-5">
                <img src="{{ $post->owner->image }}" alt="{{ $post->owner->username }}" class="h-10 w-10 rounded-full">
                <div class="grow">
                    <a href="/{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
                </div>
                @if ($post->owner->id === auth()->id())
                <a href="/p/{{$post->slug}}/edit"><i class='bx bx-message-square-edit text-xl'></i></a>
                <i type='solid' name='trash-alt  text-xl'></i>
                <form action="{{route('delete_post',$post)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are You sure you want delet post?')">
                        <i class='bx bx-message-square-x ltr:ml-2 rtl:mr-2 text-xl text-red-600'></i>
                        {{-- <i type='solid' name='trash-alt  text-xl'></i> --}}
                    </button>
                </form>

                @endif

            </div>
            {{--middle--}}
            <div class="grow overflow-y-auto">
                <div class="flex items-start p-5">
                    <img src="{{$post->owner->image}}" class="mr-5 h-10 w-10 rounded-full" alt="">
                    <div>
                        <a href="/{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
                        {{$post->description}}
                    </div>
                </div>
                {{--comments--}}
                <div>
                    @foreach ( $comments as $comment )
                    <div class="flex items-start px-5 py-2">
                        <img src="{{$comment->owner->image}}" alt="" class="h-100 mr-5 rounded-full">
                        <div class="flex flex-col">
                            <a href="/{{$comment->owner->username}}" class="font-bold">{{$comment->owner->username}}</a>
                            {{$comment->body}}
                        </div>
                        <div class="mt-1 text-sm font-bold text-gray-400">
                            {{$comment->created_at->diffForHumans(null,true,true)}}
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            <div class="border-t p-5">
                <form action="/p/{{ $post->slug }}/comment" method="POST">
                    @csrf
                    <div class="flex flex-row">
                        <textarea name="body" id="comment_body" placeholder="{{ __('Add a comment...') }}"
                            class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-0 focus:ring-0"></textarea>
                        <button type="submit" class="ltr:ml-5 rtl:mr-5 border-none bg-white text-blue-500">{{
                            __('Post') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>