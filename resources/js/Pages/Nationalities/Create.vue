<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{
                    t("admin.add") +
                    " " +
                    t("validation.attributes.nationality")
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
                        <FrontErrorMessage :errors="v$.image.$errors" />
                    </div>
                    <ImagesPreviewer :imagesList="previewImages" />
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
import { validations } from "@/Composables/Validations/Nationality";
import { Inertia } from "@inertiajs/inertia";
import { helpers, required } from "@vuelidate/validators";
const { t } = useI18n(); // use as global scope

const form = useForm({
    name: {
        ar: "",
        en: "",
    },
    image: null,
});

const rules = computed(() => {
    return {
        ...validations(),
        image: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.image"),
                }),
                required
            ),
        },
    };
});
const v$ = useVuelidate(rules, form);
const previewImages = ref([]);

const setImages = (event) => {
    previewImages.value = event.target.files;
    form.image = event.target.files[0];
};
const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.nationality.store"), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.nationality.index"));
        },
    });
};
</script>
<style scoped></style>
