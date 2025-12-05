<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/mixandmatch.css') }}">
  <title>Mix and Match - Rifold</title>
</head>

<body class="bg-white">

  {{-- Navbar --}}
  @include('components.navbar')

  {{-- Judul --}}
  <main class="max-w-6xl mx-auto px-4 mb-16 mt-8">
    <h1 class="text-3xl font-semibold text-center mb-10 text-gray-800">Mix and Match</h1>

    {{-- Masonry layout --}}
    <div class="masonry columns-1 sm:columns-2 md:columns-3 gap-6 [column-fill:_balance]">
       @foreach ($mixAndMatches as $mix)

    @php
      $images = json_decode($mix->images_path);
      $thumbnail = $images[0] ?? null;
    @endphp

    <a
      href="{{ route('mixandmatch.detail', $mix->id) }}"
      class="mix-card mb-6 break-inside-avoid block overflow-hidden rounded-2xl bg-white shadow-md hover:shadow-xl transition-all duration-300 ease-out"
    >

      @if($thumbnail)
        <img
          src="{{ asset('storage/' . $thumbnail) }}"
          alt="{{ $mix->name }}"
          class="mix-image w-full h-auto"
        >
      @endif

    </a>

  @endforeach
    </div>
  </main>

  {{-- Footer --}}
  @include('components.footer')

</body>
</html>
