<header class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold" style="color:black">ICP Student Management</h1>
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-black px-4 py-2 rounded" >Logout</button>
            </form>
        @endauth
    </div>
</header>