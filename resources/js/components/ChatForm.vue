<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="請輸入訊息..." v-model="newMessage" @keyup.enter="sendMessage">

        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">發送</button>
        </span>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { defineProps } from "vue";

const props = defineProps({
    messages: Object,
})
const newMessage = ref('');
const emits = defineEmits(["send-message"]);

const sendMessage = () => {
    emits("send-message", {
        user: props.user,
        message: newMessage.value,
    });
    newMessage.value = '';
};
</script>
