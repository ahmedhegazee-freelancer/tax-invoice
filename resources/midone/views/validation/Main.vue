<template>
  <div class="flex items-center mt-8 intro-y">
    <h2 class="mr-auto text-lg font-medium">Form Validation</h2>
  </div>
  <div class="grid grid-cols-12 gap-6 mt-5">
    <div class="col-span-12 intro-y lg:col-span-6">
      <!-- BEGIN: Form Validation -->
      <PreviewComponent class="intro-y box" v-slot="{ toggle }">
        <div
          class="flex flex-col items-center p-5 border-b sm:flex-row border-slate-200/60 dark:border-darkmode-400"
        >
          <h2 class="mr-auto text-base font-medium">Implementation</h2>
          <div
            class="w-full mt-3 form-check form-switch sm:w-auto sm:ml-auto sm:mt-0"
          >
            <label class="ml-0 form-check-label" for="show-example-1"
              >Show example code</label
            >
            <input
              @click="toggle"
              class="ml-3 mr-0 form-check-input"
              type="checkbox"
            />
          </div>
        </div>
        <div class="p-5">
          <Preview>
            <!-- BEGIN: Validation Form -->
            <form class="validate-form" @submit.prevent="save">
              <div class="input-form">
                <label
                  for="validation-form-1"
                  class="flex flex-col w-full form-label sm:flex-row"
                >
                  Name
                  <span class="mt-1 text-xs sm:ml-auto sm:mt-0 text-slate-500"
                    >Required, at least 2 characters</span
                  >
                </label>
                <input
                  id="validation-form-1"
                  v-model.trim="validate.name.$model"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{ 'border-danger': validate.name.$error }"
                  placeholder="John Legend"
                />
                <template v-if="validate.name.$error">
                  <div
                    v-for="(error, index) in validate.name.$errors"
                    :key="index"
                    class="mt-2 text-danger"
                  >
                    {{ error.$message }}
                  </div>
                </template>
              </div>
              <div class="mt-3 input-form">
                <label
                  for="validation-form-2"
                  class="flex flex-col w-full form-label sm:flex-row"
                >
                  Email
                  <span class="mt-1 text-xs sm:ml-auto sm:mt-0 text-slate-500"
                    >Required, email address format</span
                  >
                </label>
                <input
                  id="validation-form-2"
                  v-model.trim="validate.email.$model"
                  type="email"
                  name="email"
                  class="form-control"
                  :class="{ 'border-danger': validate.email.$error }"
                  placeholder="example@gmail.com"
                />
                <template v-if="validate.email.$error">
                  <div
                    v-for="(error, index) in validate.email.$errors"
                    :key="index"
                    class="mt-2 text-danger"
                  >
                    {{ error.$message }}
                  </div>
                </template>
              </div>
              <div class="mt-3 input-form">
                <label
                  for="validation-form-3"
                  class="flex flex-col w-full form-label sm:flex-row"
                >
                  Password
                  <span class="mt-1 text-xs sm:ml-auto sm:mt-0 text-slate-500"
                    >Required, at least 6 characters</span
                  >
                </label>
                <input
                  id="validation-form-3"
                  v-model.trim="validate.password.$model"
                  type="password"
                  name="password"
                  class="form-control"
                  :class="{ 'border-danger': validate.password.$error }"
                  placeholder="secret"
                />
                <template v-if="validate.password.$error">
                  <div
                    v-for="(error, index) in validate.password.$errors"
                    :key="index"
                    class="mt-2 text-danger"
                  >
                    {{ error.$message }}
                  </div>
                </template>
              </div>
              <div class="mt-3 input-form">
                <label
                  for="validation-form-4"
                  class="flex flex-col w-full form-label sm:flex-row"
                >
                  Age
                  <span class="mt-1 text-xs sm:ml-auto sm:mt-0 text-slate-500"
                    >Required, integer only & maximum 3 characters</span
                  >
                </label>
                <input
                  id="validation-form-4"
                  v-model.trim="validate.age.$model"
                  type="number"
                  name="age"
                  class="form-control"
                  :class="{ 'border-danger': validate.age.$error }"
                  placeholder="21"
                />
                <template v-if="validate.age.$error">
                  <div
                    v-for="(error, index) in validate.age.$errors"
                    :key="index"
                    class="mt-2 text-danger"
                  >
                    {{ error.$message }}
                  </div>
                </template>
              </div>
              <div class="mt-3 input-form">
                <label
                  for="validation-form-5"
                  class="flex flex-col w-full form-label sm:flex-row"
                >
                  Profile URL
                  <span class="mt-1 text-xs sm:ml-auto sm:mt-0 text-slate-500"
                    >Optional, URL format</span
                  >
                </label>
                <input
                  id="validation-form-5"
                  v-model.trim="validate.url.$model"
                  type="url"
                  name="url"
                  class="form-control"
                  :class="{ 'border-danger': validate.url.$error }"
                  placeholder="https://google.com"
                />
                <template v-if="validate.url.$error">
                  <div
                    v-for="(error, index) in validate.url.$errors"
                    :key="index"
                    class="mt-2 text-danger"
                  >
                    {{ error.$message }}
                  </div>
                </template>
              </div>
              <div class="mt-3 input-form">
                <label
                  for="validation-form-6"
                  class="flex flex-col w-full form-label sm:flex-row"
                >
                  Comment
                  <span class="mt-1 text-xs sm:ml-auto sm:mt-0 text-slate-500"
                    >Required, at least 10 characters</span
                  >
                </label>
                <textarea
                  id="validation-form-6"
                  v-model.trim="validate.comment.$model"
                  class="form-control"
                  :class="{ 'border-danger': validate.comment.$error }"
                  name="comment"
                  placeholder="Type your comments"
                ></textarea>
                <template v-if="validate.comment.$error">
                  <div
                    v-for="(error, index) in validate.comment.$errors"
                    :key="index"
                    class="mt-2 text-danger"
                  >
                    {{ error.$message }}
                  </div>
                </template>
              </div>
              <button type="submit" class="mt-5 btn btn-primary">
                Register
              </button>
            </form>
            <!-- END: Validation Form -->
            <!-- BEGIN: Success Notification Content -->
            <div
              id="success-notification-content"
              class="flex hidden toastify-content"
            >
              <CheckCircleIcon class="text-success" />
              <div class="ml-4 mr-4">
                <div class="font-medium">Registration success!</div>
                <div class="mt-1 text-slate-500">
                  Please check your e-mail for further info!
                </div>
              </div>
            </div>
            <!-- END: Success Notification Content -->
            <!-- BEGIN: Failed Notification Content -->
            <div
              id="failed-notification-content"
              class="flex hidden toastify-content"
            >
              <XCircleIcon class="text-danger" />
              <div class="ml-4 mr-4">
                <div class="font-medium">Registration failed!</div>
                <div class="mt-1 text-slate-500">
                  Please check the fileld form.
                </div>
              </div>
            </div>
            <!-- END: Failed Notification Content -->
          </Preview>
          <Source>
            <Highlight type="javascript">
              {{
                `
                    const formData = reactive({
                      name: "",
                      email: "",
                      password: "",
                      age: "",
                      url: "",
                      comment: ""
                    });
                    const rules = {
                      name: {
                        required,
                        minLength: minLength(2)
                      },
                      email: {
                        required,
                        email
                      },
                      password: {
                        required,
                        minLength: minLength(6)
                      },
                      age: {
                        required,
                        integer,
                        maxLength: maxLength(3)
                      },
                      url: {
                        url
                      },
                      comment: {
                        required,
                        minLength: minLength(10)
                      }
                    };
                    const validate = useVuelidate(rules, toRefs(formData));
                    const save = () => {
                      validate.value.$touch();
                      if (validate.value.$invalid) {
                        Toastify({
                          node: dom("#failed-notification-content")
                            .clone()
                            .removeClass("hidden")[0],
                          duration: 3000,
                          newWindow: true,
                          close: true,
                          gravity: "top",
                          position: "right",
                          stopOnFocus: true,
                        }).showToast();
                      } else {
                        Toastify({
                          node: dom("#success-notification-content")
                            .clone()
                            .removeClass("hidden")[0],
                          duration: 3000,
                          newWindow: true,
                          close: true,
                          gravity: "top",
                          position: "right",
                          stopOnFocus: true,
                        }).showToast();
                      }
                    };
                  `
              }}
            </Highlight>
          </Source>
        </div>
      </PreviewComponent>
      <!-- END: Form Validation -->
    </div>
  </div>
