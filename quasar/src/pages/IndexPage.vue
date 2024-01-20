<template>
  <q-page padding class="q-gutter-y-md">
    <q-btn push icon="download" unelevated color="light-green-8" class="q-px-xl myBtn" label="Download" rounded />
    <q-input prefix="+98" rounded outlined label="mobile" />
  </q-page>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'IndexPage'
})
</script>
