<x-layout>
    <div >
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a Plan.</p>
            <x-card 
                x-data
                @click="$dispatch('open-modal', 'create-idea')"
                class="mt-10 space-y-3 cursor-pointer h-32 w-full" 
                is="button"
                type="button"
            >
                What's the Idea?
            </x-card>
        </header>
        <hr>
        <div class="mt-2">
                <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}">All <span>{{ $statusCount->get('all')}}</span></a>
            @foreach (App\IdeaStatus::cases() as $status)
                <a href="/ideas?status={{ $status->value }}" class="btn {{ request('status') === $status->value ? '' : 'btn-outlined' }}">
                    {{ $status->label() }} <span class="text-xs pl-2">{{ $statusCount->get($status->value)}}</span>
                </a>
            @endforeach
           
        </div>
        <div class="mt-10 text-muted-foreground">   
            <div class="grid md:grid-cols-2 gap-6"> 
                @forelse ($ideas as $idea)
                
                    <x-card href="{{ route('ideas.show', $idea) }}"> 
                        <h3 class="text-foreground text-lg">{{ $idea->title}}</h3>
                        <div class="mt-1">
                            <x-idea.status-label status="{{ $idea->status }}">
                                {{ $idea->status->label() }}
                            </x-idea.status-label>
                        </div>

                       <div class="mt-5 line-clamp-3 ">{{$idea->description}}</div>
                       <div class="mt-4">{{ $idea->created_at->diffForHumans()}}</div>

                       {{-- {{ $idea->link }} --}}
                    </x-card>
                @empty
                    <x-card>No Ideas at this time.</x-card>
                @endforelse
            </div>

        </div>
        <!--Modal -->
        <x-idea.modal />
    </div>
</x-layout>