</template>

<script setup>
import { reactive, toRefs } from "vue";
import {
  required,
  minLength,
  maxLength,
  email,
  url,
  integer,
} from "@vuelidate/validators";
import { useVuelidate } from "@vuelidate/core";
import Toastify from "toastify-js";
import dom from "@left4code/tw-starter/dist/js/dom";

const formData = reactive({
  name: "",
  email: "",
  password: "",
  age: "",
  url: "",
  comment: "",
});

const rules = {
  name: {
    required,
    minLength: minLength(2),
  },
  email: {
    required,
    email,
  },
  password: {
    required,
    minLength: minLength(6),
  },
  age: {
    required,
    integer,
    maxLength: maxLength(3),
  },
  url: {
    url,
  },
  comment: {
    required,
    minLength: minLength(10),
  },
};

const validate = useVuelidate(rules, toRefs(formData));

const save = () => {
  validate.value.$touch();
  if (validate.value.$invalid) {
    Toastify({
      node: dom("#failed-notification-content")
        .clone()
        .removeClass("hidden")[0],
      duration: 3000,
      newWindow: true,
      close: true,
      gravity: "top",
      position: "right",
      stopOnFocus: true,
    }).showToast();
  } else {
    Toastify({
      node: dom("#success-notification-content")
        .clone()
        .removeClass("hidden")[0],
      duration: 3000,
      newWindow: true,
      close: true,
      gravity: "top",
      position: "right",
      stopOnFocus: true,
    }).showToast();
  }
};
</script>
