<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("admin.add") + " " + t("validation.attributes.result") }}
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box p-5">
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.event") }}</label
                        >
                        <TomSelect
                            id="crud-form-2"
                            v-model="form.event"
                            class="w-full"
                            :options="selectOptions"
                        >
                            <option value="0"></option>
                        </TomSelect>
                        <InputError
                            class="mt-2"
                            :message="form.errors?.event"
                        />
                        <FrontErrorMessage :errors="v$.event.$errors" />
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box p-5">
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.race") }}</label
                        >
                        <TomSelect
                            id="crud-form-2"
                            v-model="form.race"
                            class="w-full"
                            :options="racesSelectOptions"
                        >
                            <option value="0"></option>
                        </TomSelect>
                        <InputError class="mt-2" :message="form.errors?.race" />
                        <FrontErrorMessage :errors="v$.race.$errors" />
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box p-5">
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.result_file") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="file"
                            class="form-control w-full"
                            @change="setFile"
                            accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.result_file"
                        />
                        <FrontErrorMessage :errors="v$.result_file.$errors" />
                    </div>
                </div>
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
import { computed, onMounted, reactive, ref, watch } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";
import { validations } from "@/Composables/Validations/Result";
import { Inertia } from "@inertiajs/inertia";
import { selectOptions } from "@/Composables/EventsSearchSelectBox";
import {
    racesSelectOptions,
    eventId,
} from "@/Composables/RacesSearchSelectBox";
const { t } = useI18n(); // use as global scope

const props = defineProps({
    ageGroups: Array,
});
const form = useForm({
    event: "",
    race: "",
    result_file: "",
});

watch(form, (form) => {
    eventId.value = form.event;
});
const validationRules = validations();

const rules = computed(() => validationRules);

const v$ = useVuelidate(rules, form);
const setFile = (event) => {
    form.result_file = event.target.files[0];
};
const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.result.store"), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.result.index"));
        },
    });
};
</script>
