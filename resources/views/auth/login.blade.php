<x-layout>
    <x-form title="Login Your Account" subtitles="Start tracking your idea today.">
        <form action="/login" method="post" class="mt-10 space-y-4">
            @csrf
            {{-- <div class="space-y-2">
                <label for="name" class="label">Name</label>
                <input type="text" name="name" id="name" class="input">
            </div> --}}
            <x-form.field name="email" label="Email"  type="email"/>
            <x-form.field name="password" label="Password" type="password"/>
            <button type="submit" class="btn mt-4 h-10 w-full">Login</button>
        </form>
    </x-form>
</x-layout>