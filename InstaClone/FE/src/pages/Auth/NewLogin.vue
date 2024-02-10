<template>
  <q-page padding>
    <!-- content -->
    <div class="row q-col-gutter-md">
      <div class="col-12">
        <q-input prefix="+98" v-model="mobile" type="mobile" />
      </div>
      <div class="col-12">
        <q-btn class="full-width" rounded color="blue" unelevated @click="login" label="Start" />
      </div>
    </div>
  </q-page>
</template>

<script>
import { reactive, toRefs } from "vue";
import { api } from "src/boot/axios";
import { useRouter } from "vue-router";
import { useQuasar } from "quasar";
export default {
  // name: 'PageName',
  setup() {
    const router = useRouter();
    const $q = useQuasar();
    const props = reactive({
      mobile: null,
      password: null,
    });
    function login() {
      api
        .post("api/verify", {
          mobile: props.mobile,
        })
        .then((r) => {
          if (r.data.status) {
            router.push("/confirm/"+ props.mobile);
          } else {
            $q.notify({
              message: "Error!",
              color: "negative",
              position: "top",
            });
          }
        });
    }
    // function login() {
    //   api
    //     .post("oauth/token", {
    //       username: props.mobile,
    //       password: props.password,
    //       grant_type: "password",
    //       client_id: 2,
    //       client_secret: "yNjClkUDgbzJsaBpKteFBZyD7TunhSPy5hEzTjJF",
    //     })
    //     .then((r) => {
    //       if (r.data.access_token) {
    //         $q.notify({
    //           message: "Welcome!",
    //           color: "positive",
    //           position: "top",
    //         });
    //         $q.cookies.set("access_token", r.data.access_token);
    //         $q.cookies.set("refresh_token", r.data.refresh_token);
    //         $q.cookies.set("expires_in", r.data.expires_in);
    //         api.defaults.headers.common = {
    //           Authorization: "Bearer " + r.data.access_token,
    //           "Content-Type": "application/json",
    //           Accept: "application/json;charset=UTF-8",
    //         };
    //         router.push("/");
    //       } else {
    //         $q.notify({
    //           message: "Try again",
    //           color: "negative",
    //         });
    //       }
    //     })
    //     .catch((e) => {
    //       $q.notify({
    //         message: e.response.data.message,
    //         color: "negative",
    //       });
    //     });
    // }
    return {
      ...toRefs(props),
      login,
    };
  },
};
</script>
