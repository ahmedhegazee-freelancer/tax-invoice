<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{
                    t("admin.add") + " " + t("validation.attributes.age_group")
                }}
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-8">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">{{
                            t("validation.attributes.name")
                        }}</label>
                        <div>
                            <label for="crud-form-1" class="form-label">
                                {{ t("validation.attributes.name") }}({{
                                    t("admin.locales.ar")
                                }})</label
                            >
                            <input
                                id="crud-form-1"
                                type="text"
                                class="form-control w-full"
                                v-model="form.name.ar"
                                placeholder="Name"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.name?.ar"
                            />
                            <FrontErrorMessage :errors="v$.name.ar.$errors" />
                        </div>
                    </div>
                    <div class="mt-3">
                        <div>
                            <label for="crud-form-1" class="form-label">
                                {{ t("validation.attributes.name") }}({{
                                    t("admin.locales.en")
                                }})</label
                            >
                            <input
                                id="crud-form-1"
                                type="text"
                                class="form-control w-full"
                                v-model="form.name.en"
                                placeholder="Name"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.name?.en"
                            />
                            <FrontErrorMessage :errors="v$.name.en.$errors" />
                        </div>
                    </div>
                    <div class="mt-3">
                        <div>
                            <label for="crud-form-1" class="form-label">
                                {{ t("validation.attributes.from") }}</label
                            >
                            <input
                                id="crud-form-1"
                                type="number"
                                class="form-control w-full"
                                v-model="form.from"
                                min="12"
                                max="110"
                                placeholder=""
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.from"
                            />
                            <FrontErrorMessage :errors="v$.from.$errors" />
                        </div>
                    </div>
                    <div class="mt-3">
                        <div>
                            <label for="crud-form-1" class="form-label">
                                {{ t("validation.attributes.to") }}</label
                            >
                            <input
                                id="crud-form-1"
                                type="number"
                                class="form-control w-full"
                                v-model="form.to"
                                min="13"
                                max="120"
                                placeholder=""
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.to"
                            />
                            <FrontErrorMessage :errors="v$.to.$errors" />
                        </div>
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
import { computed, reactive, ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { validations } from "@/Composables/Validations/AgeGroup";
import { Inertia } from "@inertiajs/inertia";
const { t } = useI18n(); // use as global scope

const form = useForm({
    from: 12,
    to: 13,
    name: {
        ar: "",
        en: "",
    },
});

const rules = computed(() => validations(form));
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.age-group.store"), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.age-group.index"));
        },
    });
};
</script>
<style scoped></style>
