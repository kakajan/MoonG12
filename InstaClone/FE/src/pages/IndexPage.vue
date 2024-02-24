<template>
  <q-page padding>
    <div class="row q-col-gutter-sm">
      <div
        v-for="(post, index) in posts"
        :key="'my-post' + index"
        class="col-xs-12 col-md-4 col-lg-3"
      >
        <q-card dark bordered class="bg-grey-9 my-card">
          <q-item>
            <q-item-section avatar>
              <q-avatar>
                <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
              </q-avatar>
            </q-item-section>

            <q-item-section>
              <q-item-label>{{ post.user.name }}</q-item-label>
              <q-item-label class="text-white" caption> {{ post.user.mobile }} </q-item-label>
            </q-item-section>
          </q-item>
          <q-card-section>
            <div class="text-subtitle2">{{ post.title }}</div>
          </q-card-section>

          <q-separator dark inset />

          <q-card-section>
            {{ post.description }}
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import { api } from "src/boot/axios";
import { useAppDataStore } from "src/stores/appData";
import { defineComponent, reactive, toRefs } from "vue";

export default defineComponent({
  name: "IndexPage",
  setup() {
    const appData = useAppDataStore();
    const props = reactive({
      posts: [],
    });
    function fetchMe() {
      api.get("api/user").then((r) => {
        props.userData = r.data;
        appData.userDetail = r.data;
      });
    }
    fetchMe();
    function fetchPosts() {
      api.get("api/posts").then((r) => {
        props.posts = r.data;
      });
    }
    fetchPosts();
    return {
      ...toRefs(props),
      appData,
    };
  },
});
</script>
