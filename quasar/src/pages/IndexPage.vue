<template>
  <q-page padding>
    <div class="row q-gutter-md">
      <div class="col-1">
        <q-btn @click="counter>0?counter--:''" round icon="remove" color="pink-9" />
      </div>
      <div class="col">
        <q-input v-model="counter" input-class="text-center" label="counter" />
        {{ counter }}
      </div>
      <div class="col-1">
        <q-btn @click="counter++" round icon="add" color="pink-9" />
      </div>
    </div>
    <q-btn @click="$router.push('/about')" label="About" />
  </q-page>
</template>

<script>
import { defineComponent, onMounted, reactive, toRefs } from "vue";
export default defineComponent({
  name: "IndexPage",
  setup () {
    const props = reactive({
      counter: 0
    })
    onMounted(() => {
    })
    return {
      ...toRefs(props),
    }
  }
});
</script>
