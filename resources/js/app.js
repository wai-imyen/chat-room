/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import ChatMessages from './components/ChatMessages.vue';
import ChatForm from './components/ChatForm.vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({
    data() {
        return {
            messages: []
        };
    },
    created() {
        this.fetchMessages();
        Echo.private('chat_room').listen('MessageSentEvent', (e) => {
            this.messages.push(e);
        });
    },
    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data.data.messages;
            });
        },
        addMessage(message) {
            axios.post('/messages', message).then(response => {
                console.log(response.data);
                this.messages.push(response.data.data.message);
            });
        }
    }
});

app.component('chat-messages', ChatMessages);
app.component('chat-form', ChatForm);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
