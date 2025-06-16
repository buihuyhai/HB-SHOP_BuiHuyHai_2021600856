@extends('Layout::frontend.app')
@section('content')
    <div class="container">
        @include('Product::frontend.components.category.list')
        @include('Product::frontend.components.product.latest')
        <!-- Chat Icon -->
        <div id="chat-icon">
            💬
        </div>

        <!-- Chatbox -->
        <div id="chatbox">
            <div id="chat-header">HB-Shop AI <span id="close-chatbox">✖</span></div>
            <div id="chat-messages"></div>
            <textarea id="user-input" placeholder="Nhập câu hỏi..."></textarea>
            <button id="send-btn">Gửi</button>
        </div>
    </div>
@endsection
@push('css')
    <style>
        #chat-icon {
            position: fixed;
            bottom: 100px;
            right: 20px;
            background: #007bff;
            color: white;
            padding: 12px 16px;
            border-radius: 50%;
            font-size: 22px;
            cursor: pointer;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        #chatbox {
            display: none;
            position: fixed;
            bottom: 160px;
            right: 20px;
            width: 300px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            padding: 10px;
        }

        #chat-header {
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        #chat-messages {
            max-height: 200px;
            overflow-y: auto;
            font-size: 14px;
            margin-bottom: 10px;
        }

        #user-input {
            width: 100%;
            height: 50px;
            padding: 5px;
            font-size: 14px;
            resize: none;
        }

        #send-btn {
            margin-top: 5px;
            width: 100%;
            padding: 5px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }

        #close-chatbox,#send-btn {
            cursor: pointer;
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('frontend/assets/vendor/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script>
        var $jq = jQuery.noConflict();
        $jq(document).ready(function() {
            $('#chat-icon').click(function() {
                $('#chatbox').toggle();
            });

            $('#close-chatbox').click(function() {
                $('#chatbox').hide();
            });

            $('#send-btn').click(function() {
                sendMessage();
            });

            $('#user-input').keypress(function(e) {
                if (e.which == 13 && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            function sendMessage() {
                const message = $('#user-input').val().trim();
                if (!message) return;

                $('#chat-messages').append(`<div><strong>Bạn:</strong> ${message}</div>`);
                $('#user-input').val('');

                $.ajax({
                    url: '/chat',
                    type: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: JSON.stringify({
                        message: message
                    }),
                    success: function(data) {
                        $('#chat-messages').append(`<div><strong>AI:</strong> ${data.reply}</div>`);
                        $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
                    },
                    error: function() {
                        $('#chat-messages').append(`<div><strong>AI:</strong> Có lỗi xảy ra!</div>`);
                    }
                });


            }
        });
    </script>
@endpush
