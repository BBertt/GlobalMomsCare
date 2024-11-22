<div id="chat-container" class="fixed bottom-4 right-4 w-72 bg-white shadow-lg rounded-lg overflow-hidden z-50 transition-transform transform">

    <div id="chat-header" class="bg-red-500 text-white p-3 flex justify-between items-center cursor-pointer">
        <span class="font-bold">Chat</span>
        <button id="chat-minimize" class="text-white hover:text-gray-200">
            <i id="toggle-icon" class="fas fa-plus"></i>
        </button>
    </div>


    <div id="chat-body" class="p-4 hidden">
        <div id="chat-list" class="mb-4">
            <div class="text-gray-700 font-bold mb-2">Recent Chats</div>
            <ul>
                <!-- Example chat -->
                <li class="mb-2 p-2 bg-gray-100 rounded cursor-pointer hover:bg-gray-200">
                    <span class="font-bold">User Name</span>
                    <span class="text-gray-500 text-sm">- Last message preview...</span>
                </li>
                <!-- Add dynamic chats here -->
            </ul>
        </div>

        <form method="POST" action="{{ route('chat.store') }}" class="flex items-center space-x-2">
            @csrf
            <input type="text" name="message" id="message" placeholder="Type your message..." class="w-full p-2 border rounded">
            <button type="submit" class="bg-red-500 text-white p-2 rounded">Send</button>
        </form>
    </div>
</div>
