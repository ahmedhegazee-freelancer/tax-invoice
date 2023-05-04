<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("sidebar.branchs") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <Link
                    class="btn btn-primary shadow-md mr-2"
                    :href="
                        route('dashboard.credential.create', {
                            branch: props.branch.id,
                        })
                    "
                >
                    {{
                        t("admin.add") +
                        " " +
                        t("validation.attributes.credential")
                    }}
                </Link>
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
                                {{
                                    t(
                                        "validation.attributes.device_serial_number"
                                    )
                                }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.client_id") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.client_secret") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.pos_os_version") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.is_prod") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(credential, fakerKey) in props.credentials"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{ fakerKey }}
                            </td>
                            <td>
                                {{ credential.device_serial_number }}
                            </td>
                            <td>{{ credential.client_id }}</td>
                            <td>{{ credential.client_secret }}</td>
                            <td>{{ credential.pos_os_version }}</td>
                            <td>{{ credential.is_prod }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="openDeleteModal(credential.id)"
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
            <!-- <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"
            >
                <pagination :links="props.credentials.links" />
            </div> -->
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
import { Link } from "@inertiajs/inertia-vue3";
import DeleteModal from "@/global-components/DeleteModal.vue";
// use as global scope
import {
    deleteLink,
    refreshRecords,
    deleteConfirmationModal,
    currentRecord,
    openDeleteModal,
    deleteRouteKey,
    routingParam,
} from "@/Composables/DeleteModalFunctions";
const { t } = useI18n();
const props = defineProps({
    credentials: Array,
    branch: Object,
});
routingParam.branch = props.branch.id;
deleteRouteKey.value = "credential";
deleteLink.value = "dashboard.credential.destroy";
refreshRecords.value = "credentials";
</script>
<style></style>
