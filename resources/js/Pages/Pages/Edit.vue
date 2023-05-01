<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("admin.update") + " " + props.page.title }}
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
            <div class="text-right mt-5">
                <button
                    type="button"
                    class="btn btn-primary w-24"
                    @click="submitForm()"
                >
                    {{ t("admin.update") }}
                </button>
            </div>

            <!-- END: Form Layout -->
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { useI18n } from "vue-i18n";
import { computed, onMounted, watch } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";
import { Inertia } from "@inertiajs/inertia";
import { fillForm } from "@/Composables/FillForm";
import { selectedCountry, formattedPhone } from "@/Composables/PhoneValidation";
import Editor from "@tinymce/tinymce-vue";
const { t } = useI18n(); // use as global scope
const props = defineProps({
    page: Object,
});
const form = useForm({
    ar: {
        content: "",
    },
    en: {
        content: "",
    },
});

const rules = computed(() => ({
    ar: {
        content: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.description"),
                }),
                required
            ),
        },
    },
    en: {
        content: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.description"),
                }),
                required
            ),
        },
    },
}));
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.put(route("dashboard.page.update", { page: props.page.slug }), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.page.index"));
        },
    });
};
onMounted(() => {
    const page = props.page;
    form.ar.content = page.translations.ar.content;
    form.en.content = page.translations.en.content;
});
</script>
<style lang=""></style>
