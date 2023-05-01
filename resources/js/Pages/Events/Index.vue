<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("sidebar.events") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-2 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <Link
                    class="btn btn-primary shadow-md mr-2"
                    :href="route('dashboard.event.create')"
                >
                    {{
                        t("admin.add") + " " + t("validation.attributes.event")
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
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.id") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.title") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.address") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.status") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.start_date") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(event, fakerKey) in props.events.data"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{
                                    fakerKey +
                                    1 +
                                    15 * (props.events.current_page - 1)
                                }}
                            </td>
                            <td>
                                {{ event.title }}
                            </td>
                            <td>
                                {{ event.address }}
                            </td>
                            <td>{{ event.formatted_status }}</td>
                            <td>{{ event.start_date }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route('dashboard.media.index', {
                                                event: event.uuid,
                                            })
                                        "
                                    >
                                        <ImageIcon class="w-4 h-4 mr-1" />
                                        {{ t("validation.attributes.media") }}
                                    </Link>
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route('dashboard.event.edit', {
                                                event: event.uuid,
                                            })
                                        "
                                    >
                                        <CheckSquareIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.update") }}
                                    </Link>

                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="openDeleteModal(event.uuid)"
                                    >
                                        <Trash2Icon class="w-4 h-4 mr-1" />
                                        {{ t("admin.delete") }}
                                    </a>
                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        v-if="event.is_finished == 0"
                                        @click="
                                            openChangeStatusModal(event.uuid)
                                        "
                                    >
                                        <XCircleIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.close") }}
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
                <pagination :links="props.events.links" />
            </div>
            <!-- END: Pagination -->
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
        <DeleteModal
            :deleteConfirmationModal="deleteConfirmationModal"
        ></DeleteModal>
        <ChangeStatusModal
            :changeStatusConfirmationModal="changeStatusConfirmationModal"
        ></ChangeStatusModal>
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
import {
    changeStatusRoute,
    changeStatusConfirmationModal,
    openChangeStatusModal,
} from "@/Composables/ChangeStatusModalFunctions";
import { watch } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import ChangeStatusModal from "@/global-components/ChangeStatusModal.vue";
const { t } = useI18n();
const props = defineProps({
    events: Array,
});
const form = useForm({
    status: "",
});
watch(form, (newForm) => {
    Inertia.reload({
        only: ["events"],
        preserveState: true,
        data: newForm,
    });
});
deleteRouteKey.value = "event";
deleteLink.value = "dashboard.event.destroy";
refreshRecords.value = "events";
changeStatusRoute.value = {
    route: "dashboard.event.close",
    paramsKey: "event",
    dataName: "events",
};
</script>
<style></style>
