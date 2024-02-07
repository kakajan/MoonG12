<template>
  <q-page padding>
    <!-- content -->
    <div class="row">
      <div class="col-12">
        <q-input label="name" type="text" v-model="name" />
      </div>
      <div class="col-12">
        <q-input label="email" type="email" v-model="email" />
      </div>
      <div class="col-12">
        <q-input label="password" type="password" v-model="password" />
      </div>
      <div class="col-12">
        <q-btn
          @click="register"
          class="full-width"
          color="light-green-7"
          label="Register"
        />
      </div>
    </div>
  </q-page>
</template>

<script>
import { reactive, toRefs } from "vue";
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";
import { useRouter } from 'vue-router';

export default {
  // name: 'PageName',
  setup() {
    const $q = useQuasar();
    const router = useRouter();
    const props = reactive({
      email: null,
      name: null,
      password: null,
    });
    function register() {
      api
        .post("api/register", {
          name: props.name,
          email: props.email,
          password: props.password,
        })
        .then((r) => {
          if (r.data.status) {
            $q.notify({
              message: "Successfully Registered!",
              color: "positive",
            });
            router.push('login')
          } else {
            $q.notify({
              message: "Try again",
              color: "negative",
            });
          }
        })
        .catch((e) => {
          console.log(e);
          $q.notify({
            message: "Try again",
            color: "negative",
          });
        });
    }
    return {
      ...toRefs(props),
      register,
    };
  },
};
</script>
