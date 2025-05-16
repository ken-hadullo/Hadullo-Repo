@if(session('success'))
    <div id="successMessage" class="mb-4 flex items-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl shadow transition-opacity duration-1000 ease-in-out">
        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"/>
        </svg>
        <span>{{ session('success') }}</span>
    </div>

    <script>
        // Fade out after 3 seconds
        setTimeout(() => {
            const successMsg = document.getElementById('successMessage');
            if (successMsg) {
                successMsg.classList.add('opacity-0');
                setTimeout(() => successMsg.remove(), 1000); // Remove from DOM after fade
            }
        }, 3000);
    </script>
@endif

