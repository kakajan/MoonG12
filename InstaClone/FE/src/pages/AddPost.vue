<template>
  <q-page padding>
    <!-- content -->
    <div class="row q-col-gutter-md">
      <div class="col-12">
        <q-input v-model="title" label="Post Title" />
      </div>
      <div class="col-12">
        <q-input v-model="description" type="textarea" autogrow label="Post Description" />
      </div>
      <div class="col-12">
        <q-btn @click="sendPost" icon="send" class="full-width" color="light-blue" rounded label="Save" />
      </div>
    </div>
  </q-page>
</template>

<script>
import { reactive, toRefs } from 'vue'
import { api } from 'src/boot/axios'
import { useRouter } from 'vue-router'
export default {
  // name: 'PageName',
  setup () {
    const router = useRouter();
    const props = reactive({
      title: null,
      description: null
    })
    function sendPost () {
      api.post('api/posts', {
        title: props.title,
        description: props.description
      }).then(r => {
        if (r.data.status) {
          router.push('/posts')
        }
      })
        .catch(e => {

      })
    }
    return {
      ...toRefs(props),
      sendPost
    }
  }
}
</script>
