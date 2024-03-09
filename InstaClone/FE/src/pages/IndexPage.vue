<template>
  <q-page padding>
    <div class="row q-col-gutter-sm">
      <div
        v-for="(post, index) in posts"
        :key="'my-post' + index"
        class="col-xs-12 col-md-4 col-lg-3"
      >
        <post-card @like="toggleLike(post.id,index)" :post="post"/>
      </div>
    </div>
  </q-page>
</template>

<script>
import { api } from "src/boot/axios";
import { useAppDataStore } from "src/stores/appData";
import { defineComponent, reactive, toRefs } from "vue";
import PostCard from "src/components/PostCard.vue";
export default defineComponent({
  name: "IndexPage",
  components: {
    PostCard
  },
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
              console.log(props.posts[index].likes);
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
      toggleLike,
    };
  },
});
</script>
