<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
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
<style>
.panel-heading {
    margin: 10px 0px;
    font-size: 24px;
}
</style>
<script setup>
import { ref } from 'vue';
import { onMounted } from 'vue';
import { useUserStore } from "../stores/userStore"
import { apiGetUserInfo } from "../apis/instances/user"
import { apiGetMessages, apiCreateMessage } from "../apis/instances/message"

const messages = ref([]);

const userStore = useUserStore();

const fetchUserInfo = () => {
    apiGetUserInfo().then(response => {
        userStore.updateUserInfo(response.data);
    });
};

const fetchMessages = () => {
    apiGetMessages().then(response => {
        messages.value = response.data.data.messages;
    });
};

const addMessage = (request) => {
    apiCreateMessage(request).then(response => {
        messages.value.push(response.data.data.message);
    });
};

onMounted(() => {
    fetchUserInfo();
    fetchMessages();

    Echo.private('chat_room').listen('MessageSentEvent', (e) => {
        messages.value.push(e);
    });
});

</script>