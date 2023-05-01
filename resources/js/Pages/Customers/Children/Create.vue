<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{
                    t("admin.add") +
                    " " +
                    t("admin.users.child") +
                    " " +
                    props.user.full_name
                }}
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.first_name") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            class="form-control w-full"
                            v-model="form.first_name"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.first_name"
                        />
                        <FrontErrorMessage :errors="v$.first_name.$errors" />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.middle_name") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            class="form-control w-full"
                            v-model="form.middle_name"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.middle_name"
                        />
                        <FrontErrorMessage :errors="v$.middle_name.$errors" />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.last_name") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            class="form-control w-full"
                            v-model="form.last_name"
                            placeholder="Name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.last_name"
                        />
                        <FrontErrorMessage :errors="v$.last_name.$errors" />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{
                                t("validation.attributes.date_of_birth")
                            }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="date"
                            class="form-control w-full"
                            pattern="\d{4}-\d{2}-\d{2}"
                            v-model="form.date_of_birth"
                            :min="minDate.toLocaleDateString('en-ca')"
                            :max="maxDate.toLocaleDateString('en-ca')"
                            placeholder=""
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.date_of_birth"
                        />
                        <FrontErrorMessage :errors="v$.date_of_birth.$errors" />
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">{{
                            t("validation.attributes.gender")
                        }}</label>
                        <TomSelect
                            id="crud-form-2"
                            v-model="form.gender"
                            class="w-full"
                            :options="{
                                create: false,
                            }"
                        >
                            <option value="male">
                                {{ t("admin.gender.male") }}
                            </option>
                            <option value="female">
                                {{ t("admin.gender.female") }}
                            </option>
                        </TomSelect>
                        <InputError
                            class="mt-2"
                            :message="form.errors.gender"
                        />
                        <FrontErrorMessage :errors="v$.gender.$errors" />
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
import { computed, watch } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { Inertia } from "@inertiajs/inertia";
import { validation } from "@/Composables/Validations/Child";
const { t } = useI18n(); // use as global scope
const props = defineProps({
    user: Object,
});
const minDate = new Date();
minDate.setFullYear(minDate.getFullYear() - 11);
const maxDate = new Date();
maxDate.setFullYear(maxDate.getFullYear() - 6);
const form = useForm({
    first_name: "",
    middle_name: "",
    last_name: "",
    date_of_birth: "",
    gender: "male",
});

const rules = computed(() => ({
    ...validation(),
}));
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.child.store", { user: props.user }), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.child.index", { user: props.user }));
        },
    });
};
</script>
<style lang=""></style>
