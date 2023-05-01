<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("admin.add") + " " + t("validation.attributes.event") }}
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box p-5">
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.start_date") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="date"
                            class="form-control w-full"
                            v-model="form.start_date"
                            :min="today"
                            placeholder=""
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors?.start_date"
                        />
                        <FrontErrorMessage :errors="v$.start_date.$errors" />
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6"></div>
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
                            {{ t("validation.attributes.address") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            class="form-control w-full"
                            v-model="form[lang].address"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors[lang]?.address"
                        />
                        <FrontErrorMessage :errors="v$[lang].address.$errors" />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.description") }}</label
                        >
                        <textarea
                            class="form-control w-full"
                            rows="4"
                            cols="10"
                            v-model="form[lang].description"
                        ></textarea>
                        <InputError
                            class="mt-2"
                            :message="form.errors[lang]?.description"
                        />
                        <FrontErrorMessage
                            :errors="v$[lang].description.$errors"
                        />
                    </div>

                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.image") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="file"
                            class="form-control w-full"
                            accept="image/*"
                            @change="setImages($event, lang)"
                            placeholder="Name"
                            multiple
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors[lang]?.images"
                        />
                        <FrontErrorMessage :errors="v$[lang].images.$errors" />
                    </div>
                    <ImagesPreviewer :imagesList="previewImages[lang]" />
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
import { computed, reactive, ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";
import { validations } from "@/Composables/Validations/Event";
import { Inertia } from "@inertiajs/inertia";
const { t } = useI18n(); // use as global scope

const today = new Date().toLocaleDateString("en-ca");
const form = useForm({
    start_date: today,
    ar: {
        title: "",
        address: "",
        description: "",
        images: [],
    },
    en: {
        title: "",
        address: "",
        description: "",
        images: [],
    },
});

const previewImages = ref({
    ar: [],
    en: [],
});
const validationRules = validations();
validationRules.ar.images = {
    required: helpers.withMessage(
        t("validation.required", { attribute: "image" }),
        required
    ),
};
validationRules.en.images = {
    required: helpers.withMessage(
        t("validation.required", { attribute: "image" }),
        required
    ),
};
const rules = computed(() => validationRules);

const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.event.store"), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.event.index"));
        },
    });
};
const setImages = (event, locale) => {
    let images = event.target.files;
    previewImages.value[locale] = images;
    form[locale].images = images;
};
</script>
<style lang=""></style>
