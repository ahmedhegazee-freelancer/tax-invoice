<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{
                    t("admin.update") + " " + t("validation.attributes.ticket")
                }}
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y box p-5">
                    <div>
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.start_time") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="time"
                            class="form-control w-full"
                            v-model="form.start_time"
                            :min="today"
                            placeholder=""
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors?.start_time"
                        />
                        <FrontErrorMessage :errors="v$.start_time.$errors" />
                    </div>
                </div>
            </div>
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
                            disabled
                        >
                            <option value="0"></option>
                            <option :value="props.event.id">
                                {{ props.event.title }}
                            </option>
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
                            disabled
                        >
                            <option value="0"></option>
                            <option :value="props.race.id">
                                {{ props.race.title }}
                            </option>
                        </TomSelect>
                        <InputError class="mt-2" :message="form.errors?.race" />
                        <FrontErrorMessage :errors="v$.race.$errors" />
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">{{
                            t("validation.attributes.gender")
                        }}</label>
                        <TomSelect
                            id="crud-form-2"
                            v-model="form.gender"
                            class="w-full"
                            disabled
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
                    <div class="mt-3">
                        <label for="crud-form-2" class="form-label">{{
                            t("validation.attributes.age_group")
                        }}</label>
                        <TomSelect
                            id="crud-form-2"
                            v-model="form.age_group"
                            class="w-full"
                            disabled
                            :options="{
                                create: false,
                            }"
                        >
                            <option
                                v-for="(age_group, index) in props.ageGroups"
                                :key="index"
                                :value="age_group.id"
                            >
                                {{ age_group.name }}
                            </option>
                        </TomSelect>
                        <InputError
                            class="mt-2"
                            :message="form.errors.age_group"
                        />
                        <FrontErrorMessage :errors="v$.age_group.$errors" />
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.distance") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="number"
                            class="form-control w-full"
                            v-model="form.distance"
                            min="1"
                            placeholder=""
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors?.distance"
                        />
                        <FrontErrorMessage :errors="v$.distance.$errors" />
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.participants") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="number"
                            class="form-control w-full"
                            v-model="form.participants"
                            min="1"
                            disabled
                            placeholder=""
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors?.participants"
                        />
                        <FrontErrorMessage :errors="v$.participants.$errors" />
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">
                            {{ t("validation.attributes.price") }}</label
                        >
                        <input
                            id="crud-form-1"
                            type="number"
                            class="form-control w-full"
                            v-model="form.price"
                            min="1"
                            placeholder=""
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors?.price"
                        />
                        <FrontErrorMessage :errors="v$.price.$errors" />
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
                            {{ t("admin.update") }}
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
import { validations } from "@/Composables/Validations/Ticket";
import { Inertia } from "@inertiajs/inertia";
import { fillForm } from "@/Composables/FillForm";
const { t } = useI18n(); // use as global scope

const props = defineProps({
    ageGroups: Array,
    ticket: Object,
    race: Object,
    event: Object,
});
const form = useForm({
    start_time: "",
    event: "",
    race: "",
    gender: "male",
    price: 1,
    distance: 1,
    participants: 1,
    age_group: props.ageGroups[0].id,
});

const validationRules = validations();

const rules = computed(() => validationRules);

const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.put(route("dashboard.ticket.update", { ticket: props.ticket.uuid }), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.ticket.index"));
        },
    });
};
onMounted(() => {
    const ticket = props.ticket;
    fillForm(form, ticket);

    form.race = ticket.race_id + "";
    form.event = ticket.event_id + "";
    form.age_group = ticket.age_group_id + "";
});
</script>
