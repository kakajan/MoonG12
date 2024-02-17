<template>
  <q-page padding>
    <!-- content -->
    <div v-if="posts.length>0">

    </div>
    <div v-else>
      <q-btn icon="add" @click="$router.push('/addPost')" label="Post Your First Post" class="full-width" color="pink" rounded />
    </div>
  </q-page>
</template>

<script>
import { reactive, toRefs } from 'vue'
import { api } from 'src/boot/axios'
export default {
  // name: 'PageName',
  setup () {
    const props = reactive({
      posts: []
    })
    function fetchMyPosts () {
      api.get('api/my-posts').then(r => {
        props.posts = r.data.myPosts
      })
    }
    fetchMyPosts();
    return {
      ...toRefs(props)
    }
  }
}
</script>
