<template>
  <q-page class="flex flex-center">
    
  </q-page>
</template>

<script>
import { api } from "src/boot/axios";
import { useAppDataStore } from "src/stores/appData";
import { defineComponent, reactive, toRefs } from "vue";

export default defineComponent({
  name: "IndexPage",
  setup () {
    const appData = useAppDataStore();
    const props = reactive({
      userData: null,
    });
    function fetchMe() {
      api.get("api/user").then((r) => {
        props.userData = r.data;
        appData.userDetail = r.data
      });
    }
    fetchMe();
    return {
      ...toRefs(props),
      appData
    };
  },
});
</script>
