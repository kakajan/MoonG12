<template>
  <q-page class="flex flex-center">
    <div v-if="userData">
      {{ userData.phone.number }}
    </div>
    <q-btn
      class="full-width"
      color="blue"
      rounded
      label="Register"
      @click="$router.push('/register')"
    />
  </q-page>
</template>

<script>
import { api } from "src/boot/axios";
import { defineComponent, reactive, toRefs } from "vue";

export default defineComponent({
  name: "IndexPage",
  setup() {
    const props = reactive({
      userData: null,
    });
    function fetchMe() {
      api.get("api/user").then((r) => {
        props.userData = r.data;
      });
    }
    fetchMe();
    return {
      ...toRefs(props),
    };
  },
});
</script>
