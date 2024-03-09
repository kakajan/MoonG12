<template>
  <div>
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
          @click="$emit('like')"
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
</template>

<script>
export default {
  // name: 'ComponentName',
   props: ['post'],
  setup(props) {
    return {
      props
    };
  },
};
</script>
