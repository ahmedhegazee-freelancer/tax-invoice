<template lang="">
    <!-- BEGIN: Modal Toggle -->

    <!-- END: Modal Toggle -->
    <!-- BEGIN: Modal Content -->
    <Modal size="modal-xl" :show="props.showModal" @hidden="closeModal()">
        <ModalHeader>
            <h2 class="font-medium text-xl text-center pt-4">
                {{ t("admin.send_notification") }}
            </h2>
        </ModalHeader>
        <ModalBody class="grid grid-cols-12 gap-4 gap-y-3 p-4">
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
                        <textarea
                            class="form-control w-full"
                            rows="4"
                            cols="10"
                            v-model="form[lang].body"
                        ></textarea>
                        <InputError
                            class="mt-2"
                            :message="form.errors[lang]?.body"
                        />
                        <FrontErrorMessage :errors="v$[lang].body.$errors" />
                    </div>
                </div>
            </div>
        </ModalBody>
        <ModalFooter class="flex justify-end p-4">
            <button
                type="button"
                @click="closeModal()"
                class="btn btn-outline-secondary w-20 mr-1"
            >
                Cancel
            </button>
            <button
                type="button"
                class="btn btn-primary w-20"
                @click="sendNotification()"
            >
                Send
            </button>
        </ModalFooter>
    </Modal>
    <!-- END: Modal Content -->
</template>
<script setup>
import { useI18n } from "vue-i18n";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { required, helpers, minLength, maxLength } from "@vuelidate/validators";

import { Inertia } from "@inertiajs/inertia";
import {
    validateArabicLetters,
    validateEnglishLetters,
} from "@/Composables/Validations/languagesCharacterTest";
const { t } = useI18n(); // use as global scope
const props = defineProps({
    showModal: {
        type: Boolean,
        default: false,
    },
});
const form = useForm({
    ar: {
        title: "",
        body: "",
    },
    en: {
        title: "",
        body: "",
    },
});
const rules = {
    ar: {
        title: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.title"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.title"),
                    min: 3,
                }),
                minLength(3)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.title"),
                    max: 120,
                }),
                maxLength(120)
            ),
            validateArabicLetters: helpers.withMessage(
                t("validation.regex", {
                    attribute: t("validation.attributes.address"),
                }),
                validateArabicLetters
            ),
        },

        body: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.description"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.description"),
                    min: 3,
                }),
                minLength(3)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.description"),
                    max: 400,
                }),
                maxLength(400)
            ),
        },
    },
    en: {
        title: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.title"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.title"),
                    min: 3,
                }),
                minLength(3)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.title"),
                    max: 120,
                }),
                maxLength(120)
            ),
            validateEnglishLetters: helpers.withMessage(
                t("validation.regex", {
                    attribute: t("validation.attributes.address"),
                }),
                validateEnglishLetters
            ),
        },

        body: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.description"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.description"),
                    min: 3,
                }),
                minLength(3)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.description"),
                    max: 400,
                }),
                maxLength(400)
            ),
        },
    },
};
const v$ = useVuelidate(rules, form);
const emits = defineEmits(["close"]);
const closeModal = () => {
    emits("close");
};
const sendNotification = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.send-notification"), {
        onSuccess: () => {
            closeModal();
        },
    });
};
</script>
<style lang=""></style>
