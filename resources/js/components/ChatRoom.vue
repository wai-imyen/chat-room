<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">聊天室</div>

                    <div class="panel-body">
                        <chat-messages :messages="messages"></chat-messages>
                    </div>
                    <div class="panel-footer">
                        <chat-form @send-message="addMessage"></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { onMounted } from 'vue';

const messages = ref([]);

const fetchMessages = () => {
    axios.get('/messages').then(response => {
    messages.value = response.data.data.messages;
    });
};

const addMessage = (message) => {
    axios.post('/messages', message).then(response => {
    console.log(response.data);
    messages.value.push(response.data.data.message);
    });
};

onMounted(() => {
    fetchMessages();
    Echo.private('chat_room').listen('MessageSentEvent', (e) => {
    messages.value.push(e);
    });
});

</script>