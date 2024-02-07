<template>
  <q-page class="flex flex-center">
    <q-btn class="full-width" color="blue" rounded label="Register" @click="$router.push('/register')" />
  </q-page>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'IndexPage'
})
</script>
