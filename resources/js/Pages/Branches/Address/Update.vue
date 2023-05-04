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
                            {{ t("validation.attributes.key") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            class="form-control w-full"
                            disabled
                            v-model="form.key"
                            placeholder="Name"
                        />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.value") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            class="form-control w-full"
                            v-model="form.value"
                            placeholder="Name"
                        />
                        <InputError class="mt-2" :message="form.errors.value" />
                        <FrontErrorMessage :errors="v$.value.$errors" />
                    </div>
                    <div class="text-right mt-5">
                        <button
                            type="button"
                            class="btn btn-primary w-24"
                            @click="submitForm()"
                        >
                            {{ t("admin.update") }}
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
import { computed, onMounted, ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, maxLength, helpers } from "@vuelidate/validators";
import { Inertia } from "@inertiajs/inertia";
const { t } = useI18n(); // use as global scope
const dropzoneValidationRef = ref(null);
const form = useForm({
    value: "",
    key: "",
});
const props = defineProps({
    branch: {
        type: Object,
        required: true,
    },
    address: {
        type: Object,
        required: true,
    },
});
const rules = computed(() => ({
    value: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "value" }),
            required
        ),
    },
}));
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.put(
        route("dashboard.address.update", {
            address: props.address.id,
            branch: props.branch.id,
        }),
        {
            onSuccess: () => {
                Inertia.visit(
                    route("dashboard.address.index", {
                        branch: props.branch.id,
                    })
                );
            },
        }
    );
};
onMounted(() => {
    form.value = props.address.value;
    form.key = props.address.key;
});
</script>
<style scoped></style>
