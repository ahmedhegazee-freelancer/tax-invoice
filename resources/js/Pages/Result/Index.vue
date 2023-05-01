<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("sidebar.results") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <Link
                    class="btn btn-primary shadow-md mr-2"
                    :href="route('dashboard.result.create')"
                >
                    {{
                        t("admin.add") + " " + t("validation.attributes.result")
                    }}
                </Link>
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
                                {{ t("validation.attributes.name") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.race") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(result, fakerKey) in props.results.data"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{
                                    fakerKey +
                                    1 +
                                    15 * (props.results.current_page - 1)
                                }}
                            </td>
                            <td>{{ result.name }}</td>
                            <td>
                                {{ result.race.translations[0].title }}
                            </td>

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="openDeleteModal(result.id)"
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
                <pagination :links="props.results.links" />
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
});
watch(form, (form) => {
    eventId.value = form.event;
});
const { t } = useI18n();
const props = defineProps({
    results: Array,
});
watch(form, (newForm) => {
    Inertia.reload({
        only: ["results"],
        preserveState: true,
        data: newForm,
    });
});
deleteRouteKey.value = "result";
deleteLink.value = "dashboard.result.destroy";
refreshRecords.value = "results";
</script>
<style></style>
