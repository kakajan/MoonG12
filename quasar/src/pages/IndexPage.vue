<template>
  <q-page padding>
    <div v-if="messages.length > 0">
      <div v-for="(message,index) in messages" :key="'message-'+index">
      {{ message.fullName }}|{{ message.mobile }}<br>
      {{ message.message }}<br>
      <hr>
      </div>
    </div>
  </q-page>
</template>

<script>
import axios from "axios";
import { defineComponent, ref } from "vue";
export default defineComponent({
  name: "IndexPage",
  setup() {
    const messages = ref([]);
    function fetchMessages() {
      axios.get("http://localhost:8000/api/messages").then((r) => {
        console.log(r.data);
         messages.value = r.data;
      });
    }
    fetchMessages();
    return {
      messages,
    };
  },
});
</script>
