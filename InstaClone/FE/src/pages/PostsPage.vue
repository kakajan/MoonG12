<template>
  <q-page padding>
    <!-- content -->
    <div class="q-gutter-y-lg" v-if="posts.length>0">
      <q-btn icon="add" @click="$router.push('/addPost')" label="Add Your New Post" class="full-width" color="pink" rounded />
      <q-card v-for="(post , index) in posts" :key="'my-post'+index" dark bordered class="bg-grey-9 my-card">
      <q-card-section>
        <div class="text-subtitle2">{{ post.title }}</div>
      </q-card-section>

      <q-separator dark inset />

      <q-card-section>
        {{ post.description }}
      </q-card-section>
    </q-card>
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
