<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{
                    t("admin.update") + " " + t("validation.attributes.country")
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
                                {{ t("validation.attributes.code") }}</label
                            >
                            <input
                                id="crud-form-1"
                                type="text"
                                class="form-control w-full"
                                v-model="form.code"
                                min="12"
                                max="110"
                                placeholder=""
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.code"
                            />
                            <FrontErrorMessage :errors="v$.code.$errors" />
                        </div>
                    </div>
                    <div class="mt-3">
                        <div>
                            <label for="crud-form-1" class="form-label">
                                {{
                                    t("validation.attributes.phone_code")
                                }}</label
                            >
                            <input
                                id="crud-form-1"
                                type="text"
                                class="form-control w-full"
                                v-model="form.phone_code"
                                min="12"
                                max="110"
                                placeholder=""
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.phone_code"
                            />
                            <FrontErrorMessage
                                :errors="v$.phone_code.$errors"
                            />
                        </div>
                    </div>
                    <div class="mt-3">
                        <div>
                            <label for="crud-form-1" class="form-label">
                                {{ t("validation.attributes.regex") }}</label
                            >
                            <input
                                id="crud-form-1"
                                type="text"
                                class="form-control w-full"
                                v-model="form.regex"
                                min="12"
                                max="110"
                                placeholder=""
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.regex"
                            />
                            <FrontErrorMessage :errors="v$.regex.$errors" />
                        </div>
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
                            @change="setImages"
                            placeholder="Name"
                            multiple
                        />
                        <InputError class="mt-2" :message="form.errors.image" />
                    </div>
                    <ImagesPreviewer :imagesList="previewImages" />
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
import { computed, onMounted, reactive, ref, defineProps } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { validations } from "@/Composables/Validations/Country";
import { Inertia } from "@inertiajs/inertia";
import { fillForm } from "@/Composables/FillForm";
const { t } = useI18n(); // use as global scope
const props = defineProps({
    model: Object,
});
const form = useForm({
    code: "",
    phone_code: "",
    regex: "",
    name: {
        ar: "",
        en: "",
    },
    image: null,
});
const previewImages = ref([]);

const setImages = (event) => {
    previewImages.value = event.target.files;
    form.image = event.target.files[0];
};
const rules = computed(() => validations());
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.put(route("dashboard.country.update", { country: props.model.id }), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.country.index"));
        },
    });
};
onMounted(() => {
    const model = props.model;
    fillForm(form, model);
});
</script>
<style scoped></style>
