<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">upload invoices</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
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
                            Tickets</label
                        >
                        <input
                            id="crud-form-1"
                            type="file"
                            class="form-control w-full"
                            @change="form.tickets = $event.target.files[0]"
                            placeholder="Name"
                        />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            Items</label
                        >
                        <input
                            id="crud-form-1"
                            type="file"
                            class="form-control w-full"
                            @change="form.items = $event.target.files[0]"
                            placeholder="Name"
                        />
                        <!-- <InputError class="mt-2" :message="form.errors.items" /> -->
                        <!-- <FrontErrorMessage :errors="v$.items.$errors" /> -->
                    </div>
                    <div class="text-right mt-5">
                        <button
                            type="button"
                            class="btn btn-primary w-24"
                            @click="submitForm()"
                        >
                            Upload
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
import { computed, onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, maxLength, helpers } from "@vuelidate/validators";
import { Inertia } from "@inertiajs/inertia";
const { t } = useI18n(); // use as global scope
const form = useForm({
    tickets: null,
    items: null,
    branch: "",
});
const props = defineProps({
    branches: {
        type: Array,
        required: true,
    },
});
const rules = computed(() => ({
    tickets: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "tickets" }),
            required
        ),
    },
    // items: {
    //     required: helpers.withMessage(
    //         t("validation.required", { attribute: "items" }),
    //         required
    //     ),
    // },
    branch: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "branch" }),
            required
        ),
    },
}));
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.invoices.upload.store"), {
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
