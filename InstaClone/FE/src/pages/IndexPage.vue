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
              <q-item-label class="text-white" caption>
                {{ post.user.mobile }}
              </q-item-label>
            </q-item-section>
          </q-item>
          <q-card-section>
            <div class="text-subtitle2">{{ post.title }}</div>
          </q-card-section>

          <q-separator dark inset />

          <q-card-section>
            {{ post.description }}
          </q-card-section>
          <q-separator dark />
          <q-card-actions>
            <q-btn
              @click="toggleLike(post.id, index)"
              flat
              unelevated
              :label="post.likes.length"
            >
              <q-icon
                :name="post.liked ? 'favorite' : 'favorite_outline'"
                :color="post.liked ? 'red' : 'grey-2'"
              />
            </q-btn>
            <q-btn
              flat
              unelevated
              icon="visibility"
              :label="Math.floor(Math.random() * 1000)"
            />
          </q-card-actions>
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
    function toggleLike(postId, index) {
      api
        .post("api/like", {
          postId: postId,
        })
        .then((r) => {
          if (r.data.status) {
            props.posts[index].liked = r.data.likeStat;
            if (r.data.likeStat) {
              props.posts[index].likes.push(r.data.like);
            } else {
              let myLikeIndex;
              props.posts[index].likes.forEach((val, index) => {
                if (val.user_id == 1) {
                  myLikeIndex = index;
                } else {
                  myLikeIndex = null;
                }
              });
              console.log(myLikeIndex);
              if (myLikeIndex !== null) {
                props.posts[index].likes.splice(myLikeIndex, 1);
              }
            }
          }
        });
    }
    return {
      ...toRefs(props),
      appData,
      toggleLike
    };
  },
});
</script>
