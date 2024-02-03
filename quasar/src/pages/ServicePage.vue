<template>
  <q-page padding>
    <!-- content -->
    <div class="row q-col-gutter-sm">
      <div class="col">
        <q-input label="name" v-model="name" />
      </div>
      <div class="col">
        <q-input label="point" v-model="score" />
      </div>
      <div class="col">
        <q-btn @click="add" class="full-width" icon="add" />
      </div>
    </div>
    <hr />
    <h1>{{ average }}</h1>
  </q-page>
</template>

<script>
import { computed, reactive, ref, toRefs } from "vue";
export default {
  // name: 'PageName',
  setup() {
    const props = reactive({
      name: null,
      score: 0,
      list: [],
    });

    function add () {
      props.list.push({
        name: props.name,
        score: props.score
      })
      props.name = null;
      props.score = 0;
    }
    const average = computed(() => {
      let total = 0;
      props.list.forEach((val) => {
        total += +val.score
      })
      return total / props.list.length;;
    })
    return {
      ...toRefs(props),
      add,
      average
    };
  },
};
</script>
