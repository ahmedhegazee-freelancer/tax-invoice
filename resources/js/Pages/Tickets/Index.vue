<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("sidebar.tickets") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <Link
                    class="btn btn-primary shadow-md mr-2"
                    :href="route('dashboard.ticket.create')"
                >
                    {{
                        t("admin.add") + " " + t("validation.attributes.ticket")
                    }}
                </Link>
            </div>
            <div
                class="intro-y col-span-4 flex flex-wrap sm:flex-nowrap items-center mt-2"
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
                class="intro-y col-span-4 flex flex-wrap sm:flex-nowrap items-center mt-2"
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
                class="intro-y col-span-4 flex flex-wrap sm:flex-nowrap items-center mt-2"
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
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.id") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.race") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.age_group") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.start_time") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.distance") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.gender") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.status") }}
                            </th>

                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(ticket, fakerKey) in props.tickets.data"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{
                                    fakerKey +
                                    1 +
                                    15 * (props.tickets.current_page - 1)
                                }}
                            </td>
                            <td>
                                {{ ticket.race.translations[0].title }}
                            </td>
                            <td>
                                {{ ticket.age_group.translations[0].translate }}
                            </td>
                            <td>
                                {{ ticket.start_time }}
                            </td>
                            <td>{{ ticket.distance }}</td>
                            <td>
                                {{
                                    ticket.gender_id == 1
                                        ? t("admin.gender.male")
                                        : t("admin.gender.female")
                                }}
                            </td>
                            <td>{{ ticket.formatted_status }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route('dashboard.ticket.edit', {
                                                ticket: ticket.uuid,
                                            })
                                        "
                                    >
                                        <CheckSquareIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.update") }}
                                    </Link>

                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="openDeleteModal(ticket.uuid)"
                                    >
                                        <Trash2Icon class="w-4 h-4 mr-1" />
                                        {{ t("admin.delete") }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"
            >
                <pagination :links="props.tickets.links" />
            </div>
            <!-- END: Pagination -->
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
        <DeleteModal
            :deleteConfirmationModal="deleteConfirmationModal"
        ></DeleteModal>
    </AuthenticatedLayout>
</template>
<script setup>
import { useI18n } from "vue-i18n";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import DeleteModal from "@/global-components/DeleteModal.vue";
// use as global scope
import {
    deleteLink,
    refreshRecords,
    deleteConfirmationModal,
    openDeleteModal,
    deleteRouteKey,
} from "@/Composables/DeleteModalFunctions";
import { selectOptions } from "@/Composables/EventsSearchSelectBox";
import {
    racesSelectOptions,
    eventId,
} from "@/Composables/RacesSearchSelectBox";
import { Inertia } from "@inertiajs/inertia";
import { watch } from "@vue/runtime-core";
const form = useForm({
    event: "",
    race: "",
    status: "",
});
watch(form, (form) => {
    eventId.value = form.event;
});
const { t } = useI18n();
const props = defineProps({
    tickets: Array,
});
watch(form, (newForm) => {
    Inertia.reload({
        only: ["tickets"],
        preserveState: true,
        data: newForm,
    });
});
deleteRouteKey.value = "ticket";
deleteLink.value = "dashboard.ticket.destroy";
refreshRecords.value = "tickets";
</script>
<style></style>
