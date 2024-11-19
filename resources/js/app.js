document.addEventListener("DOMContentLoaded", function () {
    const chatContainer = document.getElementById("chat-container");
    const chatHeader = document.getElementById("chat-header");
    const chatBody = document.getElementById("chat-body");
    const toggleIcon = document.getElementById("toggle-icon");

    chatHeader.addEventListener("click", function () {
        if (chatBody.classList.contains("hidden")) {
            chatBody.classList.remove("hidden");
            toggleIcon.classList.replace("fa-minus", "fa-times");
        } else {
            chatBody.classList.add("hidden");
            toggleIcon.classList.replace("fa-times", "fa-minus");
        }
    });
});
