<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("admin.add") + " " + t("validation.attributes.branch") }}
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.name") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            class="form-control w-full"
                            v-model="form.name"
                            placeholder="Name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                        <FrontErrorMessage :errors="v$.name.$errors" />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.branch_code") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            v-model="form.branch_code"
                            class="form-control w-full"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.branch_code"
                        />
                        <FrontErrorMessage :errors="v$.branch_code.$errors" />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{
                                t("validation.attributes.activity_code")
                            }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            v-model="form.activity_code"
                            class="form-control w-full"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.activity_code"
                        />
                        <FrontErrorMessage :errors="v$.activity_code.$errors" />
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
import { computed, ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, maxLength, helpers } from "@vuelidate/validators";
import { Inertia } from "@inertiajs/inertia";
const { t } = useI18n(); // use as global scope
const dropzoneValidationRef = ref(null);
const form = useForm({
    name: "",
    branch_code: "",
    activity_code: "",
});

const rules = computed(() => ({
    name: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "name" }),
            required
        ),
    },
    branch_code: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "branch_code" }),
            required
        ),
    },
    activity_code: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "activity_code" }),
            required
        ),
    },
}));
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.branch.store"), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.branch.index"));
        },
    });
};
</script>
<style scoped></style>
