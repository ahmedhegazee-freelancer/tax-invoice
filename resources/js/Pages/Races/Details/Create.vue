<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("admin.add") + " " + t("admin.race_details") }}
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-12 lg:col-span-6"
                v-for="(lang, key) in ['en', 'ar']"
                :key="key"
            >
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <h1 class="font-medium text-lg mb-4">
                        {{ t(`admin.locales.${lang}`) }}
                    </h1>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.title") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            class="form-control w-full"
                            v-model="form[lang].title"
                            placeholder="Title"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors[lang]?.title"
                        />
                        <FrontErrorMessage :errors="v$[lang].title.$errors" />
                    </div>

                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.description") }}</label
                        >
                        <Editor
                            api-key="1z07nrna8c3ct375ubb6v3hsh0n1kju0y2p3vtn705lib8zx"
                            :init="editorConfig"
                            v-model="form[lang].content"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors[lang]?.content"
                        />
                        <FrontErrorMessage :errors="v$[lang].content.$errors" />
                    </div>
                </div>
                <!-- END: Form Layout -->
            </div>
            <div class="col-span-12 lg:col-span-12">
                <div class="intro-y box p-5">
                    <div class="text-right mt-5">
                        <button
                            type="button"
                            class="btn btn-primary w-24"
                            @click="submitForm"
                        >
                            {{ t("admin.add") }}
                        </button>
                    </div>
                </div>
            </div>
            <!-- END: Form Layout -->
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
import { validations } from "@/Composables/Validations/RaceDetail";
import { Inertia } from "@inertiajs/inertia";
import Editor from "@tinymce/tinymce-vue";
import { editorConfig } from "@/Composables/EditorConfig";
const { t } = useI18n(); // use as global scope

const today = new Date().toLocaleDateString("en-ca");
const form = useForm({
    ar: {
        title: "",
        content: "",
    },
    en: {
        title: "",
        content: "",
    },
});

const validationRules = validations();

const rules = computed(() => validationRules);

const v$ = useVuelidate(rules, form);

const props = defineProps({
    race: Object,
});
const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.detail.store", { race: props.race.uuid }), {
        onSuccess: () => {
            Inertia.visit(
                route("dashboard.detail.index", { race: props.race.uuid })
            );
        },
    });
};
</script>
<style></style>
