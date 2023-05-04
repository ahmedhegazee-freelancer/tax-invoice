<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">Send Invoices</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.filter_date") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="date"
                            class="form-control w-full"
                            v-model="form.filter_date"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.filter_date"
                        />
                        <FrontErrorMessage :errors="v$.filter_date.$errors" />
                    </div>
                    <div class="">
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.branch") }}</label
                        >
                        <div class="grid grid-cols-3 gap-2">
                            <TomSelect
                                id="crud-form-2"
                                v-model="form.branch"
                                :options="{
                                    create: false,
                                }"
                            >
                                <option value=""></option>
                                <option
                                    v-for="(branch, index) in props.branches"
                                    :key="index"
                                    :value="branch.id"
                                >
                                    {{ branch.name }}
                                </option>
                            </TomSelect>
                        </div>
                        <InputError
                            class="mt-2"
                            :message="form.errors.branch"
                        />
                        <FrontErrorMessage :errors="v$.branch.$errors" />
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
                        <!-- <InputError
                            class="mt-2"
                            :message="form.errors.is_prod"
                        /> -->
                        <!-- <FrontErrorMessage :errors="v$.is_prod.$errors" /> -->
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
import { computed, ref } from "@vue/reactivity";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, maxLength, helpers } from "@vuelidate/validators";
const { t } = useI18n(); // use as global scope
const dropzoneValidationRef = ref(null);
const form = useForm({
    filter_date: "",
    branch: "",
    is_prod: false,
});
const props = defineProps({
    branches: {
        type: Array,
        required: true,
    },
});
const rules = computed(() => ({
    branch: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "branch" }),
            required
        ),
    },
    filter_date: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "filter_date" }),
            required
        ),
    },
}));
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.invoices.send.store"), {
        onSuccess: () => {
            form.reset();
            // Inertia.visit(
            //     route("dashboard.invoices.upload.store", {
            //         branch: props.branch.id,
            //     })
            // );
        },
    });
};
</script>
<style scoped></style>
