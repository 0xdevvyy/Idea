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
        <x-modal name="create-idea" title="New Idea">
            <form x-data="{status : 'pending', newLink : '', links: [], newStep : '', steps: [],} " action="{{ route('ideas.create') }}" method="POST" >
                @csrf

                <div class="space-y-6">
                    <x-form.field 
                        label="title"
                        name="title"
                        type="text"
                        placeholder="Enter Your Idea Title"
                        autofocus
                        required
                    />
                    <div class="space-y-2">
                        <label for="status" class="label">Status</label>
                        <div class="flex gap-x-3 mt-2">
                            @foreach (App\IdeaStatus::cases() as $status)
                                <button 
                                    class="btn flex-1 h-10 btn-outlined"
                                    @click="status = @js($status->value)" 
                                    :class="{'btn-outlined': status !== @js($status->value) }"
                                    type="button"
                                    >
                                        {{$status->label()}}
                                    </button>
                                
                            @endforeach

                            <input label="status" name="status"  type="hidden" :value="status" class="input" />
                        </div>
                        
                    </div>

                    <x-form.field 
                        label="Description"
                        name="description"
                        type="textarea"
                        placeholder="Descripe Your Idea Title"
                        autofocus
                    />
                    <!--Steps -->
                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">steps</legend>


                            <template x-for="(step, index) in steps" >
                                <div class="flex gap-x-2 items-center">
                                    <input name="steps[]" x-model="step" class="input">
                                    <button 
                                        type="button"
                                        @click="steps.splice(index, 1);"
                                        class="form-muted-icon"
                                    >x</button>
                                </div>
                            </template>


                            <div class="flex gap-x-2 items-center">
                                <input 
                                    x-model="newStep" 
                                    id="new-step" 
                                    placeholder="Add a New Steps"
                                    class="input flex-1"
                                    spellcheck="false"
                                >
                                <button 
                                    type="button"
                                    @click="steps.push(newStep.trim()); newStep = ''; "
                                    :disabled = "newStep.trim().length === 0"
                                    class="form-muted-icon"
                                >+</button>
                            </div>

                        
                        </fieldset>
                        
                    </div>
                  

                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Links</legend>


                            <template x-for="(link, index) in links" >
                                <div class="flex gap-x-2 items-center">
                                    <input name="links[]" x-model="link" class="input">
                                    <button 
                                        type="button"
                                        @click="links.splice(index, 1);"
                                        class="form-muted-icon"
                                    >x</button>
                                </div>
                            </template>


                            <div class="flex gap-x-2 items-center">
                                <input 
                                    x-model="newLink"
                                    type="url" 
                                    id="new-link" 
                                    placeholder="https://example.com"
                                    autocomplete="url"
                                    class="input flex-1"
                                    spellcheck="false"
                                >
                                <button 
                                    type="button"
                                    @click="links.push(newLink.trim()); newLink = ''; "
                                    :disabled = "newLink.trim().length === 0"
                                    class="form-muted-icon"
                                >+</button>
                            </div>

                        
                        </fieldset>
                        
                    </div>

                    <div class="flex justify-end gap-x-5">
                        <button type="button" class="btn btn-outlined" @click="$dispatch('close-modal')">Cancel</button>
                        <button type="submit" class="btn">Submit</button>
                    </div>
                    
                    
                </div>
               
            </form>
        </x-modal>
    </div>
</x-layout>