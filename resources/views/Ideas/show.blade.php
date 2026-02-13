<x-layout>
    <div class="py-8 max-w-6xl mx-auto">
        <div class="flex justify-between items-center">
            <a href="{{ route('ideas.index') }}">Back To Ideas</a>

            <div class="flex space-x-3 items-center">
                <button class="btn">Edit</button>
                <form action="{{ route('ideas.delete',$idea) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn-outlined text-red-400">Delete</button>
                </form>
                
            </div>
        </div>
        
        
        <div class="mt-8 space-y-6">
            <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>
            <hr>
            <div class="mt-2 flex gap-x-3 items-center">
                <x-idea.status-label :status="$idea->status->value">{{$idea->status->label()}}</x-idea.status-label>
                <div class="text-muted-foreground text-sm">{{$idea->created_at->diffForHumans()}}</div>
            </div>
            <x-card class="mt-6">
                <div class="text-foreground max-w-none cursor-pointer">{{ $idea->description}}</div>
            </x-card>

            @if ($idea->links->count())
                <div>
                <h3 class="font-bold text-xl my-4">Links:</h3>

                <div class="space-y-2">
                    @foreach ($idea->links as $link )
                        <x-card :href="$link" class="text-primary font-medium flex gap-3 items-center">{{$link}}</x-card>
                    @endforeach
                </div>
            </div>
            @endif
            
        </div>
        
    </div>

</x-layout>