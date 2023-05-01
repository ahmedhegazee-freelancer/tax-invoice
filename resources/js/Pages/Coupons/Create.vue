<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("admin.add") + " " + t("validation.attributes.coupon") }}
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-8">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
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
                                placeholder="Name"
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
                                {{ t("validation.attributes.amount") }}</label
                            >
                            <input
                                id="crud-form-1"
                                type="number"
                                class="form-control w-full"
                                min="1"
                                max="1000"
                                v-model="form.amount"
                                placeholder="1"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.amount"
                            />
                            <FrontErrorMessage :errors="v$.amount.$errors" />
                        </div>
                    </div>
                    <div class="mt-3">
                        <div>
                            <label for="crud-form-1" class="form-label">
                                {{ t("validation.attributes.ended_at") }}</label
                            >
                            <input
                                id="crud-form-1"
                                type="date"
                                class="form-control w-full"
                                v-model="form.ended_at"
                                :min="today"
                                placeholder=""
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.ended_at"
                            />
                            <FrontErrorMessage :errors="v$.ended_at.$errors" />
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
import { validations } from "@/Composables/Validations/Coupon";
import { Inertia } from "@inertiajs/inertia";
const { t } = useI18n(); // use as global scope
const currentDay = new Date();
currentDay.setDate(currentDay.getDate() + 1);
const today = currentDay.toLocaleDateString("en-ca");

const form = useForm({
    ended_at: today,
    amount: 1,
    code: "",
});

const rules = computed(() => validations(form));
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.coupon.store"), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.coupon.index"));
        },
    });
};
</script>
<style scoped></style>
