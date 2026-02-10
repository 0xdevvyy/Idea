<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IDEA</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground">
    <x-layout.nav />
    <main class="max-w-7xl mx-auto px-6">
        {{ $slot }}
    </main>
    
   @session('success')
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition.opacity.duration.300ms
        x-cloak
        class="bg-primary text-white px-4 absolute bottom-4 right-4 rounded-lg"
    >
        testing
    </div>
    @endsession

        

</body>
</html>