<x-layout>
    <div class="py-8 max-w-6xl mx-auto">
        <div class="flex justify-between items-center">
            <a href="{{ route('ideas.index') }}">Back To Ideas</a>

            <div class="flex space-x-3 items-center">
                <button 
                    class="btn"
                    x-data
                    @click="$dispatch('open-modal', 'edit-idea')"
                >Edit
                </button>
                <form action="{{ route('ideas.delete',$idea) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn-outlined text-red-400">Delete</button>
                </form>
                
            </div>
        </div>
        
        <div class="mt-8 space-y-6">
            @if ($idea->image_path)
                <div class="rounded-lg  overflow-hidden">
                    <img src="{{ asset('storage/'. $idea->image_path) }}" alt="Idea Logo" class="w-full h-auto object-cover">
                </div>
            @endif
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

             @if ($idea->steps->count())
                <div>
                <h3 class="font-bold text-xl my-4">Steps:</h3>

                <div class="space-y-2">
                    @foreach ($idea->steps as $step )
                        <x-card>
                            
                                <form action="{{route('steps.update', $step)}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center gap-x-3">
                                        <button type="submit" class="size-5 flex items-center justify-center rounded-lg text-primary-foreground {{$step->completed ? 'bg-primary' : 'border border-primary' }}">
                                            &check;
                                        </button>
                                        <span class="{{ $step->completed ? 'line-through text-muted-foreground' : ''  }}">{{$step->description}}</span>
                                    </div>
                                </form>
                           
                        </x-card>
                    @endforeach
                </div>
            </div>
            @endif


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
        <x-idea.modal :idea="$idea"/>
        
    </div>

</x-layout>