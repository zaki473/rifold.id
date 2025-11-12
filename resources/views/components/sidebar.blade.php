    {{-- Sidebar --}}
    <aside class="w-64 bg-white h-screen p-4 flex flex-col fixed">
        <div class="mb-8">
            <h1 class="text-2xl font-bold">RIFOLD</h1>
            <h2 class="text-xl">Dashboard Admin</h2>
        </div>
        <nav class="flex-grow">
            <ul>
                <li class="mb-2"><a href="{{ route('admin') }}" class="block p-3 rounded active">Products</a></li>
                <li class="mb-2"><a href="{{ route('add_products') }}" class="block p-3 rounded active">Add Products</a></li>
                <li class="mb-2"><a href="{{ route('add_images') }}" class="block p-3 rounded active">Add Images home</a></li>
                <li class="mb-2"><a href="{{ route('add_video') }}" class="block p-3 rounded active">Add video home</a></li>
                <li class="mb-2"><a href="{{ route('add_images') }}" class="block p-3 rounded active">Status</a></li>{{-- belom --}}
                <li class="mb-2"><a href="{{ route('add_mixandmatch') }}" class="block p-3 rounded active">Add images mix and match</a></li>
            </ul>
        </nav>
    </aside>
