<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{
                    t("admin.add") + " " + t("validation.attributes.credential")
                }}
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{
                                t("validation.attributes.device_serial_number")
                            }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            class="form-control w-full"
                            v-model="form.device_serial_number"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.device_serial_number"
                        />
                        <FrontErrorMessage
                            :errors="v$.device_serial_number.$errors"
                        />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.client_id") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            v-model="form.client_id"
                            class="form-control w-full"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.client_id"
                        />
                        <FrontErrorMessage :errors="v$.client_id.$errors" />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{
                                t("validation.attributes.client_secret")
                            }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            v-model="form.client_secret"
                            class="form-control w-full"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.client_secret"
                        />
                        <FrontErrorMessage :errors="v$.client_secret.$errors" />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{
                                t("validation.attributes.pos_os_version")
                            }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            v-model="form.pos_os_version"
                            class="form-control w-full"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.pos_os_version"
                        />
                        <FrontErrorMessage
                            :errors="v$.pos_os_version.$errors"
                        />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.is_prod") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="checkbox"
                            v-model="form.is_prod"
                            class="form-control w-full"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.is_prod"
                        />
                        <FrontErrorMessage :errors="v$.is_prod.$errors" />
                    </div>

                    <div class="text-right mt-5">
                        <button
                            type="button"
                            class="btn btn-primary w-24"
                            @click="submitForm()"
                        >
                            {{ t("admin.add") }}
                        </button>
                    </div>
                </div>
                <!-- END: Form Layout -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { useI18n } from "vue-i18n";
import { computed, mergeProps, ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, maxLength, helpers } from "@vuelidate/validators";
import { Inertia } from "@inertiajs/inertia";
const { t } = useI18n(); // use as global scope
const dropzoneValidationRef = ref(null);
const form = useForm({
    device_serial_number: "",
    client_id: "",
    client_secret: "",
    pos_os_version: "",
    is_prod: false,
});
const props = defineProps({
    branch: {
        type: Object,
        required: true,
    },
});
const rules = computed(() => ({
    device_serial_number: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "device_serial_number" }),
            required
        ),
    },
    client_id: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "client_id" }),
            required
        ),
    },
    client_secret: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "client_secret" }),
            required
        ),
    },
    pos_os_version: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "pos_os_version" }),
            required
        ),
    },
    is_prod: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "is_prod" }),
            required
        ),
    },
}));
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(
        route("dashboard.credential.store", { branch: props.branch.id }),
        {
            onSuccess: () => {
                Inertia.visit(
                    route("dashboard.credential.index", {
                        branch: props.branch.id,
                    })
                );
            },
        }
    );
};
</script>
<style scoped></style>
