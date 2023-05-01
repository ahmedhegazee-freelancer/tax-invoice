<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("admin.update") + " " + t("admin.users.customer") }}
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
                            {{ t("validation.attributes.email") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="email"
                            class="form-control w-full"
                            v-model="form.email"
                            placeholder="Email"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                        <FrontErrorMessage :errors="v$.email.$errors" />
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
                            placeholder=""
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.date_of_birth"
                        />
                        <FrontErrorMessage :errors="v$.date_of_birth.$errors" />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{
                                t("validation.attributes.instagram_account")
                            }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            class="form-control w-full"
                            pattern="\d{4}-\d{2}-\d{2}"
                            v-model="form.instagram_account"
                            placeholder=""
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.instagram_account"
                        />
                    </div>
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.club_name") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="text"
                            class="form-control w-full"
                            pattern="\d{4}-\d{2}-\d{2}"
                            v-model="form.club_name"
                            placeholder=""
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.club_name"
                        />
                    </div>
                    <div class="">
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.phone") }}</label
                        >
                        <div class="grid grid-cols-3 gap-2">
                            <TomSelect
                                id="crud-form-2"
                                v-model="form.country"
                                class="col-span-1"
                                :options="{
                                    create: false,
                                }"
                            >
                                <option
                                    v-for="(country, index) in props.countries"
                                    :key="index"
                                    :value="country.id"
                                >
                                    <img :src="country.icon_url" alt="" />
                                    {{ country.phone_code }}
                                </option>
                            </TomSelect>
                            <input
                                id="crud-form-1"
                                type="text"
                                class="form-control col-span-2"
                                v-model="formattedPhone"
                                placeholder="Phone"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.phone" />
                        <FrontErrorMessage :errors="v$.phone.$errors" />
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">{{
                            t("validation.attributes.nationality")
                        }}</label>
                        <TomSelect
                            id="crud-form-2"
                            v-model="form.nationality"
                            class="w-full"
                            :options="{
                                create: false,
                            }"
                        >
                            <option
                                v-for="(
                                    nationality, index
                                ) in props.nationalities"
                                :key="index"
                                :value="nationality.id"
                            >
                                {{ nationality.name }}
                            </option>
                        </TomSelect>
                        <InputError
                            class="mt-2"
                            :message="form.errors.nationality"
                        />
                        <FrontErrorMessage :errors="v$.nationality.$errors" />
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
import { ref, computed, onMounted, watch } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";
import { Inertia } from "@inertiajs/inertia";
import { fillForm } from "@/Composables/FillForm";
import { selectedCountry, formattedPhone } from "@/Composables/PhoneValidation";
import { validation } from "@/Composables/UserValidationRules";
const { t } = useI18n(); // use as global scope

const props = defineProps({
    roles: Array,
    countries: Array,
    nationalities: Array,
    user: Object,
});

const form = useForm({
    first_name: "",
    middle_name: "",
    last_name: "",
    email: "",
    country: 1,
    phone: "",
    nationality: "",
    instagram_account: "",
    date_of_birth: "",
    club_name: "",
    gender: "male",
});

watch(form.country, (newCountry) => {
    selectedCountry.value = props.countries[newCountry];
});

watch(formattedPhone, (newPhone) => {
    form.phone = `${selectedCountry.value.phone_code}${newPhone}`;
});

const rules = computed(() => ({
    ...validation(),
    date_of_birth: {
        required: helpers.withMessage(
            t("validation.required", { attribute: "date_of_birth" }),
            required
        ),
    },
}));
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.put(route("dashboard.customer.update", { user: props.user.uuid }), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.customer.index"));
        },
    });
};

onMounted(() => {
    const user = props.user;
    fillForm(form, user);
    form.country = user.country_id + "";
    selectedCountry.value = props.countries[user.country_id];
    formattedPhone.value = user.phone.replace(user.country_code, "");
    form.nationality = user.nationality_id + "";
});
</script>
<style lang=""></style>
