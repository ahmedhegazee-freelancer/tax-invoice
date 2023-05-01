<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("sidebar.bookings") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-3 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <label for="crud-form-2" class="form-label">{{
                    t("admin.status")
                }}</label>
                <TomSelect
                    id="crud-form-2"
                    v-model="form.status"
                    class="w-full"
                    :options="{
                        create: false,
                    }"
                >
                    <option value="">
                        {{ t("admin.approved_statuses.all") }}
                    </option>
                    <option value="0">
                        {{ t("admin.finish_status.not_finished") }}
                    </option>
                    <option value="1">
                        {{ t("admin.finish_status.finished") }}
                    </option>
                </TomSelect>
            </div>
            <div
                class="intro-y col-span-3 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <label for="crud-form-1" class="form-label">
                    {{ t("validation.attributes.event") }}</label
                >
                <TomSelect
                    id="crud-form-2"
                    v-model="form.event"
                    class="w-full"
                    :options="selectOptions"
                >
                    <option value=""></option>
                </TomSelect>
            </div>
            <div
                class="intro-y col-span-3 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <label for="crud-form-1" class="form-label">
                    {{ t("validation.attributes.race") }}</label
                >
                <TomSelect
                    id="crud-form-2"
                    v-model="form.race"
                    class="w-full"
                    :options="racesSelectOptions"
                >
                    <option value=""></option>
                </TomSelect>
            </div>
            <div
                class="intro-y col-span-2 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <VueDatePicker
                    :enable-time-picker="false"
                    range
                    v-model="form.range"
                    :format="format"
                />
            </div>
            <div
                class="intro-y col-span-1 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <button
                    class="btn btn-primary shadow-md mr-2"
                    @click="exportExcel"
                >
                    <PrinterIcon />
                </button>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.id") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.race") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.customer_name") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{
                                    t("validation.attributes.participant_name")
                                }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.age_group") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.price") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.date") }}
                            </th>

                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.status") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(booking, fakerKey) in props.bookings.data"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{
                                    fakerKey +
                                    1 +
                                    15 * (props.bookings.current_page - 1)
                                }}
                            </td>
                            <td>
                                {{ booking.race.translations[0].title }}
                            </td>
                            <td>{{ booking.owner_name }}</td>
                            <td>{{ booking.participant_name }}</td>
                            <td>
                                {{
                                    booking.age_group.translations[0].translate
                                }}
                            </td>
                            <td>{{ booking.price }}</td>
                            <td>
                                {{
                                    new Date(
                                        booking.created_at
                                    ).toLocaleString()
                                }}
                            </td>
                            <td>
                                {{
                                    booking.is_finished == 0
                                        ? t("admin.finish_status.not_finished")
                                        : t("admin.finish_status.finished")
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"
            >
                <pagination :links="props.bookings.links" />
            </div>
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
    </AuthenticatedLayout>
</template>
<script setup>
import { useI18n } from "vue-i18n";
import { ref, computed } from "@vue/reactivity";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { validations } from "@/Composables/Validations/Setting";
import { onMounted, watch } from "@vue/runtime-core";
import { selectOptions } from "@/Composables/EventsSearchSelectBox";
import {
    racesSelectOptions,
    eventId,
} from "@/Composables/RacesSearchSelectBox";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const form = useForm({
    event: "",
    race: "",
    status: "",
    range: [],
});
watch(form, (newForm) => {
    eventId.value = newForm.event;
});

const { t } = useI18n(); // use as global scope
const props = defineProps({
    bookings: Array,
});
watch(form, (newForm) => {
    newForm.range[0] = formatDate(newForm.range[0]);
    newForm.range[1] = formatDate(newForm.range[1]);
    // console.log(route(route().current()));
    Inertia.replace(route(route().current()), {
        method: "get",
        data: newForm.data(),
        replace: false,
        preserveState: true,
        preserveScroll: true,
        only: ["bookings"],
    });
    // Inertia.reload({
    //     only: ["bookings"],
    //     preserveState: true,
    //     replace: true,
    //     data: {
    //         ...newForm.data(),
    //     },
    // });
});
const exportExcel = () => {
    window.open(route("dashboard.booking.export", form.data()), "_blank");
};
const format = (date) => {
    if (date.length == 1) {
        return formatDate(date[0]);
    }
    return formatDate(date[0]) + " - " + formatDate(date[1]);
};
const formatDate = (date) => {
    if (date == undefined) return;
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();
    return `${year}-${month}-${day}`;
};
</script>
<style></style>
