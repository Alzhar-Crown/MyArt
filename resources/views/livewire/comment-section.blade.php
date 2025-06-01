<div class=" w-[90%] bg-white    mx-auto h-[80%]  p-6 flex flex-col gap-5 text-white">
    <div class="w-full border font-semibold tex-lg h-[50px] flex flex-row p-1 gap-2">
        <img src="{{ asset('client/' . $thread->user->profil->foto_profil) }}"
            class="w-[100px] rounded-full object-cover">
        <div class="flex flex-col ">
       <strong class="text-black uppercase">{{$thread->title}}</strong>
       <span class="text-[10px] text-black font-light"> Created {{ $thread->created_at->diffForHumans() }}
        </div>
    </div>

    <div class="h-[80%] overflow-y-auto">
        <div wire:poll.1s>

            @foreach ($comments as $comment)
                <div>
                    @if ($comment->user->id == Auth::id())
                        <strong class="ml-[80%] text-black">Anda</strong>:
                        <p class="ml-[80%] w-fit h-fit p-2 bg-green-500">{{ $comment->body }}</p>
                        <p class="ml-[80%] w-fit h-fit p-2 text-black">{{ $comment->created_at->diffForHumans() }}</p>
                    @else
                        <strong class="text-black">{{ $comment->user->profil->nama_depan }} {{ $comment->user->profil->nama_belakang }}</strong>:
                        <p class=" w-fit h-fit p-2 bg-yellow-500">{{ $comment->body }}</p>
                        <p class=" w-fit h-fit p-2 text-black">{{ $comment->created_at->diffForHumans() }}</p>
                    @endif
                </div>
            @endforeach
        </div>

    </div>

    <form wire:submit.prevent="postComment" class=" w-full  mx-auto text-black flex flex-row gap-4">
        <input wire:model.defer="body" placeholder="Write something.."
            class="w-[60%]  bg-white h-fit  py-2 px-4 focus:outline-green-800 border border-green-600 rounded-full"></input>
        <button type="submit"
            class="p-2 border rounded-xl hover:bg-green-400 text-black hover:text-white  hover:-translate-y-[5px] transition-all duration-200 w-fit h-fit">Kirim</button>
    </form>
</div>
