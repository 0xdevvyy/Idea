@props(['idea' => new App\Models\Ideas()])
<x-modal name="{{ $idea->exists ? 'edit-idea' : 'create-idea' }}" title="{{ $idea->exists ? 'Edit an Idea' : 'Create an Idea' }}">
    <form x-data="{
            status : @js(old('status', $idea->status->value)), 
            newLink : '', 
            links: @js(old('links', $idea->links ?? [] )), 
            newStep : '', 
            steps: @js(old('steps', $idea->steps->map->only(['id', 'description', 'completed']))),
            } "
        action="{{ $idea->exists ? route('ideas.edit', $idea) : route('ideas.create') }}" method="POST" >
        @csrf
        @if($idea->exists)
            @method('PATCH')
        @endif

        <div class="space-y-6">
            <x-form.field 
                label="title"
                name="title"
                type="text"
                placeholder="Enter Your Idea Title"
                :value="$idea->title"
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
                :value="$idea->description"
                placeholder="Descripe Your Idea Title"
                autofocus
            />
            @if ($idea->image_path)
                <div class="space-y-2 rounded-lg overflow-hidden object-cover">
                    <img src="{{ asset('storage/'. $idea->image_path) }}" alt="Idea Logo" class="w-full h-auto object-cover">
                </div>
                <button class="w-full btn btn-outlined" id="image-delete">Delete Image</button>
            @endif

            <!--Steps -->
            <div>
                <fieldset class="space-y-3">
                    <legend class="label">steps</legend>


                    <template x-for="(step, index) in steps" :key="index">
                        <div class="flex gap-x-2 items-center">
                            <input :name="`steps[${index}][description]`" x-model="step.description" class="input">
                            <input type="hidden" :name="`steps[${index}][completed]`" x-model="step.completed ? '1' : '0' " class="input">
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
                            @click="
                                steps.push({ description: newStep.trim(), completed: false}); 
                                newStep = ''; "
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
    @if($idea->image_path)
        <form action="{{ route('ideas.image.destroy', $idea) }}" method="POST" id="image-delete">
            @method('DELETE')
        </form>
    @endif
</x-modal>