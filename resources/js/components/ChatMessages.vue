<style>
.chat {
    list-style: none;
    margin: 0;
    padding: 0;
    font-size: 16px;
}

.chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li .chat-body p {
    margin: 0;
    color: #777777;
}
.chat li .chat-body .header span {
    margin-left: 10px;
    color: #777777;
    font-size: 12px;
}
</style>
<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.name }}
                    </strong>
                    <span class="text-secondary">{{ message.created_at }}</span>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>
<script setup>
import { defineProps } from "vue";

const props = defineProps({
    messages: Object,
})
</script>