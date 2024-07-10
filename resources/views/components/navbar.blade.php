<nav class="h-12 flex flex-wrap justify-between content-center p-4">
    <div class="button-cotainer">
        <button id="sidebarToggle" class="border border-gray-500 p-2 rounded-md">
            <svg class="w-[16px] h-[16px] text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="flex  ">
            <span class="mr-2 font-medium text-gray-400">Logout</span>
            <svg class="w-5 h-5  text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 16 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9"
                    d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3" />
            </svg>
        </button>
    </form>
</nav>
