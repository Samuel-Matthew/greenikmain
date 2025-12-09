
  
        function toggleChat() {
            const chatWidget = document.getElementById('chat-widget');
            const chatButton = document.querySelector('.chat-widget').parentElement;

            if (chatWidget.classList.contains('hidden')) {
                chatWidget.classList.remove('hidden');
                chatButton.style.display = 'none';
            } else {
                chatWidget.classList.add('hidden');
                chatButton.style.display = 'block';
            }
        }
 