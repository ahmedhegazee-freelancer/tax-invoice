<template lang="">
    <AuthenticatedLayout>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("admin.update") + " " + t("validation.attributes.race") }}
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
                </div>
                <!-- END: Form Layout -->
            </div>
            <Map />
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
import { validations } from "@/Composables/Validations/Race";
import { Inertia } from "@inertiajs/inertia";
import { selectOptions } from "@/Composables/EventsSearchSelectBox";
import { initializeMap, coordinate, placeMarker } from "@/Composables/Map";

const { t } = useI18n(); // use as global scope

const today = new Date().toLocaleDateString("en-ca");
const form = useForm({
    start_date: today,
    event: "",
    lat: 25.286106,
    lng: 51.534817,
    ar: {
        title: "",
        address: "",
        description: "",
    },
    en: {
        title: "",
        address: "",
        description: "",
    },
});
const props = defineProps({
    race: Object,
    event: Object,
});

const race = props.race;
const previewImages = ref({
    ar: [],
    en: [],
});
const rules = computed(() => ({
    ...validations(),
}));

const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.put(route("dashboard.race.update", { race: race.uuid }), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.race.index"));
        },
    });
};
onMounted(async () => {
    form.start_date = race.start_date;
    form.event = race.event_id;
    form.lat = race.lat;
    form.lng = race.lng;
    fillTranslation();
    await initializeMap();
    placeMarker({ lat: race.lat, lng: race.lng });
});
watch(coordinate.value, (newCoordinate) => {
    form.lat = newCoordinate.lat;
    form.lng = newCoordinate.lng;
});
const fillTranslation = () => {
    for (const key in { address: "", description: "", title: "" }) {
        form.ar[key] = race.translations.ar[key];
        form.en[key] = race.translations.en[key];
    }
};
</script>
<style lang=""></style>
