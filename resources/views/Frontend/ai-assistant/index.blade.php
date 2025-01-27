@extends('Frontend.layouts.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        /*body {*/
        /*    margin: 0;*/
        /*    padding: 0;*/
        /*    font-family: Arial, sans-serif;*/
        /*    !*background-color: #f7f7f8;*!*/
        /*    color: #333;*/
        /*    display: flex;*/
        /*    flex-direction: column;*/
        /*    height: 100vh;*/
        /*}*/
        #chat-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            padding: 1rem;
        }
        .chat-message {
            margin: 1rem 0;
            display: flex;
            align-items: flex-start;
        }
        .chat-message.user {
            justify-content: flex-end;
        }
        .chat-bubble {
            max-width: 60%;
            padding: 0.8rem 1rem;
            border-radius: 1rem;
            margin: 0.5rem;
            line-height: 1.4;
        }
        .chat-bubble.user {
            background-color: #007bff;
            color: #fff;
            border-radius: 1rem 1rem 0 1rem;
        }
        .chat-bubble.bot {
            background-color: #e9ecef;
            color: #333;
            border-radius: 1rem 1rem 1rem 0;
        }
        #chat-input-container {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /*border-top: 1px solid #ddd;*/
        }
        #chat-input {
            width: 50%;
            height: 80px;
            color: #2f2f2f;
            /*flex: 1;*/
            padding: 0.8rem;
            border: 1px solid #424242;
            border-radius: 1rem;
            outline: none;
            font-size: 1rem;
            resize: none; /* Disables resizing */
            overflow: auto;
        }
        #send-button {
            margin-left: 0.5rem;
            background-color: rgb(255, 255, 255,1);
            color: #424242;
            border: none;
            border-radius: 1rem;
            padding: 0.8rem 1rem;
            cursor: pointer;
            font-size: 1rem;
        }
        #send-button:hover {
            background-color: #d3c1c1;
        }
    </style>

    
{{--    <div class="aboutarea__5 sp_bottom_100 sp_top_100">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xl-12 col-lg-12" data-aos="fade-up">--}}

{{--               --}}
{{--                </div>--}}
{{--                --}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="container">
    <div id="chat-container"></div>
    
    <div id="chat-input-container">

        <div class="d-flex justify-content-center align-items-center text-light">
            <h1>What can I help with?
            </h1>
        </div>
        
        <div class="d-flex justify-content-center align-items-center">
        <textarea id="chat-input" placeholder="Message here" rows="1"></textarea>
        <button id="send-button">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-2xl"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.1918 8.90615C15.6381 8.45983 16.3618 8.45983 16.8081 8.90615L21.9509 14.049C22.3972 14.4953 22.3972 15.2189 21.9509 15.6652C21.5046 16.1116 20.781 16.1116 20.3347 15.6652L17.1428 12.4734V22.2857C17.1428 22.9169 16.6311 23.4286 15.9999 23.4286C15.3688 23.4286 14.8571 22.9169 14.8571 22.2857V12.4734L11.6652 15.6652C11.2189 16.1116 10.4953 16.1116 10.049 15.6652C9.60265 15.2189 9.60265 14.4953 10.049 14.049L15.1918 8.90615Z" fill="currentColor"></path></svg>        
        </button>
        </div>
        
    </div>
    </div>

    <script>
        const chatContainer = document.getElementById('chat-container');
        const chatInput = document.getElementById('chat-input');
        const sendButton = document.getElementById('send-button');

        const appendMessage = (message, sender) => {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('chat-message', sender);
            const bubbleDiv = document.createElement('div');
            bubbleDiv.classList.add('chat-bubble', sender);
            bubbleDiv.textContent = message;
            messageDiv.appendChild(bubbleDiv);
            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight; // Scroll to the bottom
        };

        const sendMessage = async () => {
            const userMessage = chatInput.value.trim();
            if (!userMessage) return;

            appendMessage(userMessage, 'user');
            chatInput.value = '';

            // Mock API call - Replace this with your actual API call
            try {
                const response = await axios.post('/chat', { prompt: userMessage });
                const botMessage = response.data.message; // Adjust based on API response
                appendMessage(botMessage, 'bot');
            } catch (error) {
                appendMessage('Error fetching response. Try again!', 'bot');
                console.error(error);
            }
        };

        sendButton.addEventListener('click', sendMessage);

        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    </script>
    
@endsection