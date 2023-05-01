<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("admin.update") + " " + t("validation.attributes.role") }}
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
                    <div class="mt-3">
                        <div
                            class="mt-2 mb-2"
                            v-for="(permission, index) in props.permissions"
                            :key="index"
                        >
                            <div class="form-check form-switch">
                                <input
                                    id="checkbox-switch-7"
                                    class="form-check-input"
                                    v-model="form.permissions"
                                    :value="permission.id"
                                    type="checkbox"
                                />
                                <label
                                    class="form-check-label ml-2"
                                    for="checkbox-switch-7"
                                    >{{ permission.name }}</label
                                >
                            </div>
                        </div>
                        <InputError
                            class="mt-2"
                            :message="form.errors.permissions"
                        />
                        <FrontErrorMessage :errors="v$.permissions.$errors" />
                    </div>

                    <!-- <div class="mt-3">
                        <label for="crud-form-2" class="form-label"
                            >Category</label
                        >
                        <TomSelect
                            id="crud-form-2"
                            v-model="categories"
                            class="w-full"
                            multiple
                        >
                            <option value="1">Sport & Outdoor</option>
                            <option value="2">PC & Laptop</option>
                            <option value="3">Smartphone & Tablet</option>
                            <option value="4">Photography</option>
                        </TomSelect>
                    </div> -->

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

import { computed, onMounted, reactive, ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, maxLength, helpers } from "@vuelidate/validators";
import { Inertia } from "@inertiajs/inertia";
const { t } = useI18n(); // use as global scope
const props = defineProps({
    permissions: Array,
    role: Object,
});
const form = useForm({
    name: "",
    permissions: [],
});

const rules = computed(() => ({
    name: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "name" }),
            required
        ),
        minLength: helpers.withMessage(
            t("validation.min.string", { attribute: "name", min: 3 }),
            minLength(3)
        ),
        maxLength: helpers.withMessage(
            t("validation.max.string", { attribute: "name", max: 120 }),
            maxLength(120)
        ),
    },
    permissions: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "permissions" }),
            required
        ),
    },
}));

const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.put(route("dashboard.role.update", { role: props.role.id }), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.role.index"));
        },
    });
};
onMounted(() => {
    form.name = props.role.name;
    form.permissions = Object.keys(props.role.formatted_permissions);
});
</script>
<style lang=""></style>
