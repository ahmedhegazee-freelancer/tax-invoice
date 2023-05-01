<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("admin.add") + " " + t("validation.attributes.banner") }}
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">{{
                            t("validation.attributes.locale")
                        }}</label>
                        <TomSelect
                            id="crud-form-2"
                            v-model="form.locale"
                            class="w-full"
                            :options="{
                                create: false,
                            }"
                        >
                            <option value="ar">
                                {{ t("admin.locales.ar") }}
                            </option>
                            <option value="en">
                                {{ t("admin.locales.en") }}
                            </option>
                        </TomSelect>
                        <InputError
                            class="mt-2"
                            :message="form.errors.locale"
                        />
                        <FrontErrorMessage :errors="v$.locale.$errors" />
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
                        <InputError
                            class="mt-2"
                            :message="form.errors.images"
                        />
                        <FrontErrorMessage :errors="v$.images.$errors" />
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
import { required, minLength, maxLength, helpers } from "@vuelidate/validators";
import { Inertia } from "@inertiajs/inertia";
const { t } = useI18n(); // use as global scope
const dropzoneValidationRef = ref(null);
const form = useForm({
    locale: "ar",
    images: [],
});

const rules = computed(() => ({
    locale: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "locale" }),
            required
        ),
    },
    images: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "image" }),
            required
        ),
    },
}));
const v$ = useVuelidate(rules, form);
const previewImages = ref([]);

const setImages = (event) => {
    previewImages.value = event.target.files;
    form.images = event.target.files;
};

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.banner.store"), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.banner.index"));
        },
    });
};
</script>
<style scoped></style>
